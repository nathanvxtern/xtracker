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
Vue.component('newproject-component', require('./components/NewProjectComponent.vue').default);
Vue.component('newtask-component', require('./components/NewTaskComponent.vue').default);

/**
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',

    data: () => ({
        csrf: [],
        currentobject: typeof currentobjectPHP !== 'undefined' ? currentobjectPHP : [],
        customerprojects: [],
        customers: [],
        statuses: [],
        projrowid: [],
        selectedproject: 0,
        taskrowidadd: null,
        custrowidhoursadd: null,
        newprojectcustomer: "Customer",
        newprojectcustrowid: null,
        newprojstatusrowid: null,
        newprojectstatus: "Status",
        newtaskstatus: "Status",
        newtaskstatusrowid: null,
        newtasktype: "Type",
        newtasktyperowid: null,
        tasks: [],
        projstatusrowid: 0,
        projtyperowid: 0,
        hours: [],
        customer: "Customer",
        status: "Status",
        ctofilter: "Customer",
        ptofilter: "Project",
        popentofilter: false,
        pclosedtofilter: false,

        taskrowidtaskedit: null,
        edittasktitle: null,
        edittaskesthours: null,
        edittaskusedhrs: null,
        edittaskbillingrate: null,

        taskrowidhoursedit: null,
        hourshoursedit: null,

        hoursidtoedit: null,
        numhourstoedit: null,
        user_idtoedit: null,
        dateenteredtoedit: null,
        notestoedit: null,
        invoicenotoedit: null,

        viewtaskhourstaskrowid: null,
        viewtaskhourshours: null,
        viewtaskhourscustrowid: null,

    }),

    methods: {
        debug: function()
        {
            self = this;
            console.log( self.viewtaskhourstaskrowid );
            console.log( self.viewtaskhourshours );
            console.log( self.viewtaskhourscustrowid );
        },
        gettasks: function( projrowid )
        {
            let self = this;
            
            let current_path = "/tasks/" + projrowid;

            HTTP.get( current_path )

                .then( response => {
                    if( response.data.data.data.results.tasks ) {
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
                    if( response.data.data.data.results.hours ) {
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
                    if( response.data.data.data.results.project.customer.name ) {
                        self.customer = response.data.data.data.results.project.customer.name;
                        self.custrowidhoursadd = response.data.data.data.results.project.customer.custrowid;
                    } else {
                        self.customer = [];
                        self.custrowidhoursadd = [];
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
                    if( response.data.data.data.results.project.status ) {
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

            let current_path = "/filter/" + ctofilter + "/false/false";

            HTTP.get( current_path )

                .then( response => {
                    if( response.data.data.data.results.projects ) {
                        self.customerprojects = response.data.data.data.results.projects;
                    } else {
                        self.customerprojects = [];
                    }
                })

                .catch( e => {
                    console.log( e );

            });

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
        createproject: function( title, custrowid )
        {
            let current_path = "/projects/create/" + title + "/" + custrowid;

            HTTP.get( current_path )

                .then( response => {
                })

                .catch( e => {
                    console.log( e );

            });
        },
        createtask: function(billingrate,projstatusrowid,projtyperowid,projrowid,title)
        {
            let current_path = "/tasks/create/" + billingrate + "/" + projstatusrowid + "/" + projtyperowid + "/" + projrowid + "/" + title;

            HTTP.get( current_path )

                .then( response => {
                })

                .catch( e => {
                    console.log( e );

            });
        },
        populatetaskmodal: function(selectedproject)
        {
            let self = this;
            self.selectedproject = selectedproject;
        },
        assignnewprojectcustomer: function( newprojectcustomer )
        {
            let self = this;
            self.newprojectcustrowid = newprojectcustomer;
        },
        assignnewprojectstatus: function( newprojectstatus )
        {
            let self = this;
            self.newprojectstatus = newprojectstatus;
            if ( newprojectstatus == "Open" ) {
                self.newprojstatusrowid = 10;
            } else if ( newprojectstatus == "Closed" ) {
                self.newprojstatusrowid = 11;
            }
        },
        assignnewtaskstatus: function( newtaskstatus )
        {
            let self = this;
            self.newtaskstatus = newtaskstatus;
            if ( newtaskstatus == "Open" ) {
                self.newtaskstatusrowid = 10;
            } else if ( newtaskstatus == "Closed" ) {
                self.newtaskstatusrowid = 11;
            }
        },
        assignnewtasktype: function( newtasktype )
        {
            let self = this;
            self.newtasktype = newtasktype;
            if ( newtasktype == "PROG 100" ) {
                self.newtasktyperowid = 8;
            } else if ( newtasktype == "PROG 115" ) {
                self.newtasktyperowid = 9;
            } else if ( newtasktype == "ONSITE" ) {
                self.newtasktyperowid = 10;
            } else if ( newtasktype == "PROG 175" ) {
                self.newtasktyperowid = 11;
            } else if ( newtasktype == "PROG 125" ) {
                self.newtasktyperowid = 12;
            } else if ( newtasktype == "PROG 150" ) {
                self.newtasktyperowid = 13;
            } else if ( newtasktype == "PROG85" ) {
                self.newtasktyperowid = 14;
            } else if ( newtasktype == "PROG 120" ) {
                self.newtasktyperowid = 15;
            } else if ( newtasktype == "PROG 250" ) {
                self.newtasktyperowid = 16;
            } else if ( newtasktype == "PROG 200" ) {
                self.newtasktyperowid = 17;
            } else if ( newtasktype == "CONS 225" ) {
                self.newtasktyperowid = 18;
            } else if ( newtasktype == "WEBDVT 135" ) {
                self.newtasktyperowid = 19;
            } else if ( newtasktype == "PROG FREE" ) {
                self.newtasktyperowid = 20;
            } else if ( newtasktype == "PROG 75" ) {
                self.newtasktyperowid = 21;
            } else if ( newtasktype == "PROG PAID" ) {
                self.newtasktyperowid = 22;
            } else if ( newtasktype == "GRAPH 75" ) {
                self.newtasktyperowid = 23;
            } else if ( newtasktype == "PROG37.5" ) {
                self.newtasktyperowid = 24;
            } else if ( newtasktype == "ICG190" ) {
                self.newtasktyperowid = 25;
            } else if ( newtasktype == "PROG 105" ) {
                self.newtasktyperowid = 26;
            } else if ( newtasktype == "ICG175" ) {
                self.newtasktyperowid = 27;
            } else if ( newtasktype == "SUPP 150" ) {
                self.newtasktyperowid = 28;
            } else if ( newtasktype == "LEGACY190" ) {
                self.newtasktyperowid = 29;
            } else if ( newtasktype == "LEGACY175" ) {
                self.newtasktyperowid = 30;
            } else if ( newtasktype == "PROG150DISC10" ) {
                self.newtasktyperowid = 31;
            } else if ( newtasktype == "GRAPH75DISC10" ) {
                self.newtasktyperowid = 32;
            } else if ( newtasktype == "PROG 190" ) {
                self.newtasktyperowid = 33;
            } else if ( newtasktype == "CONSULT 200" ) {
                self.newtasktyperowid = 34;
            }
        },
        pfilter: function( ptofilter )
        {
            let self = this;
            self.ptofilter = ptofilter;
            self.populatetaskcomponent( self.ptofilter );
        },
        getprojectid: function ( title )
        {
            let self = this

            let current_path = "/getid/" + title;

            HTTP.get( current_path )

                .then( response => {
                    if( response.data.data.data.results.id.projrowid ) {
                        self.ptofilter = response.data.data.data.results.id.projrowid;
                    } else {
                        self.ptofilter = [];
                    }
                })

                .catch( e => {
                    console.log( e );

            });
        },
        populatetaskcomponent: function( projrowid )
        {
            if ( projrowid > 0 ) {
                let self = this;
                self.gettasks( projrowid );
                self.getprojectcustomer( projrowid );
                self.getprojectstatus( projrowid );
                self.setprojrowid( projrowid );
                self.populatetaskmodal( projrowid );
                self.selectedproject = projrowid;
            }
        },
        populatehourmodal: function(taskrowidhoursedit,custrowidhoursadd,hourshoursedit)
        {
            let self = this;
            self.taskrowidhoursedit = taskrowidhoursedit;
            self.taskrowidadd = taskrowidhoursedit;
            self.hourshoursedit = hourshoursedit;
            self.custrowidhoursadd = custrowidhoursadd;
        },
    }
});