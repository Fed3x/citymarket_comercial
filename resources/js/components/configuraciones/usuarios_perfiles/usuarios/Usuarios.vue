<template>
<div class="card-body">
    <button type="button" class="btn btn-primary float-right" @click="Agregar()">
        <i class="fas fa-align-center" ></i>Agregar Usuario
    </button>
    <div class="modal fade" id="ModalUsuario" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="ModalUsuarioLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalUsuarioLabel">Nuevo Registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Usuario</label>
                        <input type="text" class="form-control form-control-sm" v-model="draft.usuario"> 
                    </div>
                    <div class="form-group col-md-6">
                        <label>Email</label>
                        <input type="text" class="form-control form-control-sm" v-model="draft.email"> 
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-7">
                        <label>Perfil</label>
                        <v-select label="descripcion" :options="perfiles" :reduce="perfiles => perfiles.id" v-model="draft.id_perfil"></v-select>
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
                    <th>Usuario</th>
                    <th>Email</th>
                    <th>Estado</th>
                    <th>Perfil</th>
                    <th>Creado el</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <usuario-component v-for="(usuario, index) in usuarios" 
                    :key="usuario.id" 
                    :usuario="usuario" 
                    :index="index"
                    @modificar="Modificar"
                    @eliminar="Eliminar">                        
                </usuario-component> 
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
        // props: [''],
        created() {
            
        },
        data(){
            return{
                usuarios:[],
                perfiles:[],
                 estados:[
                    {descripcion:'Activo', valor: true},
                    {descripcion:'Inactivo', valor: false}
                ],
                draft:{
                    id: '',
                    usuario: '',
                    email: '',
                    password: '',
                    id_perfil: '',
                    estado: '',
                },
                modoEdicion: false,
                index: '',
            }
        },
        mounted() {
            this.CargarUsuarios();
            this.CargarPerfiles();

        },
        methods: {
            CargarUsuarios(){
                axios.get('/usuarios')
                .then((response)=>{
                    this.usuarios = response.data.data
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
            Modificar(usuario, index){
                this.modoEdicion = true;
                this.draft.id = usuario.id;
                this.draft.usuario = usuario.name;
                this.draft.email = usuario.email;
                this.draft.id_perfil = usuario.id_perfil;
                this.draft.estado = usuario.estado;
                this.index = index;
                $('#ModalUsuario').modal({show: true, keyboard: false, backdrop: 'static'});
            },
            Actualizar(){
                const parametros = {
                    id: this.draft.id,
                    usuario: this.draft.usuario,
                    email: this.draft.email,
                    estado: this.draft.estado,
                    id_perfil: this.draft.id_perfil,
                    index: this.index
                };
                axios.put('/usuarios/'+this.draft.id, parametros)
                    .then((response)=>{
                        this.usuarios.splice(response.data.index, 1, response.data.usuario);
                        $('#ModalUsuario').modal('hide');
                        swal(
                            'El usuario fue actualizado exitosamente!',
                            'Usuario actualizado!',
                            'success'
                        )
                        this.draft.id = '';
                        this.draft.usuario = '';
                        this.draft.email = '';
                        this.draft.estado = '';
                        this.draft.id_perfil = '';
                        this.index = '';
                    })
                    .catch((error)=>{
                        swal("Error!", "Algo anda mal" +"\n" + error, "warning");
                    });
            },
            Agregar(){
                this.modoEdicion = false;
                $('#ModalUsuario').modal({show: true, keyboard: false, backdrop: 'static'});
            },
            Guardar(){
                const parametros = {
                    usuario: this.draft.usuario,
                    email: this.draft.email,
                    id_perfil: this.draft.id_perfil,
                };

                axios.post('/usuarios', parametros)
                     .then((response) => {
                         swal(
                            'El usuario fue creado exitosamente!',
                            'Usuario creado!',
                            'success'
                        )
                        this.usuarios.push(response.data)
                        this.draft.usuario = '';
                        this.draft.id_perfil = '';
                        this.draft.email = '';
                        this.draft.estado = '';
                        
                }).catch((error)=> {
                    swal("Error!", "Algo anda mal", "warning");
                });
            },

            Cerrar(){
                this.draft.usuario = '';       
                this.draft.id_perfil = '';     
                this.draft.estado = '';
                this.draft.email = '';
            },
            Eliminar(usuario, index){
                axios.delete('/usuarios/'+usuario.id)
                    .then(()=>{
                        this.usuarios.splice(index,1);
                        swal(
                            'Eliminado!',
                            'El usuario fue eliminado!',
                            'success'
                        )
                    }).catch(()=> {
                        swal("Error!", "Algo anda mal", "warning");
                });

            },
        }
      
    }
</script>
