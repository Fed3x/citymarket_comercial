<template>
    <tr>
        <th>{{index+1}}</th>
        <td>{{departamento_trabajo.descripcion}}</td>
        <td v-if="departamento_trabajo.departamentos.length">{{listarDepartamentos}}</td>
        <td v-else>Sin grupo</td>
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
        props: ['departamento_trabajo','departamentos', 'index'],
        created: function() {

        },
        data(){
            return{
            }
        },
        computed:{
            listarDepartamentos () {
                let departamento_trabajo = this.departamento_trabajo;
                let listarDepartamentos;

                if (departamento_trabajo.departamentos.length > 0 ) {
                    listarDepartamentos = departamento_trabajo.departamentos[0].descripcion;
                    if (departamento_trabajo.departamentos.length > 1) {
                        for (let i = 1; i < departamento_trabajo.departamentos.length; i++) {
                            listarDepartamentos = listarDepartamentos + ', ' + departamento_trabajo.departamentos[i].descripcion;
                        }
                    }

                }
                return listarDepartamentos; 
            }
        },
        mounted() {
        },
        methods: {
            Modificar(){
                this.$emit('modificar', this.departamento_trabajo, this.index);
            },
            Eliminar(){
                this.$emit('eliminar', this.departamento_trabajo, this.index);
            },
        }
      
    }
</script>
