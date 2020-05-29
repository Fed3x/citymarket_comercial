<template>
<div class="card-body">
    <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#AgregarRegistro">
        <i class="fas fa-align-center" ></i>Agregar Registro
    </button>
    <div class="modal fade" id="AgregarRegistro" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="AgregarRegistroLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AgregarRegistroLabel">Nuevo Registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-6">
                    <label>Codigo de Barras</label>
                    <v-select label="codigo_barras" placeholder="Codigo de Barras" :options="productos_sin_e" :reduce="productos_sin_e => productos_sin_e.identificador"  v-model="draft.id_producto"></v-select>
                </div>
                <div class="form-group col-md-12">
                    <label>Descripcion</label>
                    <input type="text" class="form-control" disabled>
                </div>
                </div>
                
                <div class="row">
                <div class="form-group col-md-6">
                    <label for="inputAddress">Nivel</label>
                    <v-select label="codigo_barras" placeholder="Codigo de Barras" :options="productos_sin_e" :reduce="productos_sin_e => productos_sin_e.identificador"  v-model="draft.id_nivel"></v-select>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputAddress2">Dias de Stock</label>
                    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor" v-model="draft.dias_stock">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputAddress2">Stock Minimo</label>
                    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor" v-model="draft.stock_minimo">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputAddress2">Micropicking</label>
                    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor" v-model="draft.micropicking">
                </div>
                </div>

    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" @click="HolaRegistro()">Understood</button>
            </div>
            </div>
        </div>
    </div>
    <div class="table-responsive-sm">
        <table class="table table-hover table-borderless table-sm text-center">
            <thead class="thead">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Codigo de Barras</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Nivel</th>
                    <th scope="col">Dias de Stock</th>
                    <th scope="col">Stock Minimo</th>
                    <th scope="col">Micropicking</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <estructura-component v-for="(estructura, index) in estructuras" 
                    :key="estructura.id" 
                    :estructura="estructura" 
                    :index="index">                        
                </estructura-component> 
            </tbody>
        </table>
        <div class="container">
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
        // props: [''],
        created() {
            
        },
        data(){
            return{
                estructuras:[],
                productos_sin_e:[],
                producto: '',
                draft:{
                    id_producto: '',
                    id_nivel: '',
                    dias_stock: '',
                    stock_minimo: '',
                    micropicking: ''
                },
            }
        },
        mounted() {
            this.CargarEstructuras();
            this.CargarProductosSinEstructuras();
            console.log(this.productos_sin_e);
        },
        methods: {
            HolaRegistro(){
                console.log(this.draft);
            },
            CargarEstructuras(){
                axios.get('/api/estructura')
                .then((response)=>{
                    this.estructuras = response.data.data
                })
                .catch((error)=>{
                    swal("Error!", "Algo anda mal" +"\n" + error.response.data.message, "warning");
                });
                 
            },
            CargarProductosSinEstructuras(){
                axios.get('/productos_sin_estructura')
                .then((response)=>{
                    console.log(response);
                    this.productos_sin_e = response.data
                })
                .catch((error)=>{
                    swal("Error!", "Algo anda mal" +"\n" + error.response.data.message, "warning");
                });
                 
            },
            // Modificar(){
            //     EventBus.$emit('modificando', this.index);
            //     this.modoEdicion = true;
            //     this.draft.id_sitio_desde = this.distancia.id_sitio_desde;
            //     this.draft.id_sitio_hasta = this.distancia.id_sitio_hasta;
            //     this.draft.kilometraje = this.distancia.kilometraje;
            // },
            // Actualizar(){
            //     const parametros = {
            //         id_sitio_desde: this.draft.id_sitio_desde,
            //         id_sitio_hasta: this.draft.id_sitio_hasta,
            //         kilometraje: this.draft.kilometraje
            //     };
                
            //     axios.put('/distancia/'+this.distancia.id, parametros)
            //         .then((response)=>{
            //             this.modoEdicion = false;
            //             this.$emit('actualizar', response.data, this.index);
            //         })
            //         .catch((error)=>{
            //             swal("Error!", "Algo anda mal" +"\n" + error.response.data.message, "warning");
            //         });
            // },
            // Agregar(){
            //     const parametros = {
            //         id_sitio_desde: this.draft.id_sitio_desde,
            //         id_sitio_hasta: this.draft.id_sitio_hasta,
            //         kilometraje: this.draft.kilometraje
            //     };
            //     axios.post('/distancia', parametros)
            //          .then((response) => {
            //              this.modoEdicion = false;
            //              this.$emit('nuevo', response.data, this.index);
                    
            //     }).catch((error)=> {
                    
            //         swal("Error!", "Algo anda mal", "warning");
            //     });
            // },
            // Eliminar(){
            //     if (this.distancia.id != null){

            //         axios.delete('/distancia/'+this.distancia.id)
            //         .then(()=>{
            //             this.$emit('eliminar', this.index);

            //         }).catch(()=> {
            //             swal("Error!", "Algo anda mal", "warning");
            //     });
            //     }else{
            //         this.$emit('eliminar', this.index);
            //     }
            //     swal(
            //         'Eliminado!',
            //         'La distancia fue eliminada!',
            //         'success'
            //     )
            // },
        }
      
    }
</script>
