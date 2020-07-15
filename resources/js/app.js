
require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

//FILTERS
// Vue.component('filters-component', require('./components/filters/Filter.vue').default);


//REPORTS
Vue.component('reportes-component', require('./components/reportes/Reportes.vue').default);


//USUARIO

// Vue.component('flota-component', require('./components/user/FlotaComponent.vue').default);
// Vue.component('perfil-component', require('./components/user/PerfilComponent.vue').default);
Vue.component('nav-usuario-component', require('./components/user/NavUsuarioComponent.vue').default); 

//CONFIGURACIONES
    //PRODUCTOS
        //ESTRUCTURAS
        Vue.component('estructuras-component', require('./components/productos/Estructuras.vue').default);
        Vue.component('estructura-component', require('./components/productos/Estructura.vue').default);

    // REFERENCIAS
        // DEPARTAMENTOS
            Vue.component('departamento-component', require('./components/configuraciones/referencias/departamentos/Departamento.vue').default);
            Vue.component('departamentos-component', require('./components/configuraciones/referencias/departamentos/Departamentos.vue').default);

        // DEPARTAMENTOS_TRABAJOS
            Vue.component('departamento-trabajo-component', require('./components/configuraciones/referencias/departamentos_trabajos/DepartamentoTrabajo.vue').default);
            Vue.component('departamentos-trabajos-component', require('./components/configuraciones/referencias/departamentos_trabajos/DepartamentosTrabajos.vue').default);

        // TRABAJOS
            Vue.component('trabajo-component', require('./components/configuraciones/referencias/trabajos/Trabajo.vue').default);
            Vue.component('trabajos-component', require('./components/configuraciones/referencias/trabajos/Trabajos.vue').default);

    // USUARIOS Y PERFILES
    
        // USUARIOS
            Vue.component('usuarios-component', require('./components/configuraciones/usuarios_perfiles/usuarios/Usuarios.vue').default);
            Vue.component('usuario-component', require('./components/configuraciones/usuarios_perfiles/usuarios/Usuario.vue').default);

        // PERFILES
            Vue.component('perfil-component', require('./components/configuraciones/usuarios_perfiles/perfiles/Perfil.vue').default);
            Vue.component('perfiles-component', require('./components/configuraciones/usuarios_perfiles/perfiles/Perfiles.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import swal from 'sweetalert'
window.swal = swal;

// const toast = swal.mixin({
//     toast: true,
//     position: 'top-end',
//     showConfirmButton: false,
//     timer: 3000
// });

// window.toast = toast;



const app = new Vue({
    el: '#app',
});



