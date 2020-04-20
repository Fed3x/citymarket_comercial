<template>
    <div class="modal fade" id="FlotaModal" tabindex="-1" role="dialog"
        aria-labelledby="FlotaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                        <h5 v-if="modoEdicion" class="modal-title" id="FlotaModalLabel">Modificar Flota</h5>
                        <h5 v-else class="modal-title" id="FlotaModalLabel">Nueva Flota</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="col-md-2">
                                <div class="form-group col-md-12">
                                    Marca: 
                                </div>

                                <div class="form-group col-md-12">
                                    Modelo: 
                                </div>
                                <div class="form-group col-md-12">
                                    Matricula: 
                                </div>
                                <div class="form-group col-md-12">
                                    Año: 
                                </div>
                            </div>
                        
                            <div class="col-md-10">
                                <div class="form-inline float-sm-right" style="margin-top: -5px; margin-bottom: 15px;">
                                    <v-select id="inputBrand" ref="inputBrand" v-model="draft.id_marca" label="descripcion" :options="auto_marcas" :reduce="auto_marcas => auto_marcas.id" @input="onChangeMarca()"></v-select>
                                    <a href="#!" v-on:click="NuevaMarca()" data-toggle="tooltip" data-placement="auto" title="Agregar nueva marca de auto"  style="margin-left: 10px"><i class="fas fa-plus-square text-success fa-lg"></i></a>
                                </div>

                                <div class="form-inline float-sm-right" style="margin-top: -5px; margin-bottom: 15px;">
                                    <v-select id="inputModel" v-model="draft.id_modelo" label="descripcion" :options="FiltrarModelo" :reduce="FiltrarModelo => FiltrarModelo.id" ></v-select>
                                    <a href="#!" v-on:click="NuevoModelo()" data-toggle="tooltip" data-placement="auto" title="Agregar nuevo modelo de auto" style="margin-left: 10px"><i class="fas fa-plus-square text-success fa-lg"></i></a>
                                </div>
                                <div class="form-inline float-sm-right" style="margin-top: -5px; margin-bottom: 15px;">
                                    <input type="text" class="form-control form-control-sm text-left" id="inputPatent" v-model="draft.matricula">
                                </div>
                                <div class="form-inline float-sm-right" style="margin-top: -5px; margin-bottom: 15px;">
                                    <input type="number" class="form-control form-control-sm text-left" id="inputYear" v-model="draft.año" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        <button v-if="modoEdicion" type="submit" class="btn btn-primary" @click="ActualizarFlota()">Modificar</button>
                        <button v-else type="submit" class="btn btn-success" @click="NuevaFlota()">Guardar</button>
                    </div>
            </div>
        </div>
    </div>
    
</template>

