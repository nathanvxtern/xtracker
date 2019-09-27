/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'

Vue.use(BootstrapVue)

require('./bootstrap');
const $ = require('jquery');
window.Vue = require('vue');
const axios = require('axios');
const HTTP = axios.create();

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('tasks-component', require('./components/TasksComponent.vue').default);
Vue.component('tasks-header-component', require('./components/TasksHeaderComponent.vue').default);

/**
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',

    data: () => ({
        customers: [],
        tasks: [],
        currentproject: [],
        currenttask: [],
        currentcustomer: "Customer",
    }),

    methods: {
        getProjectTasks: function( id ) {
            let self = this;
            
            let current_path = "/tasks/" + id;

            HTTP.get( current_path )

                .then( response => {
                    console.log( response );
                    if( response.data.data ) {
                        console.log( response.data.data );
                        self.tasks = response.data.data;
                    } else {
                        self.tasks = [];
                    }
                })

                .catch( e => {
                    console.log( e );

            });
        },
        getProjectCustomer: function( id ) {
            let self = this;
            
            let current_path = "/customer/" + id;

            HTTP.get( current_path )

                .then( response => {
                    console.log( response );
                    if( response.data.data ) {
                        console.log( response.data.data );
                        self.currentcustomer = response.data.data;
                    } else {
                        self.currentcustomer = [];
                    }
                })

                .catch( e => {
                    console.log( e );

            });
        },
    }
});

