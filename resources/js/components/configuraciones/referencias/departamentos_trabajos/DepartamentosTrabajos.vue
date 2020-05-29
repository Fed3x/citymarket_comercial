<template>
<div class="card-body">
    <button type="button" class="btn btn-primary float-right" @click="Agregar()">
        <i class="fas fa-align-center" ></i>Nueva Asignacion
    </button>

    <div class="modal fade" id="TrabajoDepartamento" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="TrabajoDepartamentoLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TrabajoDepartamentoLabel">Asignar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label>Trabajo</label>
                <input v-if="modoEdicion" type="text" class="form-control form-control-sm" v-model="draft.trabajo_descripcion" disabled>
                <v-select v-else label="descripcion" :options="trabajos_sin_d" :reduce="trabajos_sin_d => trabajos_sin_d.id" v-model="draft.trabajo_id"></v-select>
                <br>
                <label>Departamentos</label>
                <div v-for="(departamento) in departamentos" :key="departamento.id">
                    <div class="form-check form-control-sm">
                        <input type="checkbox" v-model="draft.departamentos" :value="departamento.id">
                        <label class="form-check-label">
                        {{departamento.descripcion}}
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
                    <th>Departamentos Asignados</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <departamento-trabajo-component v-for="(departamento_trabajo, index) in departamentos_trabajos" 
                    :key="departamento_trabajo.id" 
                    :departamento_trabajo="departamento_trabajo" 
                    :index="index"
                    :departamentos="departamentos"
                    @modificar="Modificar"
                    @eliminar="Eliminar"
                    >                        
                </departamento-trabajo-component> 
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
                trabajos_sin_d:[],
                departamentos_trabajos:[],
                departamentos:[],
                draft:{
                    trabajo_id: '',
                    trabajo_descripcion: '',
                    departamentos: [],
                },
                index: '',
                modoEdicion: false,
            }
        },
        mounted() {
            this.CargarDepartamentosTrabajos();
           
        },
        methods: {
            CargarDepartamentosTrabajos(){
                axios.get('/departamentos_trabajos')
                .then((response)=>{
                    this.departamentos_trabajos = response.data.trabajos;
                    this.departamentos = response.data.departamentos;
                    this.trabajos_sin_d = response.data.trabajos_sin_d;
                })
                .catch((error)=>{
                    swal("Error!", "Algo anda mal" +"\n" + error.response.data.message, "warning");
                });
                 
            },
            Modificar(trabajo, index){
                this.draft.trabajo_id = '';
                this.draft.trabajo_descripcion = '';
                this.draft.departamentos = [];
                this.modoEdicion = true;
                this.draft.trabajo_id = trabajo.id;
                this.draft.trabajo_descripcion = trabajo.descripcion;
                this.index = index;
                if (trabajo.departamentos.length > 0 ) {
                    this.draft.departamentos.push(trabajo.departamentos[0].id)
                    if (trabajo.departamentos.length > 1) {
                        for (let i = 1; i < trabajo.departamentos.length; i++) {
                            this.draft.departamentos.push(trabajo.departamentos[i].id)
                        }
                    }
                }

                $('#TrabajoDepartamento').modal({show: true, keyboard: false, backdrop: 'static'});

            },

            Actualizar(){
                const parametros = {
                    departamentos: this.draft.departamentos,
                    index: this.index
                };
                axios.put('/departamentos_trabajos/'+this.draft.trabajo_id, parametros)
                    .then((response)=>{
                        this.departamentos_trabajos.splice(response.data.index, 1, response.data.trabajo);
                        $('#TrabajoDepartamento').modal('hide');
                        swal(
                            'Asignacion actualizada exitosamente!',
                            'La asignacion fue actualizada!',
                            'success'
                        )
                        this.draft.trabajo_id = '';
                        this.draft.departamentos = [];
                    })
                    .catch((error)=>{
                        swal("Error!", "Algo anda mal" +"\n" + error, "warning");
                    });
            },
            Agregar(){
                this.draft.trabajo_id = '';
                this.draft.departamentos = [];
                this.modoEdicion = false;
                $('#TrabajoDepartamento').modal({show: true, keyboard: false, backdrop: 'static'});
            },
            Guardar(){
                const parametros = {
                    trabajo_id: this.draft.trabajo_id,
                    departamentos: this.draft.departamentos
                };
                axios.post('/departamentos_trabajos', parametros)
                     .then((response) => {
                        this.departamentos_trabajos.push(response.data.trabajo)
                        this.trabajos_sin_d = response.data.trabajos_sin_d;
                        swal(
                            'Nueva asignacion creada exitosamente!',
                            'La asignacion fue guardada!',
                            'success'
                        )
                        this.draft.trabajo_id = '';
                        this.draft.departamentos = [];
                }).catch((error)=> {
                    swal("Error!", "Algo anda mal", "warning");
                });
            },

            Cerrar(){
                this.draft.trabajo_id = '';
                this.draft.trabajo_descripcion = '';
                this.draft.departamentos = [];
            },
            Eliminar(trabajo, index){
                axios.delete('/departamentos_trabajos/'+trabajo.id)
                    .then(()=>{
                        this.trabajos_sin_d = response.data.trabajos_sin_d;
                        this.departamentos_trabajos.splice(index,1);
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
