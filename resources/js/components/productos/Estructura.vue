<template>
    <tr>
        <th>{{index+1}}</th>
        <td>{{estructura.producto.codigo_barras}}</td>
        <td>{{estructura.producto.descripcion}}</td>
        <td>{{estructura.nivel.descripcion}}</td>
        <td>{{estructura.dias_stock}}</td>
        <td>{{estructura.stock_minimo}}</td>
        <td>{{estructura.micropicking}}</td>
        <td class="col-sm-1" v-if="modoEdicion"><a href="#" v-on:click="detalle_rendicion.id == null ? Agregar():Actualizar()" data-toggle="tooltip" data-placement="auto" title="Guardar registro" ><i class="fas fa-save text-primary fa-lg"></i></a><b> | </b> <a href="#" v-on:click="Eliminar()" data-toggle="tooltip" data-placement="auto" title="Eliminar registro" ><i class="fas fa-trash-alt text-danger fa-lg"></i>  </a></td>
        <td class="col-sm-1" v-else><a href="#" v-on:click="Modificar()" data-toggle="tooltip" data-placement="auto" title="Modificar registro" ><i class="fas fa-edit text-success fa-lg"></i></a><b> | </b> <a href="#" v-on:click="Eliminar()" data-toggle="tooltip" data-placement="auto" title="Eliminar registro" ><i class="fas fa-trash-alt text-danger fa-lg"></i>  </a></td>
        
    </tr>
</template>

<script>
    import Vue from 'vue'
    import EventBus from "../event-bus"

    import vSelect from 'vue-select'

    Vue.component('v-select', vSelect)
    import 'vue-select/dist/vue-select.css';

    export default {
        props: ['estructura', 'index'],
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
                modoEdicion: false
            }
        },
        mounted() {

        },
        methods: {
            VerFlota(){
                // EventBus.$emit('flota', this.user);
                 
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
