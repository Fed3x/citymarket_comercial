<template>
    <tr>
        <th>{{index+1}}</th>
        <td>{{trabajo.descripcion}}</td>
        <td>{{trabajo.trabajo}}</td>
        <td>{{trabajo.area_trabajo}}</td>
        <td v-if="trabajo.estado"><span class="badge badge-success">Activo</span></td>
        <td v-else><span class="badge badge-secondary">Inactivo</span></td>
        <td> {{trabajo.created_by}}</td>
        <td><a href="#" v-on:click="Modificar()" data-toggle="tooltip" data-placement="auto" title="Modificar registro" ><i class="fas fa-edit text-success fa-lg"></i></a><b> | </b> <a href="#" v-on:click="Eliminar()" data-toggle="tooltip" data-placement="auto" title="Eliminar registro" ><i class="fas fa-trash-alt text-danger fa-lg"></i>  </a></td>
        
    </tr>
</template>

<script>
    import Vue from 'vue'
    import EventBus from "../../../event-bus"

    import vSelect from 'vue-select'

    Vue.component('v-select', vSelect)
    import 'vue-select/dist/vue-select.css';

    export default {
        props: ['trabajo', 'index'],
        created() {

        },
        data(){
            return{
            }
        },
        mounted() {

        },
        methods: {
            Modificar(){
                this.$emit('modificar', this.trabajo, this.index);
            },
            Eliminar(){
                this.$emit('eliminar', this.trabajo, this.index);
            },
        }
      
    }
</script>
