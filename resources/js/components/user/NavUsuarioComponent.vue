<template>
    <div>
        <ul class="navbar-nav">
        <li class="nav-item dropdown active">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                <i class="fas fa-user-circle"> {{user.name}}</i>
            </a>
            <div class="dropdown-menu text-center menu-user" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="/logout">Cerrar Sesion</a>
            </div>
        </li>
        </ul>
        <!-- <flota-component></flota-component>
        <agregar-component></agregar-component> -->
    </div>
</template>

<script>
    import Vue from 'vue'
    import EventBus from "../event-bus"

    import vSelect from 'vue-select'

    Vue.component('v-select', vSelect)
    import 'vue-select/dist/vue-select.css';

    export default {
        props: ['user'],
        created: function() {
            // if (this.distancia.id == null){ 
            //     this.Modificar();
            // }
            // EventBus.$on('modificando', function(index){
            //     if (this.index != index){
            //         this.modoEdicion = false;
            //     }
            // }.bind(this));
        },
        data(){
            return{

            }
        },
        mounted() {

        },
        methods: {
            VerFlota(){
                EventBus.$emit('flota', this.user);
                 
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
<style>

</style>
