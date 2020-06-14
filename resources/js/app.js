/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router'
Vue.use(VueRouter)

import {
    Form,
    HasError,
    AlertError
} from 'vform';

//import Alert
import Swal from 'sweetalert2'
window.Swal = Swal;
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});
window.Toast = Toast;

window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

//Progress Bar
import VueProgressBar from 'vue-progressbar'
Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '7px'
})

let Fire = new Vue();
window.Fire = Fire;

let routes = [
    {path:'/tambah-blog', component: require('./components/Blog/TambahBlog.vue').default},
    {path:'/data-blog', component: require('./components/Blog/DataBlog.vue').default},
    {path:'/user', component: require('./components/Blog/User.vue').default},
    {path:'/category', component: require('./components/Blog/Category.vue').default},
    {path:'/masuk', component: require('./components/masuk.vue').default},
    {path:'/daftar', component: require('./components/daftar.vue').default}
]

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const router = new VueRouter({
    mode: 'history',
    routes
})

const app = new Vue({
    el: '#app',
    router
});
