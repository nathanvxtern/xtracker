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
        currentObject: typeof currentObjectPHP !== 'undefined' ? currentObjectPHP : [],
        customers: [],
        statuses: [],
        projrowid: [],
        selectedproject: 0,
        taskrowidadd: null,
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
        popentofilter: false,
        pclosedtofilter: false,

        taskrowidtaskedit: null,
        edittasktitle: null,
        edittaskesthours: null,
        edittaskusedhrs: null,
        edittaskbillingrate: null,

        taskrowidhoursedit: null,
        hourshoursedit: null,
        // user_idhoursedit: null,
        // dateenteredhoursedit: null,
        // numhourshoursedit: null,
        // noteshoursedit: null,
        // invoicenohoursedit: null,
    }),

    methods: {
        debug: function()
        {
            self = this;
            console.log( self.taskrowidhoursedit );
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
        createproject: function( title, custrowid )
        {
            let current_path = "/projects/create/" + title + "/" + custrowid;

            HTTP.get( current_path )

                .then( response => {
                    console.log( response );
                    console.log( "response should contain newly added id" );
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
                    console.log( response );
                    console.log( "response should contain newly added id" );
                })

                .catch( e => {
                    console.log( e );

            });
        },
        populatetaskmodal: function(selectedproject)
        {
            let self = this;
            self.selectedproject = selectedproject;
            console.log( selectedproject );
        },
        assignnewprojectcustomer: function( newprojectcustomer )
        {
            let self = this;
            self.newprojectcustomer = newprojectcustomer;
            if ( newprojectcustomer == "Uttermost" ) {
                self.newprojectcustrowid = 7;
            } else if ( newprojectcustomer == "Accuride" ) {
                self.newprojectcustrowid = 20;
            } else if ( newprojectcustomer == "Mueller" ) {
                self.newprojectcustrowid = 22;
            } else if ( newprojectcustomer == "GKN" ) {
                self.newprojectcustrowid = 8;
            } else if ( newprojectcustomer == "McMurray Fabrics" ) {
                self.newprojectcustrowid = 14;
            } else if ( newprojectcustomer == "Acucote" ) {
                self.newprojectcustrowid = 23;
            } else if ( newprojectcustomer == "Outdoor Venture" ) {
                self.newprojectcustrowid = 19;
            } else if ( newprojectcustomer == "Aeroglide" ) {
                self.newprojectcustrowid = 16;
            } else if ( newprojectcustomer == "Amresco" ) {
                self.newprojectcustrowid = 9;
            } else if ( newprojectcustomer == "Darex" ) {
                self.newprojectcustrowid = 25;
            } else if ( newprojectcustomer == "Datamax" ) {
                self.newprojectcustrowid = 18;
            } else if ( newprojectcustomer == "Helmer" ) {
                self.newprojectcustrowid = 17;
            } else if ( newprojectcustomer == "Koldban" ) {
                self.newprojectcustrowid = 10;
            } else if ( newprojectcustomer == "Martin Engineering" ) {
                self.newprojectcustrowid = 11;
            } else if ( newprojectcustomer == "US Stove" ) {
                self.newprojectcustrowid = 24;
            } else if ( newprojectcustomer == "D&W Finepack" ) {
                self.newprojectcustrowid = 26;
            } else if ( newprojectcustomer == "Crest Healthcare" ) {
                self.newprojectcustrowid = 27;
            } else if ( newprojectcustomer == "Lexington Home Brands" ) {
                self.newprojectcustrowid = 28;
            } else if ( newprojectcustomer == "Therafin" ) {
                self.newprojectcustrowid = 32;
            } else if ( newprojectcustomer == "AD Tech" ) {
                self.newprojectcustrowid = 33;
            } else if ( newprojectcustomer == "McRae" ) {
                self.newprojectcustrowid = 34;
            } else if ( newprojectcustomer == "Trulife" ) {
                self.newprojectcustrowid = 21;
            } else if ( newprojectcustomer == "Micropoise" ) {
                self.newprojectcustrowid = 35;
            } else if ( newprojectcustomer == "Raybestos" ) {
                self.newprojectcustrowid = 15;
            } else if ( newprojectcustomer == "Axlegaard" ) {
                self.newprojectcustrowid = 36;
            } else if ( newprojectcustomer == "QED" ) {
                self.newprojectcustrowid = 37;
            } else if ( newprojectcustomer == "Lantal Textiles" ) {
                self.newprojectcustrowid = 38;
            } else if ( newprojectcustomer == "Prince Mfg." ) {
                self.newprojectcustrowid = 39;
            } else if ( newprojectcustomer == "MargeCarson" ) {
                self.newprojectcustrowid = 40;
            } else if ( newprojectcustomer == "MSI" ) {
                self.newprojectcustrowid = 41;
            } else if ( newprojectcustomer == "Propac Images" ) {
                self.newprojectcustrowid = 42;
            } else if ( newprojectcustomer == "Toth Industries" ) {
                self.newprojectcustrowid = 43;
            } else if ( newprojectcustomer == "Lloyd Flanders" ) {
                self.newprojectcustrowid = 44;
            } else if ( newprojectcustomer == "Bernards" ) {
                self.newprojectcustrowid = 45;
            } else if ( newprojectcustomer == "Quoizel" ) {
                self.newprojectcustrowid = 46;
            } else if ( newprojectcustomer == "MISA Metals" ) {
                self.newprojectcustrowid = 48;
            } else if ( newprojectcustomer == "Merkle-Korff" ) {
                self.newprojectcustrowid = 49;
            } else if ( newprojectcustomer == "Worthen" ) {
                self.newprojectcustrowid = 50;
            } else if ( newprojectcustomer == "Nordicware" ) {
                self.newprojectcustrowid = 31;
            } else if ( newprojectcustomer == "Paragon Picture Gallery" ) {
                self.newprojectcustrowid = 51;
            } else if ( newprojectcustomer == "Case Knives" ) {
                self.newprojectcustrowid = 52;
            } else if ( newprojectcustomer == "Furnitureland South" ) {
                self.newprojectcustrowid = 53;
            } else if ( newprojectcustomer == "Sioux Chief" ) {
                self.newprojectcustrowid = 54;
            } else if ( newprojectcustomer == "Regina Andrew Design" ) {
                self.newprojectcustrowid = 55;
            } else if ( newprojectcustomer == "Cheetah" ) {
                self.newprojectcustrowid = 56;
            } else if ( newprojectcustomer == "Xpicor" ) {
                self.newprojectcustrowid = 57;
            } else if ( newprojectcustomer == "Litania" ) {
                self.newprojectcustrowid = 58;
            } else if ( newprojectcustomer == "Feizy Rugs" ) {
                self.newprojectcustrowid = 59;
            } else if ( newprojectcustomer == "Riverside Furniture" ) {
                self.newprojectcustrowid = 60;
            } else if ( newprojectcustomer == "Silver Street Dvt" ) {
                self.newprojectcustrowid = 61;
            } else if ( newprojectcustomer == "Lagos" ) {
                self.newprojectcustrowid = 47;
            } else if ( newprojectcustomer == "Longwood Elastomers" ) {
                self.newprojectcustrowid = 62;
            } else if ( newprojectcustomer == "Musikgarten" ) {
                self.newprojectcustrowid = 63;
            } else if ( newprojectcustomer == "Varaluz" ) {
                self.newprojectcustrowid = 64;
            } else if ( newprojectcustomer == "Hughes Furniture Industries" ) {
                self.newprojectcustrowid = 65;
            } else if ( newprojectcustomer == "Taracea" ) {
                self.newprojectcustrowid = 66;
            } else if ( newprojectcustomer == "The Design Network (TDN)" ) {
                self.newprojectcustrowid = 67;
            } else if ( newprojectcustomer == "Edgewater Power Boats" ) {
                self.newprojectcustrowid = 68;
            } else if ( newprojectcustomer == "Vallourec" ) {
                self.newprojectcustrowid = 69;
            } else if ( newprojectcustomer == "ZeroG" ) {
                self.newprojectcustrowid = 70;
            } else if ( newprojectcustomer == "DEMA" ) {
                self.newprojectcustrowid = 71;
            } else if ( newprojectcustomer == "Cogentix (Vision Sciences)" ) {
                self.newprojectcustrowid = 13;
            } else if ( newprojectcustomer == "HaystackCRM" ) {
                self.newprojectcustrowid = 72;
            } else if ( newprojectcustomer == "Mixture" ) {
                self.newprojectcustrowid = 73;
            } else if ( newprojectcustomer == "Sioux Steel" ) {
                self.newprojectcustrowid = 12;
            } else if ( newprojectcustomer == "Carlton Scale" ) {
                self.newprojectcustrowid = 74;
            } else if ( newprojectcustomer == "JKS Incorporated" ) {
                self.newprojectcustrowid = 76;
            } else if ( newprojectcustomer == "R2 Ventures" ) {
                self.newprojectcustrowid = 75;
            } else if ( newprojectcustomer == "Vizbii" ) {
                self.newprojectcustrowid = 77;
            } else if ( newprojectcustomer == "ClaroLux" ) {
                self.newprojectcustrowid = 78;
            } else if ( newprojectcustomer == "Triad Foot Center" ) {
                self.newprojectcustrowid = 79;
            } else if ( newprojectcustomer == "LuRoos" ) {
                self.newprojectcustrowid = 80;
            } else if ( newprojectcustomer == "JA King" ) {
                self.newprojectcustrowid = 81;
            } else if ( newprojectcustomer == "Alfmeier" ) {
                self.newprojectcustrowid = 82;
            } else if ( newprojectcustomer == "Tobe MFG" ) {
                self.newprojectcustrowid = 83;
            } else if ( newprojectcustomer == "HF Foods Group" ) {
                self.newprojectcustrowid = 84;
            } else if ( newprojectcustomer == "Green Seal" ) {
                self.newprojectcustrowid = 85;
            } else if ( newprojectcustomer == "JDA Group" ) {
                self.newprojectcustrowid = 86;
            } else if ( newprojectcustomer == "Hamilton Lakes Cafe" ) {
                self.newprojectcustrowid = 87;
            } else if ( newprojectcustomer == "Admetrics" ) {
                self.newprojectcustrowid = 88;
            } else if ( newprojectcustomer == "Community Housing Solutions" ) {
                self.newprojectcustrowid = 89;
            } else if ( newprojectcustomer == "MAG Companies" ) {
                self.newprojectcustrowid = 90;
            }
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
        populatetaskcomponent: function( projrowid )
        {
            console.log( projrowid );
            if ( projrowid > 0 ) {
                let self = this;
                self.gettasks( projrowid );
                self.getprojectcustomer( projrowid );
                self.getprojectstatus( projrowid );
                self.setprojrowid( projrowid );
                self.populatetaskmodal( projrowid );
                self.selectedproject = projrowid;
            }
        }
    }
});