<script>
    import Vue from 'vue'
    import EventBus from "../event-bus"

    import vSelect from 'vue-select'
    

    Vue.component('v-select', vSelect)
    import 'vue-select/dist/vue-select.css';

    export default {
        created(){

        },
        data(){
            return{
                modoEdicion: false,
                draft:[{
                    id_marca: '',
                    id_modelo: '',
                    año: '',
                    matricula: '',
                    id: ''
                }],
                auto_marcas: [],
                auto_modelos: [],
            }
        },

        computed:{
            FiltrarModelo () {
                let auto_modelos = this.auto_modelos

                if(this.draft.id_marca !== 'undefined' || this.draft.id_marca !== null){
                    auto_modelos = auto_modelos.filter((marca) => {
                        return marca.id_auto_marca == this.draft.id_marca;
                    });
                    
                }
                return auto_modelos 
            }
        },
        mounted() {
            EventBus.$on('flota', (parametros) => { 

                this.MostrarFlota();
            });
            EventBus.$on('CerrarModalReferencia', (parametros) => { 

                $('#FlotaModal').modal({show: true, keyboard: false, backdrop: 'static'});
            });
            EventBus.$on('CargarNuevaReferencia', (parametros) => { 
                if(parametros[1].referencia === 'auto_marca'){
                    this.CargarNuevaMarca(parametros[0]);
                }else{
                    this.CargarNuevoModelo(parametros[0]);
                }
            });
            axios.get('/auto_marca')
                 .then((response)=>{
                    this.auto_marcas = response.data;
            });
            axios.get('/auto_modelo')
                 .then((response)=>{
                    this.auto_modelos = response.data;
            });

            axios.get('/usuario_flota')
                 .then((response)=>{
                if(Object.keys(response.data).length != 0){
                    this.draft = Object.assign({}, this.draft, { id_marca: response.data.id_auto_marca });
                    this.draft = Object.assign({}, this.draft, { id_modelo: response.data.id_auto_modelo });
                    this.draft = Object.assign({}, this.draft, { año: response.data.año });
                    this.draft = Object.assign({}, this.draft, { matricula: response.data.matricula });
                    this.draft = Object.assign({}, this.draft, { id: response.data.id });
                    this.modoEdicion = true;
                 }
                 
            });

        },
        methods: {
            NuevaFlota(){
                let parametros = {
                id_marca: this.draft.id_marca,
                id_modelo: this.draft.id_modelo,
                año: this.draft.año,
                matricula: this.draft.matricula
                }
                axios.post('/usuario_flota', parametros)
                     .then((response) => {
                        this.draft = Object.assign({}, this.draft, { id_marca: response.data.id_auto_marca });
                        this.draft = Object.assign({}, this.draft, { id_modelo: response.data.id_auto_modelo });
                        this.draft = Object.assign({}, this.draft, { año: response.data.año });
                        this.draft = Object.assign({}, this.draft, { matricula: response.data.matricula });
                        this.modoEdicion = true;
                }).catch((error)=> {
                    swal("Error!", "Algo anda mal", "warning");
                });
                
            },
            ActualizarFlota(){
                let parametros = {
                id_marca: this.draft.id_marca,
                id_modelo: this.draft.id_modelo,
                año: this.draft.año,
                matricula: this.draft.matricula,
                }
                axios.put('/usuario_flota/'+ this.draft.id, parametros)
                     .then((response) => {
                        this.draft = Object.assign({}, this.draft, { id_marca: response.data.id_auto_marca });
                        this.draft = Object.assign({}, this.draft, { id_modelo: response.data.id_auto_modelo });
                        this.draft = Object.assign({}, this.draft, { año: response.data.año });
                        this.draft = Object.assign({}, this.draft, { matricula: response.data.matricula });
                        this.modoEdicion = true;
                }).catch((error)=> {
                    swal("Error!", "Algo anda mal", "warning");
                });
            },
            MostrarFlota(){               
                $('#FlotaModal').modal({show: true, keyboard: false, backdrop: 'static'});
            },
            NuevaMarca(){
                let parametros = {
                    referencia: 'auto_marca',
                    titulo: 'Nueva Marca',
                    placeholder: 'Nueva marca de vehiculo',
                    mensaje: 'La nueva marca ha sido creada exitosamente.',
                    referencia_padre: ''

                };
                EventBus.$emit('AgregarReferencia', parametros);
                $('#FlotaModal').modal('hide');
            },
            NuevoModelo(){
                if(this.draft.id_marca === 'undefined' || this.draft.id_marca == null){
                    swal({
                            title: '¡Advertencia!',
                            text: 'Debe seleccionar la marca del auto.',
                            icon: 'warning',
                        });
                }else{
                    let parametros = {
                    referencia: 'auto_modelo',
                    titulo: 'Nuevo Modelo',
                    placeholder: 'Nuevo modelo de vehiculo',
                    mensaje: 'El nuevo modelo ha sido creado exitosamente.',
                    referencia_padre: this.draft.id_marca

                };
                EventBus.$emit('AgregarReferencia', parametros);
                $('#FlotaModal').modal('hide');
                }
            },
            CargarNuevaMarca(parametros){
                this.auto_marcas.push(parametros);

            },
            CargarNuevoModelo(parametros){
                this.auto_modelos.push(parametros);

            },
            onChangeMarca(){
                this.draft = Object.assign({}, this.draft, { id_modelo: '' });
            }
        }
      
    }
</script>

<style >
#inputBrand{
    width: 320px;

}

#inputModel{
    width: 320px;

}

#inputYear{
    width: 345px;


}

#inputPatent{
    width: 345px;

}

</style>