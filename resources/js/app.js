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

Vue.component('filter-component', require('./components/FilterComponent.vue').default);

/**
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',

    data: () => ({
        customers: [],
        statuses: [],
        project: [],
        customer: "Customer",
        status: "Status",
        tasks: [],
        ctofilter: "Customer",
    }),

    methods: {
        tasklist: function( projrowid ) {
            let self = this;
            
            let current_path = "/tasks/" + projrowid;

            HTTP.get( current_path )

                .then( response => {
                    console.log( response );
                    if( response.data.data ) {
                        console.log( response.data.data.data.results.tasks );
                        self.tasks = response.data.data.data.results.tasks;
                    } else {
                        self.tasks = [];
                    }
                })

                .catch( e => {
                    console.log( e );

            });
        },
        getCustomer: function( id ) {
            let self = this;
            
            let current_path = "/customer/" + id;

            HTTP.get( current_path )

                .then( response => {
                    console.log( response );
                    if( response.data.data ) {
                        console.log( response.data.data );
                        self.customer = response.data.data;
                    } else {
                        self.customer = [];
                    }
                })

                .catch( e => {
                    console.log( e );

            });
        },
        getStatus: function( id ) {
            let self = this;
            
            let current_path = "/status/" + id;

            HTTP.get( current_path )

                .then( response => {
                    console.log( response );
                    if( response.data.data ) {
                        console.log( response.data.data );
                        self.status = response.data.data;
                    } else {
                        self.status = [];
                    }
                })

                .catch( e => {
                    console.log( e );

            });
        },
        cfilter: function( ctofilter ) {
            let self = this;

            console.log( ctofilter );
            let current_path = "/cfilter/" + ctofilter;

            HTTP.get( current_path )

                .then( response => {
                    console.log( response );
                    if( response.data.data ) {
                        console.log( response.data.data );
                        self.ctofilter = response.data.data;
                    } else {
                        self.ctofilter = [];
                    }
                })

                .catch( e => {
                    console.log( e );

            });
        },
    }
});

