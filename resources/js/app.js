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

Vue.component('tasks-component', require('./components/TasksComponent.vue').default);

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
        taskrowidadd: null,
        custrowidhoursadd: [],
        newtaskstatus: "Status",
        newtaskstatusrowid: null,
        newtasktype: "Type",
        newtasktyperowid: null,
        tasks: [],
        projstatusrowid: 0,
        projtyperowid: 0,
        customer: [],
        status: [],
        ctofilter: [],
        ptofilter: [],
        ttofilter: [],

        newprojectcustomer: [],
        newprojectcustrowid: null,
        newprojstatusrowid: null,
        newprojectstatus: "Status",

        editcustomername: [],

        editprojecttitle: [],
        editprojectcustrowid: [],
        edit_project_customer_name: [],

        taskrowidtaskedit: null,
        edittasktitle: null,
        edittaskesthours: null,
        edittaskusedhrs: null,
        edittaskbillingrate: null,
        edittaskreqcompdate: null,

        editprojecttitle: [],
        editprojectcustomer: [],

        taskrowidhoursedit: null,
        hourshoursedit: null,

        viewtaskhourstaskrowid: null,
        viewtaskhourscustrowid: null,

        edithourtaskrowid: null,
        edithourcustrowid: null,
        edithouruser_id: null,
        edithournumhours: null,
        edithourdateentered: null,
        edithournotes: null,
        edithourinvoiceno: null,
        edithourhoursid: null,

        currentuser: [],

        deletehourshoursid: [],
        deletehoursemployee: [],
        deletehoursdateentered: [],
        deletehoursnumhours: [],
        deletehourstask: [],
        deletehoursproject: [],
        deletehourscustomer: [],

        deletetasktaskrowid: [],
        deletetasktask: [],
        deletetaskproject: [],
        deletetaskcustomer: [],
        
    }),

    methods: {
        debug: function()
        {
            self = this;
            console.log( self.editprojecttitle );
        },
        gettasks: function( ctofilter, ptofilter )
        {
            let self = this;
            
            let current_path = "customers/" + ctofilter + "/projects/" + ptofilter + "/tasks";

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
        getcustomer: function( ctofilter )
        {
            let self = this;
            
            let current_path = "/customers/" + ctofilter;

            HTTP.get( current_path )

                .then( response => {
                    if( response.data.data.data.results.customer.name ) {
                        self.customer = response.data.data.data.results.customer.name;
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
        cfilter: function( ctofilter )
        {
            let self = this;
            self.ctofilter = ctofilter;
            self.populateprojectmodal( ctofilter );
            self.populateeditcustomermodal( ctofilter );

            let current_path = "/customers/" + ctofilter + "/projects";

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
        assignnewprojectcustomer: function( ctofilter )
        {
            let self = this;

            let current_path = "/customers/" + ctofilter;

            HTTP.get( current_path )

                .then( response => {
                    if( response.data.data.data.results.customer.name ) {
                        self.newprojectcustomer = response.data.data.data.results.customer.name;
                        self.newprojectcustrowid = response.data.data.data.results.customer.custrowid;
                    } else {
                        self.newprojectcustomer = [];
                        self.newprojectcustrowid = [];
                    }
                })

                .catch( e => {
                    console.log( e );

            });
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
        pfilter: function( ctofilter, ptofilter )
        {
            let self = this;
            self.ctofilter = ctofilter;
            self.ptofilter = ptofilter;
            self.populatetaskcomponent( self.ctofilter, self.ptofilter );
            self.populateeditprojectmodal( self.ctofilter, self.ptofilter );
        },
        populatetaskcomponent: function( ctofilter, ptofilter )
        {
            let self = this;
            self.gettasks( ctofilter, ptofilter );
            self.getcustomer( ctofilter );
        },
        populatehours: function( taskrowid )
        {
            let self = this;
            self.taskrowidhoursedit = taskrowid;
            self.taskrowidadd = taskrowid;
            self.viewtaskhourstaskrowid = taskrowid;
            self.custrowidhoursadd = self.ctofilter;
            self.viewtaskhourscustrowid = self.ctofilter;
            self.ttofilter = taskrowid;

            let current_path = "/customers/" + self.ctofilter + "/projects/" + self.ptofilter + "/tasks/" + taskrowid + "/hours";

            HTTP.get( current_path )

                .then( response => {

                    if( response.data.data.data.results.hours ) {
                        self.hourshoursedit = response.data.data.data.results.hours;
                    } else {
                        self.hourshoursedit = [];
                    }
                })

                .catch( e => {
                    console.log( e );

            });
        },
        populateeditcustomermodal: function( ctofilter )
        {
            let self = this;
            let current_path = "/customers/" + ctofilter;

            HTTP.get( current_path )

                .then( response => {

                    if( response.data.data.data.results.customer.name ) {
                        self.editcustomername = response.data.data.data.results.customer.name;
                    } else {
                        self.editcustomername = [];
                    }
                })

                .catch( e => {
                    console.log( e );

            });
        },
        populateeditprojectmodal: function( ctofilter, ptofilter )
        {
            let self = this;
            let current_path = "/customers/" + ctofilter + "/projects/" + ptofilter;

            HTTP.get( current_path )

                .then( response => {

                    if( response.data.data.data.results.project ) {
                        self.editprojecttitle = response.data.data.data.results.project.title;
                        console.log( self.editprojecttitle );
                        self.editprojectcustrowid = response.data.data.data.results.project.custrowid;
                        self.edit_project_customer_name = self.newprojectcustomer;
                    } else {
                        self.editprojecttitle = [];
                        self.editprojectcustrowid = [];
                    }
                })

                .catch( e => {
                    console.log( e );

            });
        },
        populateprojectmodal: function( custrowid )
        {
            let self = this;
            self.assignnewprojectcustomer( custrowid );
        },
        populatehourmodal: function( taskrowidhoursedit, custrowidhoursadd, hourshoursedit)
        {
            let self = this;
            self.taskrowidhoursedit = taskrowidhoursedit;
            self.taskrowidadd = taskrowidhoursedit;
            self.hourshoursedit = hourshoursedit;
            self.custrowidhoursadd = custrowidhoursadd;
        },
        current: function()
        {
            let self = this;

            let current_path = "/employees/current";

            HTTP.get( current_path )

                .then( response => {

                    if( response.data.data.data.results.current ) {
                        self.currentuser = response.data.data.data.results.current;
                    } else {
                        self.currentuser = [];
                    }
                })

                .catch( e => {
                    console.log( e );

            });
        },
        populatedeletehoursmodal: function()
        {
            let self = this;
            self.populatedeletehourstask();
            self.populatedeletehoursproject();
            self.populatedeletehourscustomer();
        },
        populatedeletehourstask: function()
        {
            let self = this;

            let current_path = "/customers/" + self.ctofilter + "/projects/" + self.ptofilter + "/tasks/" + self.ttofilter;

            HTTP.get( current_path )

                .then( response => {

                    if( response.data.data.data.results.task.title ) {
                        self.deletehourstask = response.data.data.data.results.task.title;
                    } else {
                        self.deletehourstask = [];
                    }
                })

                .catch( e => {
                    console.log( e );

            });
        },
        populatedeletehoursproject: function()
        {
            let self = this;

            let current_path = "/customers/" + self.ctofilter + "/projects/" + self.ptofilter;

            HTTP.get( current_path )

                .then( response => {

                    if( response.data.data.data.results.project.title ) {
                        self.deletehoursproject = response.data.data.data.results.project.title;
                    } else {
                        self.deletehoursproject = [];
                    }
                })

                .catch( e => {
                    console.log( e );

            });
        },
        populatedeletehourscustomer: function()
        {
            let self = this;

            let current_path = "/customers/" + self.ctofilter;

            HTTP.get( current_path )

                .then( response => {

                    if( response.data.data.data.results.customer.name ) {
                        self.deletehourscustomer = response.data.data.data.results.customer.name;
                    } else {
                        self.deletehourscustomer = [];
                    }
                })

                .catch( e => {
                    console.log( e );

            });
        },
        populatedeletetaskmodal: function()
        {
            let self = this;
            self.populatedeletetaskproject();
            self.populatedeletetaskcustomer();
        },
        populatedeletetaskproject: function()
        {
            let self = this;

            let current_path = "/customers/" + self.ctofilter + "/projects/" + self.ptofilter;

            HTTP.get( current_path )

                .then( response => {

                    if( response.data.data.data.results.project.title ) {
                        self.deletetaskproject = response.data.data.data.results.project.title;
                    } else {
                        self.deletetaskproject = [];
                    }
                })

                .catch( e => {
                    console.log( e );

            });
        },
        populatedeletetaskcustomer: function()
        {
            let self = this;

            let current_path = "/customers/" + self.ctofilter;

            HTTP.get( current_path )

                .then( response => {

                    if( response.data.data.data.results.customer.name ) {
                        self.deletetaskcustomer = response.data.data.data.results.customer.name;
                    } else {
                        self.deletetaskcustomer = [];
                    }
                })

                .catch( e => {
                    console.log( e );

            });
        },
        editcustomer: function( event, custrowid )
        {
            let self = this;

            let element = event.currentTarget;
            let form_id = element.getAttribute( 'data-form-id' );
            let form = $( '#'+form_id ).serialize();

            let current_path = "customers/" + custrowid;

            HTTP.put( current_path, form )

                .then( response => {

                    self.cfilter( custrowid );
                    
                })

                .catch( e => {

                    console.log( e );

            });
        },
        createproject: function( event, newprojectcustrowid )
        {
            let self = this;
            
            let element = event.currentTarget;
            let form_id = element.getAttribute( 'data-form-id' );
            let form =  $( '#'+form_id ).serialize();

            let current_path = "customers/" + newprojectcustrowid + "/projects";

            HTTP.post( current_path, form )

                .then( response => {

                    self.cfilter( newprojectcustrowid );
                    
                })

                .catch( e => {

                    console.log( e );

            });
        },
        edittask: function( event, ctofilter, ptofilter )
        {
            let self = this;
            
            let element = event.currentTarget;
            let form_id = element.getAttribute( 'data-form-id' );
            let form =  $( '#'+form_id ).serialize();

            let current_path = "customers/" + ctofilter + "/projects/" + ptofilter;

            HTTP.put( current_path, form )

                .then( response => {

                    self.cfilter( ctofilter );
                    self.pfilter( ctofilter, ptofilter );
                    
                })

                .catch( e => {

                    console.log( e );

            });
        },
        createtask: function( event, ctofilter, ptofilter )
        {
            let self = this;
            
            let element = event.currentTarget;
            let form_id = element.getAttribute( 'data-form-id' );
            let form =  $( '#'+form_id ).serialize();

            let current_path = "customers/" + ctofilter + "/projects/" + ptofilter + "/tasks";

            HTTP.post( current_path, form )

                .then( response => {

                    self.cfilter( ctofilter );
                    self.pfilter( ctofilter, ptofilter );
                    
                })

                .catch( e => {

                    console.log( e );

            });
        },
        edittask: function( event, ctofilter, ptofilter, taskrowidtaskedit )
        {
            let self = this;
            
            let element = event.currentTarget;
            let form_id = element.getAttribute( 'data-form-id' );
            let form =  $( '#'+form_id ).serialize();

            let current_path = "customers/" + ctofilter + "/projects/" + ptofilter + "/tasks/" + taskrowidtaskedit;

            HTTP.put( current_path, form )

                .then( response => {

                    self.cfilter( ctofilter );
                    self.pfilter( ctofilter, ptofilter );
                    
                })

                .catch( e => {

                    console.log( e );

            });
        },
        deletetask: function( event, ctofilter, ptofilter, deletetasktaskrowid )
        {
            let self = this;
            
            let element = event.currentTarget;
            let form_id = element.getAttribute( 'data-form-id' );
            let form =  $( '#'+form_id ).serialize();

            let current_path = "customers/" + ctofilter + "/projects/" + ptofilter + "/tasks/" + deletetasktaskrowid;

            HTTP.delete( current_path, form )

                .then( response => {

                    self.cfilter( ctofilter );
                    self.pfilter( ctofilter, ptofilter );
                    
                })

                .catch( e => {

                    console.log( e );

            });
        },
        addhours: function( event, ctofilter, ptofilter, taskrowidadd )
        {
            let self = this;
            
            let element = event.currentTarget;
            let form_id = element.getAttribute( 'data-form-id' );
            let form =  $( '#'+form_id ).serialize();

            let current_path = "customers/" + ctofilter + "/projects/" + ptofilter + "/tasks/" + taskrowidadd + "/hours";

            HTTP.post( current_path, form )

                .then( response => {

                    self.cfilter( ctofilter );
                    self.pfilter( ctofilter, ptofilter );
                    self.current();
                    self.populatehours( taskrowidadd );
                    
                })

                .catch( e => {

                    console.log( e );

            });
        },
        editproject: function( event, ctofilter, ptofilter )
        {
            let self = this;
            
            let element = event.currentTarget;
            let form_id = element.getAttribute( 'data-form-id' );
            let form =  $( '#'+form_id ).serialize();

            console.log( ptofilter );

            let current_path = "customers/" + ctofilter + "/projects/" + ptofilter;

            HTTP.put( current_path, form )

                .then( response => {

                    self.cfilter( ctofilter );
                    self.pfilter( ctofilter, ptofilter );
                    
                })

                .catch( e => {

                    console.log( e );

            });
        },
        deletehours: function( event, ctofilter, ptofilter, edithourtaskrowid, deletehourshoursid )
        {
            let self = this;
            
            let element = event.currentTarget;
            let form_id = element.getAttribute( 'data-form-id' );
            let form =  $( '#'+form_id ).serialize();

            let current_path = "customers/" + ctofilter + "/projects/" + ptofilter + "/tasks/" + edithourtaskrowid + "/hours/" + deletehourshoursid;

            HTTP.delete( current_path, form )

                .then( response => {

                    self.cfilter( ctofilter );
                    self.pfilter( ctofilter, ptofilter );
                    self.current();
                    self.populatehours( edithourtaskrowid );
                    
                })

                .catch( e => {

                    console.log( e );

            });
        },
    }
});