<template>
    <div class="container">   
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Flota</div>
                    <div class="card-body">
                        <form>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                <label for="inputBrand">Marca</label>
                                <input type="text" class="form-control" id="inputBrand">
                                </div>
                                <div class="form-group col-md-12">
                                <label for="inputModel">Modelo</label>
                                <input type="text" class="form-control" id="inputModel">
                                </div>
                                <div class="form-group col-md-12">
                                <label for="inputPatent">Patente</label>
                                <input type="text" class="form-control" id="inputPatent">
                                </div>
                                <div class="form-group col-md-12">
                                <label for="inputYear">Año</label>
                                <input type="number" class="form-control" id="inputYear">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Sign in</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    import Vue from 'vue'
    var EventBus = new Vue

    import vSelect from 'vue-select'

    Vue.component('v-select', vSelect)
    import 'vue-select/dist/vue-select.css';


    export default {
        props: ['distancia','index','sitios'],
        created: function() {
            if (this.distancia.id == null){ 
                this.Modificar();
            }
            EventBus.$on('modificando', function(index){
                if (this.index != index){
                    this.modoEdicion = false;
                }
            }.bind(this));
        },
        data(){
            return{
                modoEdicion: false,
                draft:[{
                    id_sitio_desde: '',
                    id_sitio_hasta: '',
                    kilometraje: ''
                }],
            }
        },
        mounted() {

        },
        methods: {
            Modificar(){
                EventBus.$emit('modificando', this.index);
                this.modoEdicion = true;
                this.draft.id_sitio_desde = this.distancia.id_sitio_desde;
                this.draft.id_sitio_hasta = this.distancia.id_sitio_hasta;
                this.draft.kilometraje = this.distancia.kilometraje;
            },
            Actualizar(){
                const parametros = {
                    id_sitio_desde: this.draft.id_sitio_desde,
                    id_sitio_hasta: this.draft.id_sitio_hasta,
                    kilometraje: this.draft.kilometraje
                };
                
                axios.put('/distancia/'+this.distancia.id, parametros)
                    .then((response)=>{
                        this.modoEdicion = false;
                        this.$emit('actualizar', response.data, this.index);
                    })
                    .catch((error)=>{
                        swal("Error!", "Algo anda mal" +"\n" + error.response.data.message, "warning");
                    });
            },
            Agregar(){
                const parametros = {
                    id_sitio_desde: this.draft.id_sitio_desde,
                    id_sitio_hasta: this.draft.id_sitio_hasta,
                    kilometraje: this.draft.kilometraje
                };
                axios.post('/distancia', parametros)
                     .then((response) => {
                         this.modoEdicion = false;
                         this.$emit('nuevo', response.data, this.index);
                    
                }).catch((error)=> {
                    
                    swal("Error!", "Algo anda mal", "warning");
                });
            },
            Eliminar(){
                if (this.distancia.id != null){

                    axios.delete('/distancia/'+this.distancia.id)
                    .then(()=>{
                        this.$emit('eliminar', this.index);

                    }).catch(()=> {
                        swal("Error!", "Algo anda mal", "warning");
                });
                }else{
                    this.$emit('eliminar', this.index);
                }
                swal(
                    'Eliminado!',
                    'La distancia fue eliminada!',
                    'success'
                )
            },
        }
      
    }
</script>
