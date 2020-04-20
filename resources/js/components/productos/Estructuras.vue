<template>
<div class="card-body">
    <button @click="AgregarDistancia()" class="btn btn-primary float-right" type="button"><i class="fas fa-align-center"></i> Agregar Registro</button>
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
        // props: ['user'],
        created() {
            
        },
        data(){
            return{
                estructuras:[],
                productos_sin_e:[],
            }
        },
        mounted() {
            this.CargarEstructuras();
            this.CargarProductosSinEstructuras();
        },
        methods: {
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
                    this.productos_sin_e = response.data.data
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
