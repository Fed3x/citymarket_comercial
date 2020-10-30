<template>
    <div>
        <div class="form-group row">
            <div class="col-md-12">
                <label >Reporte</label>
                <v-select label="descripcion" placeholder="Reporte a ejecutar" :options="reportes" :reduce="reportes => reportes"  v-model="seleccion.reporte" @input="BuscarParametros"></v-select>
            </div>
        </div>
        <div v-show="parametros.visible">
            <div class="form-group row" v-show="parametros.fechas">
                <div class="col-md-6">
                    <label for="fecha_i">Fecha de Inicio</label>
                    <input id="fecha_i" type="date" class="form-control" placeholder="Fecha inicio"  v-model="seleccion.fecha_i" min="2014-07-01">
                </div>
                <div class="col-md-6">
                    <label for="fecha_f">Fecha de Fin</label>
                    <input id="fecha_f" type="date" class="form-control" placeholder="Fecha final" v-model="seleccion.fecha_f" min="2014-07-01">
                </div>
            </div>
            <div class="form-group row"  v-show="parametros.productos">
                <div class="col-md-12">
                    <label >Productos </label>
                    <v-select multiple label="codigo_barras" placeholder="Seleccionar productos" @search="BuscarProductos" @input="LimpiarProductos" :options="productos" v-model="seleccion.productos">
                        <div slot="no-options">¡No hay opciones para listar!</div>
                    </v-select>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-12">
                <label >Correos</label>
                <v-select multiple label="descripcion" placeholder="Seleccionar e-mail" :options="correos"   v-model="seleccion.correos">
                    <div slot="no-options">¡No hay opciones para listar!</div>
                </v-select>
            </div>
        </div>
        <div class="text-center">
             <button class="btn btn-primary btn-reporte" type="button" @click="EjecutarReporte()">Ejecutar</button>
            <button class="btn btn-danger btn-reporte" type="button" @click="ResetarReporte()">Reset</button>
        </div>
       
    </div>
</template>
<style>
.btn-reporte{
    width: 104px;
    height: 46px;
}
</style>


<script>
    let today = new Date();
    let dd = today.getDate();
    let mm = today.getMonth()+1; //Enero es 0!
    let yyyy = today.getFullYear();
    if(dd<10){
            dd='0'+dd
    } 
    if(mm<10){
        mm='0'+mm
    } 

    today = yyyy+'-'+mm+'-'+dd;

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
                productos:[],
                seleccion: {
                    reporte: [],
                    fecha_i: '',
                    fecha_f: '',
                    correos: [],
                    productos: [],
                },
                parametros: {
                    visible     : false,
                    fechas      : false,
                    sucursales  : false,
                    productos   : false
                },
                datos: {
                    id_trabajo: '',
                    area_trabajo: '',
                    trabajo: '',
                    correos: '',
                    fecha_i: '',
                    fecha_f: '',
                    productos: [],
                }
            }
        },
        mounted() {
            document.getElementById("fecha_f").setAttribute("max", today);
            document.getElementById("fecha_i").setAttribute("max", today);
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
            ResetearParametros(){
                this.parametros.visible = false;
                this.parametros.fechas = false;
                this.parametros.productos = false;
                this.parametros.sucursales = false;
            },
            BuscarParametros(){ 
                this.ResetearParametros();
                if(this.seleccion.reporte != null){
                    this.seleccion.reporte.parametros.forEach(parametro =>{
                        switch(parametro.descripcion){
                            case "FECHAS"       : this.parametros.fechas = true;break;
                            case "SUCURSALES"   : this.parametros.sucursales = true;break;
                            case "PRODUCTOS"    : this.parametros.productos = true;break;
                        }
                        this.parametros.visible = true;
                    })
                }
            },
            BuscarProductos(search, loading){
                if(search.length > 7){
                    loading(true);
                    axios.get('/productos/'+search)
                    .then((response)=>{
                        this.productos = response.data;
                        loading(false);
                    })
                    .catch((error)=>{
                        swal("Error!", "Algo anda mal" +"\n" + error.response.data.message, "warning");
                    });
                }
            },
            LimpiarProductos(){
                this.productos = [];
            },
            ControlReporte(){
                if ([this.seleccion.correos, this.seleccion.reporte].includes(undefined) || [this.seleccion.correos, this.seleccion.reporte].includes(null) ||
                    [this.seleccion.correos, this.seleccion.reporte].includes("") || this.seleccion.reporte.lenght == 0 || this.seleccion.correos.length == 0 ){
                    return false;          
                }else{
                    this.LimpiarDatos();
                    this.datos.id_trabajo = this.seleccion.reporte.id;
                    this.datos.area_trabajo = this.seleccion.reporte.area_trabajo;
                    this.datos.trabajo = this.seleccion.reporte.trabajo;
                    this.datos.correos = this.seleccion.correos
                    return true;
                }
            },
            ControlReporteFechas(){

                if ([this.seleccion.fecha_i, this.seleccion.fecha_f].includes(undefined) || [this.seleccion.fecha_i, this.seleccion.fecha_f].includes(null) || [this.seleccion.fecha_i, this.seleccion.fecha_f].includes("")){
                    return false
                }else{
                    this.LimpiarDatosFechas();
                    this.datos.fecha_i = this.seleccion.fecha_i;
                    this.datos.fecha_f = this.seleccion.fecha_f;
                    return true;
                }
            },
            ControlReporteProductos(){
                if  (this.seleccion.productos.includes(undefined) || this.seleccion.productos.includes(null)  || this.seleccion.productos.includes("") || this.seleccion.productos.length == 0){
                    return false
                }else{
                    this.LimpiarDatosProductos();
                    this.datos.productos = this.seleccion.productos;
                    return true;
                }
            },
            EjecutarReporte(){
                let b_fechas = false;
                let b_productos = false;
                if(this.ControlReporte()){
                    if (this.parametros.fechas){
                        if(this.ControlReporteFechas()){
                            b_fechas = true;
                        }
                    }
                    if (this.parametros.productos){
                        if(this.ControlReporteProductos()){
                            b_productos = true;
                        }
                    }
                }
                if(this.parametros.fechas != b_fechas || this.parametros.productos != b_productos || !this.ControlReporte()){
                    swal({
                            title: '¡Advertencia!',
                            text: 'Favor verificar los campos.',
                            icon: 'warning',
                    });
                }
                else{
                    let parametros = this.parametros
                    axios.post('/ejecutar_reportes', [this.datos, parametros]).then((response)=>{
                        this.ResetarReporte();
                        swal({
                            title: '¡Ejecutado!',
                            text: 'El reporte fue ejecutado, en breve llegará a los correos seleccionados.',
                            icon: 'success',
                        });
                    });   
                }
            },
            ResetarReporte(){
                this.seleccion.reporte = [];
                this.seleccion.correos = [];
                this.seleccion.fecha_i = '';
                this.seleccion.fecha_f = '';
                this.seleccion.productos = [];
                this.ResetearParametros();
                this.LimpiarDatos();
                this.LimpiarDatosFechas();
                this.LimpiarDatosProductos();
            },
            LimpiarDatos(){
                this.datos.id_trabajo = '';
                this.datos.area_trabajo = '';
                this.datos.trabajo = '';
                this.datos.correos = '';
            },
            LimpiarDatosFechas(){
                this.datos.fecha_i = '';
                this.datos.fecha_f = '';
            },
            LimpiarDatosProductos(){
                this.datos.productos = [];
            }
        }
      
    }
</script>
