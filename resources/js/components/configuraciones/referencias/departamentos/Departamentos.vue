<template>
<div class="card-body">
    <button type="button" class="btn btn-primary float-right" @click="Agregar()">
        <i class="fas fa-align-center" ></i>Agregar Departamento
    </button>
    <div class="modal fade" id="ModalDepartamento" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="ModalDepartamentoLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalDepartamentoLabel">Nuevo Registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-8">
                        <label>Descripcion</label>
                        <input type="text" class="form-control form-control-sm" v-model="draft.descripcion"> 
                    </div>
                    <div class="form-group col-md-4">
                        <label>Abreviatura</label>
                        <input type="text" class="form-control form-control-sm" v-model="draft.abreviatura"> 
                    </div>
                </div>
                <div class="row" v-show="modoEdicion">
                    <div class="form-group col-md-5">
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
                    <th>Abreviatura</th>
                    <th>Estado</th>
                    <th>Creado por</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <departamento-component v-for="(departamento, index) in departamentos" 
                    :key="departamento.id" 
                    :departamento="departamento" 
                    :index="index"
                    @modificar="Modificar"
                    @eliminar="Eliminar"
                    >                        
                </departamento-component> 
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
                departamentos:[],
                estados:[
                    {descripcion:'Activo', valor: true},
                    {descripcion:'Inactivo', valor: false}
                ],
                draft:{
                    id: '',
                    descripcion: '',
                    estado: '',
                    abreviatura: '',
                },
                index: '',
                modoEdicion: false,
            }
        },
        mounted() {
            this.CargarDepartamentos();

        },
        methods: {
            CargarDepartamentos(){
                axios.get('/departamentos')
                .then((response)=>{
                    this.departamentos = response.data.data
                })
                .catch((error)=>{
                    swal("Error!", "Algo anda mal" +"\n" + error.response.data.message, "warning");
                });
                 
            },
            Modificar(departamento, index){
                this.modoEdicion = true;
                this.draft.id = departamento.id;
                this.draft.descripcion = departamento.descripcion;
                this.draft.abreviatura = departamento.abreviatura;
                this.draft.estado = departamento.estado;
                this.index = index;
                $('#ModalDepartamento').modal({show: true, keyboard: false, backdrop: 'static'});
            },
            Actualizar(){
                const parametros = {
                    id: this.draft.id,
                    descripcion: this.draft.descripcion,
                    abreviatura: this.draft.abreviatura,
                    estado: this.draft.estado,
                    index: this.index
                };
                axios.put('/departamentos/'+this.draft.id, parametros)
                    .then((response)=>{
                        this.departamentos.splice(response.data.index, 1, response.data.departamento);
                        $('#ModalDepartamento').modal('hide');
                        swal(
                            'El departamento fue actualizado exitosamente!',
                            'Departamento fue actualizado!',
                            'success'
                        )
                        this.draft.id = '';
                        this.draft.descripcion = '';
                        this.draft.abreviatura = '';
                        this.draft.estado = '';
                        this.index = '';
                    })
                    .catch((error)=>{
                        swal("Error!", "Algo anda mal" +"\n" + error, "warning");
                    });
            },
            Agregar(){
                this.modoEdicion = false;
                $('#ModalDepartamento').modal({show: true, keyboard: false, backdrop: 'static'});
            },
            Guardar(){
                const parametros = {
                    descripcion: this.draft.descripcion,
                    abreviatura: this.draft.abreviatura,
                };
                axios.post('/departamentos', parametros)
                     .then((response) => {
                         swal(
                            'El departamento fue creado exitosamente!',
                            'Departamento creado!',
                            'success'
                        )
                        this.departamentos.push(response.data)
                        this.draft.descripcion = '';
                        this.draft.abreviatura = '';
                        this.draft.estado = '';
                        
                }).catch((error)=> {
                    swal("Error!", "Algo anda mal", "warning");
                });
            },

            Cerrar(){
                this.draft.id = '';
                this.draft.descripcion = '';
                this.draft.abreviatura = '';
                this.draft.estado = '';
            },
            Eliminar(departamento, index){
                axios.delete('/departamentos/'+departamento.id)
                    .then(()=>{
                        this.departamentos.splice(index,1);
                        swal(
                            'Eliminado!',
                            'El departamento fue eliminado!',
                            'success'
                        )
                    }).catch(()=> {
                        swal("Error!", "Algo anda mal", "warning");
                });
            },
        }
      
    }
</script>
