<template>
    <tr>
        <th>{{index+1}}</th>
        <td>{{parametro_trabajo.descripcion}}</td>
        <td v-if="parametro_trabajo.parametros.length">{{listarParametros}}</td>
        <td v-else>Sin parametros</td>
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
        props: ['parametro_trabajo','parametros', 'index'],
        created: function() {

        },
        data(){
            return{
            }
        },
        computed:{
            listarParametros() {
                let parametro_trabajo = this.parametro_trabajo;
                let listarParametros

                if (parametro_trabajo.parametros.length > 0 ) {
                    listarParametros= parametro_trabajo.parametros[0].descripcion;
                    if (parametro_trabajo.parametros.length > 1) {
                        for (let i = 1; i < parametro_trabajo.parametros.length; i++) {
                            listarParametros= listarParametros+ ', ' + parametro_trabajo.parametros[i].descripcion;
                        }
                    }

                }
                return listarParametros 
            }
        },
        mounted() {
        },
        methods: {
            Modificar(){
                this.$emit('modificar', this.parametro_trabajo, this.index);
            },
            Eliminar(){
                this.$emit('eliminar', this.parametro_trabajo, this.index);
            },
        }
      
    }
</script>
