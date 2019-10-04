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

Vue.component('pfilter-component', require('./components/PFilterComponent.vue').default);

/**
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',

    data: () => ({
        currentObject: typeof currentObjectPHP !== 'undefined' ? currentObjectPHP : [],
        customers: [],
        statuses: [],
        projrowid: [],
        tasks: [],
        hours: [],
        customer: "Customer",
        status: "Status",
        ctofilter: "Customer",
        popentofilter: false,
        pclosedtofilter: false,
    }),

    methods: {
        debug: function()
        {
            let self = this;
            console.log( self.currentObject );
        },
        gettasks: function( projrowid )
        {
            let self = this;
            
            let current_path = "/tasks/" + projrowid;

            HTTP.get( current_path )

                .then( response => {
                    console.log( response );
                    if( response.data.data.data.results.tasks ) {
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
        gethours: function( taskrowid )
        {
            let self = this;
            
            let current_path = "/hours/" + taskrowid;

            HTTP.get( current_path )

                .then( response => {
                    console.log( response );
                    if( response.data.data.data.results.hours ) {
                        console.log( response.data.data.data.results.hours );
                        self.hours = response.data.data.data.results.hours;
                    } else {
                        self.hours = [];
                    }
                })

                .catch( e => {
                    console.log( e );

            });
        },
        getprojectcustomer: function( projrowid )
        {
            let self = this;
            
            let current_path = "/customer/" + projrowid;

            HTTP.get( current_path )

                .then( response => {
                    console.log( response );
                    if( response.data.data.data.results.project.customer.name ) {
                        console.log( response.data.data.data.results.project.customer.name );
                        self.customer = response.data.data.data.results.project.customer.name;
                    } else {
                        self.customer = [];
                    }
                })

                .catch( e => {
                    console.log( e );

            });
        },
        getprojectstatus: function( projrowid )
        {
            let self = this;
            
            let current_path = "/status/" + projrowid;

            HTTP.get( current_path )

                .then( response => {
                    console.log( response );
                    if( response.data.data.data.results.project.status ) {
                        console.log( response.data.data.data.results.project.status );
                        self.status = response.data.data.data.results.project.status;
                    } else {
                        self.status = [];
                    }
                })

                .catch( e => {
                    console.log( e );

            });
        },
        setprojrowid: function( projrowid )
        {
            let self = this;
            self.projrowid = projrowid;
        },
        cfilter: function( ctofilter )
        {
            let self = this;
            self.ctofilter = ctofilter;
        },
        popenfilter: function( popentofilter )
        {
            let self = this;
            self.popentofilter = ( !popentofilter );
        },
        pclosedfilter: function( pclosedtofilter )
        {
            let self = this;
            self.pclosedtofilter = ( !pclosedtofilter );
        },
    }
});

