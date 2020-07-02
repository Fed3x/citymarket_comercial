<template>
    <div>
        <div class="form-group row">
            <div class="col-md-12">
            <v-select label="descripcion" placeholder="Reporte a ejecutar" :options="reportes" :reduce="reportes => reportes"  v-model="seleccion.reporte"></v-select>
            </div>
        </div>

         <div class="form-group row">
            <div class="col-md-6">
            <label for="inputEmail4">Fecha de Inicio</label>
            <input type="date" class="form-control" placeholder="Date start"  v-model="seleccion.fecha_i" min="2014-07-01">
            </div>
            <div class="col-md-6">
            <label for="inputEmail4">Fecha de Fin</label>
            <input type="date" class="form-control" placeholder="Date end" v-model="seleccion.fecha_f" >
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-12">
                <v-select multiple label="descripcion" placeholder="Seleccionar un e-mail" :options="correos"   v-model="seleccion.correos"></v-select>
            </div>
        </div>

        <button class="btn btn-primary" type="button" v-on:click="EjecutarReporte">Ejecutar</button>
        <button class="btn btn-danger" type="button" @click="ResetarReporte()">Reset</button>
    </div>
</template>

<script>
    import Vue from 'vue'
    import EventBus from "../event-bus"
    import 'vue-select/dist/vue-select.css';
    import vSelect from 'vue-select'

    Vue.component('v-select', vSelect)


    export default {
        created() {
            
        },
        data(){
            return{
                reportes:[],
                correos:[],
                seleccion:[{
                    reporte: [],
                    fecha_i: '',
                    fecha_f: '',
                    correos: []
                }],
            }
        },
        mounted() {
            this.CargarReportes();
            this.CargarCorreos();
        },
        methods: {
            CargarReportes(){
                axios.get('/reportes')
                    .then((response)=>{
                    this.reportes = response.data;

                });

            },
            CargarCorreos(){
                axios.get('/usuarios')
                    .then((response)=>{
                        response.data.data.forEach(correo => {
                             this.correos.push(correo.email);
                        });
                    })
                    .catch((error)=>{
                        swal("Error!", "Algo anda mal" +"\n" + error.response.data.message, "warning");
                    });
            },
            EjecutarReporte(){
                
                if ( [this.seleccion.fecha_i, this.seleccion.fecha_f, this.seleccion.reporte.id, this.seleccion.reporte.trabajo, this.seleccion.reporte.area_trabajo, this.seleccion.correos].includes(undefined) || 
                     [this.seleccion.fecha_i, this.seleccion.fecha_f, this.seleccion.reporte.id, this.seleccion.reporte.trabajo, this.seleccion.reporte.area_trabajo, this.seleccion.correos].includes(null) ||
                     [this.seleccion.fecha_i, this.seleccion.fecha_f, this.seleccion.reporte.id, this.seleccion.reporte.trabajo, this.seleccion.reporte.area_trabajo, this.seleccion.correos].includes("") ||
                     this.seleccion.correos.length == 0 ){          
                    swal({
                        title: '¡Advertencia!',
                        text: 'Favor verificar los campos.',
                        icon: 'warning',
                    });
                }
                else{
                    const parametros = {
                        fecha_inicio: this.seleccion.fecha_i,
                        fecha_final: this.seleccion.fecha_f,
                        id_trabajo: this.seleccion.reporte.id,
                        area_trabajo: this.seleccion.reporte.area_trabajo,
                        trabajo: this.seleccion.reporte.trabajo,
                        correos: this.seleccion.correos
                    };
                    axios.post('/ejecutar_reportes', parametros)
                        .then((response)=>{

                    });
                    swal({
                        title: '¡Ejecutado!',
                        text: 'El reporte fue ejecutado, en breve llegará a los correos seleccionados.',
                        icon: 'success',
                    });
                    this.ResetarReporte();
                }
                

            },
            ResetarReporte(){
                this.seleccion.reporte = '';
                this.seleccion.fecha_i = '';
                this.seleccion.fecha_f = '';
                this.seleccion.correos = '';
            }
            

        }
      
    }
</script>
