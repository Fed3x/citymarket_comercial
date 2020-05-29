<template>
<div class="card-body">
    <button type="button" class="btn btn-primary float-right" @click="Agregar()">
        <i class="fas fa-align-center" ></i>Agregar Perfil
    </button>
    <div class="modal fade" id="ModalPerfil" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="ModalPerfilLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalPerfilLabel">Nuevo Registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Descripcion</label>
                        <input type="text" class="form-control form-control-sm" v-model="draft.descripcion"> 
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-7">
                        <label>Departamento</label>
                        <v-select label="descripcion" :options="departamentos" :reduce="departamentos => departamentos.id" v-model="draft.id_departamento"></v-select>
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
                    <th>Departamento</th>
                    <th>Estado</th>
                    <th>Creado por</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <perfil-component v-for="(perfil, index) in perfiles" 
                    :key="perfil.id" 
                    :perfil="perfil" 
                    :index="index"
                    @modificar="Modificar"
                    @eliminar="Eliminar"
                    >                        
                </perfil-component> 
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
                perfiles:[],
                departamentos: [],
                estados:[
                    {descripcion:'Activo', valor: true},
                    {descripcion:'Inactivo', valor: false}
                ],
                draft:{
                    id: '',
                    descripcion: '',
                    estado: '',
                    id_departamento: '',
                },
                index: '',
                modoEdicion: false,
            }
        },
        mounted() {
            this.CargarPerfiles();
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
            CargarPerfiles(){
                axios.get('/perfiles')
                .then((response)=>{
                    this.perfiles = response.data.data
                })
                .catch((error)=>{
                    swal("Error!", "Algo anda mal" +"\n" + error.response.data.message, "warning");
                });
                 
            },
            Modificar(perfil, index){
                this.modoEdicion = true;
                this.draft.id = perfil.id;
                this.draft.descripcion = perfil.descripcion;
                this.draft.id_departamento = perfil.id_departamento;
                this.draft.estado = perfil.estado;
                this.index = index;
                $('#ModalPerfil').modal({show: true, keyboard: false, backdrop: 'static'});
            },
            Actualizar(){
                const parametros = {
                    id: this.draft.id,
                    descripcion: this.draft.descripcion,
                    estado: this.draft.estado,
                    id_departamento: this.draft.id_departamento,
                    index: this.index
                };
                axios.put('/perfiles/'+this.draft.id, parametros)
                    .then((response)=>{
                        this.perfiles.splice(response.data.index, 1, response.data.perfil);
                        $('#ModalPerfil').modal('hide');
                        swal(
                            'El perfil fue actualizado exitosamente!',
                            'Perfil actualizado!',
                            'success'
                        )
                        this.draft.id = '';
                        this.draft.descripcion = '';
                        this.draft.estado = '';
                        this.draft.id_departamento = '';
                        this.index = '';
                    })
                    .catch((error)=>{
                        swal("Error!", "Algo anda mal" +"\n" + error, "warning");
                    });
            },
            Agregar(){
                this.modoEdicion = false;
                $('#ModalPerfil').modal({show: true, keyboard: false, backdrop: 'static'});
            },
            Guardar(){
                const parametros = {
                    descripcion: this.draft.descripcion,
                    id_departamento: this.draft.id_departamento,
                };
                axios.post('/perfiles', parametros)
                     .then((response) => {
                         swal(
                            'El perfil fue creado exitosamente!',
                            'Perfil creado!',
                            'success'
                        )
                        this.perfiles.push(response.data)
                        this.draft.descripcion = '';
                        this.draft.id_departamento = '';
                        this.draft.estado = '';
                        
                }).catch((error)=> {
                    swal("Error!", "Algo anda mal", "warning");
                });
            },

            Cerrar(){
                this.draft.descripcion = '';       
                this.draft.id_departamento = '';     
                this.draft.estado = '';
            },
            Eliminar(perfil, index){
                axios.delete('/perfiles/'+perfil.id)
                    .then(()=>{
                        this.perfiles.splice(index,1);
                    }).catch(()=> {
                        swal("Error!", "Algo anda mal", "warning");
                });
                swal(
                    'Eliminado!',
                    'El perfil fue eliminado!',
                    'success'
                )
            },
        }
      
    }
</script>
