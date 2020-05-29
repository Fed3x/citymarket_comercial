<template>
<div class="card-body">
    <button type="button" class="btn btn-primary float-right" @click="Agregar()">
        <i class="fas fa-align-center" ></i>Agregar Trabajo
    </button>
    <div class="modal fade" id="ModalTrabajo" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="ModalTrabajoLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalTrabajoLabel">Nuevo Registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Descripcion</label>
                        <input type="text" class="form-control form-control-sm" v-model="draft.descripcion"> 
                    </div>
                    <div class="form-group col-md-6">
                        <label>Trabajo</label>
                        <input type="text" class="form-control form-control-sm" v-model="draft.trabajo"> 
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-7">
                        <label>Area de Trabajo</label>
                        <v-select label="descripcion" :options="areas_trabajo" :reduce="areas_trabajo => areas_trabajo.descripcion" v-model="draft.area_trabajo"></v-select>
                    </div>
                    <div class="form-group col-md-5" v-show="modoEdicion">
                        <label>Estado</label>
                        <v-select label="descripcion" :options="estados" :reduce="estados => estados.valor" v-model="draft.estado"></v-select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="Cerrar()">Cerrar</button>
                <button v-if="modoEdicion" type="button" class="btn btn-primary" @click="Actualizar()">Actualizar</button>
                <button v-else type="button" class="btn btn-primary" @click="Guardar()">Guardar</button>
            </div>
            </div>
        </div>
    </div>
    <div class="table-responsive-sm">
        <table class="table table-hover table-borderless table-sm text-center">
            <thead class="thead">
                <tr>
                    <th>#</th>
                    <th>Descripcion</th>
                    <th>Trabajo</th>
                    <th>Area del Trabajo</th>
                    <th>Estado</th>
                    <th>Creado por</th>
                    <th>Acciones</th>
                </tr>
            </thead>    
            <tbody>
                <trabajo-component v-for="(trabajo, index) in trabajos" 
                    :key="trabajo.id" 
                    :trabajo="trabajo" 
                    :index="index"
                    @modificar="Modificar"
                    @eliminar="Eliminar"
                    >                        
                </trabajo-component> 
            </tbody>
        </table>
        <!-- <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <span>
                        Mostranto registros desde el <b> 1 </b> al <b> 15</b> | Total: <b> 9999</b>
                    </span>
                </div>
                <div class="col-md-6">
                    <div class="btn-toolbar float-right" role="toolbar">
                        <div class="btn-group mr-2" role="group" aria-label="First group">
                            <button type="button" class="btn thead" @click="PrimeraPagina()"><i class="fas fa-angle-double-left"></i></button>
                            <button type="button" class="btn btn-light" @click="AnteriorPagina()"><i class="fas fa-angle-left"></i></button>
                            <button type="button" class="btn btn-light" @click="SiguientePagina()"><i class="fas fa-angle-right"></i></button>
                            <button type="button" class="btn btn-light" @click="UltimaPagina()"><i class="fas fa-angle-double-right"></i></button>
                        </div>
                    </div>
                </div>
            </div>  
        </div> -->
    </div>
</div>

</template>

<script>
    import Vue from 'vue'
    import EventBus from "../../../event-bus"

    import vSelect from 'vue-select'

    Vue.component('v-select', vSelect)
    import 'vue-select/dist/vue-select.css';

    export default {
        created() {
        },
        data(){
            return{
                trabajos:[],
                estados:[
                    {descripcion:'Activo', valor: true},
                    {descripcion:'Inactivo', valor: false}
                ],
                areas_trabajo:[
                    {descripcion:'MANUAL'},
                    {descripcion:'AUTOMATICO'}
                ],
                draft:{
                    id: '',
                    descripcion: '',
                    estado: '',
                    area_trabajo: '',
                    trabajo: '',
                },
                index: '',
                modoEdicion: false,
            }
        },
        mounted() {
            this.CargarTrabajos();

        },
        methods: {
            CargarTrabajos(){
                axios.get('/trabajos')
                .then((response)=>{
                    this.trabajos = response.data.data
                })
                .catch((error)=>{
                    swal("Error!", "Algo anda mal" +"\n" + error.response.data.message, "warning");
                });
                 
            },
            Modificar(trabajo, index){
                this.modoEdicion = true;
                this.draft.id = trabajo.id;
                this.draft.descripcion = trabajo.descripcion;
                this.draft.estado = trabajo.estado;
                this.draft.trabajo = trabajo.trabajo;
                this.draft.area_trabajo = trabajo.area_trabajo;
                this.index = index;
                $('#ModalTrabajo').modal({show: true, keyboard: false, backdrop: 'static'});
            },
            Actualizar(){
                const parametros = {
                    id: this.draft.id,
                    descripcion: this.draft.descripcion,
                    estado: this.draft.estado,
                    trabajo: this.draft.trabajo,
                    area_trabajo: this.draft.area_trabajo,
                    index: this.index
                };
                axios.put('/trabajos/'+this.draft.id, parametros)
                    .then((response)=>{
                        this.trabajos.splice(response.data.index, 1, response.data.trabajo);
                        $('#ModalTrabajo').modal('hide');
                        swal(
                            'El trabajo fue actualizado exitosamente!',
                            'Trabajo fue actualizado!',
                            'success'
                        )
                        this.draft.id = '';
                        this.draft.descripcion = '';
                        this.draft.estado = '';
                        this.draft.trabajo = '';
                        this.draft.area_trabajo = '';
                        this.index = '';
                    })
                    .catch((error)=>{
                        swal("Error!", "Algo anda mal" +"\n" + error, "warning");
                    });
            },
            Agregar(){
                this.draft.id = '';
                this.draft.descripcion = '';
                this.draft.area_trabajo = '';
                this.draft.estado = '';
                this.draft.trabajo = '';
                this.modoEdicion = false;
                $('#ModalTrabajo').modal({show: true, keyboard: false, backdrop: 'static'});
            },
            Guardar(){
                const parametros = {
                    descripcion: this.draft.descripcion,
                    trabajo: this.draft.trabajo,
                    area_trabajo: this.draft.area_trabajo,
                };
                axios.post('/trabajos', parametros)
                     .then((response) => {
                         swal(
                            'El trabajo fue creado exitosamente!',
                            'Trabajo creado!',
                            'success'
                        )
                        this.trabajos.push(response.data)
                        this.draft.descripcion = '';
                        this.draft.trabajo = '';
                        this.draft.estado = '';
                        this.draft.area_trabajo = '';

                        
                }).catch((error)=> {
                    swal("Error!", "Algo anda mal", "warning");
                });
            },

            Cerrar(){
                this.draft.id = '';
                this.draft.descripcion = '';
                this.draft.area_trabajo = '';
                this.draft.estado = '';
                this.draft.trabajo = '';
            },
            Eliminar(trabajo, index){
                axios.delete('/trabajos/'+trabajo.id)
                    .then(()=>{
                        this.trabajos.splice(index,1);
                        swal(
                            'Eliminado!',
                            'El trabajo fue eliminado!',
                            'success'
                        )
                    }).catch(()=> {
                        swal("Error!", "Algo anda mal", "warning");
                });
            },
        }
      
    }
</script>
