<template>
<div class="card-body">
    <button type="button" class="btn btn-primary float-right" @click="Agregar()">
        <i class="fas fa-align-center" ></i>Nueva Asignacion
    </button>

    <div class="modal fade" id="TrabajoParametro" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="TrabajoParametroLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TrabajoParametroLabel">Asignar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label>Trabajo</label>
                <input v-if="modoEdicion" type="text" class="form-control form-control-sm" v-model="draft.trabajo_descripcion" disabled>
                <v-select v-else label="descripcion" :options="trabajos_sin_p" :reduce="trabajos_sin_p => trabajos_sin_p.id" v-model="draft.trabajo_id"></v-select>
                <br>
                <label>Parametros</label>
                <div v-for="(parametro) in parametros" :key="parametro.id">
                    <div class="form-check form-control-sm">
                        <input type="checkbox" v-model="draft.parametros" :value="parametro.id">
                        <label class="form-check-label">
                        {{parametro.descripcion}}
                        </label>
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
                    <th>Parametros Asignados</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <parametro-trabajo-component v-for="(parametro_trabajo, index) in parametros_trabajos" 
                    :key="parametro_trabajo.id" 
                    :parametro_trabajo="parametro_trabajo" 
                    :index="index"
                    :parametros="parametros"
                    @modificar="Modificar"
                    @eliminar="Eliminar"
                    >                        
                </parametro-trabajo-component> 
            </tbody>
        </table>
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
                trabajos_sin_p:[],
                parametros_trabajos:[],
                parametros:[],
                draft:{
                    trabajo_id: '',
                    trabajo_descripcion: '',
                    parametros: [],
                },
                index: '',
                modoEdicion: false,
            }
        },
        mounted() {
            this.CargarParametrosTrabajos();
           
        },
        methods: {
            CargarParametrosTrabajos(){
                axios.get('/parametros_trabajos')
                .then((response)=>{
                    this.parametros_trabajos = response.data.trabajos;
                    this.parametros = response.data.parametros;
                    this.trabajos_sin_p = response.data.trabajos_sin_p;
                })
                .catch((error)=>{
                    swal("Error!", "Algo anda mal" +"\n" + error.response.data.message, "warning");
                });
                 
            },
            Modificar(trabajo, index){
                this.draft.trabajo_id = '';
                this.draft.trabajo_descripcion = '';
                this.draft.parametros = [];
                this.modoEdicion = true;
                this.draft.trabajo_id = trabajo.id;
                this.draft.trabajo_descripcion = trabajo.descripcion;
                this.index = index;
                if (trabajo.parametros.length > 0 ) {
                    this.draft.parametros.push(trabajo.parametros[0].id)
                    if (trabajo.parametros.length > 1) {
                        for (let i = 1; i < trabajo.parametros.length; i++) {
                            this.draft.parametros.push(trabajo.parametros[i].id)
                        }
                    }
                }

                $('#TrabajoParametro').modal({show: true, keyboard: false, backdrop: 'static'});

            },

            Actualizar(){
                const parametros = {
                    parametros: this.draft.parametros,
                    index: this.index
                };
                axios.put('/parametros_trabajos/'+this.draft.trabajo_id, parametros)
                    .then((response)=>{
                        this.parametros_trabajos.splice(response.data.index, 1, response.data.trabajo);
                        $('#TrabajoParametro').modal('hide');
                        swal(
                            'Asignacion actualizada exitosamente!',
                            'La asignacion fue actualizada!',
                            'success'
                        )
                        this.draft.trabajo_id = '';
                        this.draft.parametros = [];
                    })
                    .catch((error)=>{
                        swal("Error!", "Algo anda mal" +"\n" + error, "warning");
                    });
            },
            Agregar(){
                this.draft.trabajo_id = '';
                this.draft.parametros = [];
                this.modoEdicion = false;
                $('#TrabajoParametro').modal({show: true, keyboard: false, backdrop: 'static'});
            },
            Guardar(){
                const parametros = {
                    trabajo_id: this.draft.trabajo_id,
                    parametros: this.draft.parametros
                };
                axios.post('/parametros_trabajos', parametros)
                     .then((response) => {
                        this.parametros_trabajos.push(response.data.trabajo)
                        this.trabajos_sin_p = response.data.trabajos_sin_p;
                        swal(
                            'Nueva asignacion creada exitosamente!',
                            'La asignacion fue guardada!',
                            'success'
                        )
                        this.draft.trabajo_id = '';
                        this.draft.parametros = [];
                }).catch((error)=> {
                    swal("Error!", "Algo anda mal", "warning");
                });
            },

            Cerrar(){
                this.draft.trabajo_id = '';
                this.draft.trabajo_descripcion = '';
                this.draft.parametros = [];
            },
            Eliminar(trabajo, index){
                
                axios.delete('/parametros_trabajos/'+trabajo.id)
                    .then((response)=>{
                        this.trabajos_sin_p = response.data.trabajos_sin_p;
                        this.parametros_trabajos.splice(index,1);
                        swal(
                            'Eliminada!',
                            'La asignacion fue eliminada!',
                            'success'
                        )
                    }).catch((error)=> {
                        swal("Error!", "Algo anda mal", "warning");
                });

            },
        }
      
    }
</script>
