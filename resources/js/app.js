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
Vue.component('project-component', require('./components/TasksComponent.vue').default);
Vue.component('tasks-header-component', require('./components/TasksHeaderComponent.vue').default);
Vue.component('projects-component', require('./components/ProjectsComponent.vue').default);

/**
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',

    data: {
        customers: [],
        projects: [],
        filteredprojects: [],
        tasks: [],
        currentproject: [],
        currenttask: [],
        currentcustomer: "No Project Selected",
    },

    methods: {
        getProjects: function()
        {
            let self = this;

            let current_path = "/projects";

            HTTP.get( current_path )

                .then( response => {
                    console.log( response );
                    if( response.data.data.projects && response.data.data.customers ) {
                        console.log( response.data.data.projects );
                        console.log( response.data.data.customers );
                        self.projects = response.data.data.projects;
                        self.customers = response.data.data.customers;
                    } else {
                        self.projects = [];
                        self.customers = [];
                    }
                })

                .catch( e => {
                    console.log( e );

            });
        },
    }
});

