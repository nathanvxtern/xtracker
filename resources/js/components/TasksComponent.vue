<template>
    <div>
        <div class="row">
            <div class="col">
                <div class="row">
                    Tasks
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addTaskModal">
                        +
                    </button>
                </div>
                <div class="row">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Est</th>
                                <th scope="col">Used</th>
                                <th scope="col" class="border-0"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="task of tasks" v-bind:key="task.taskrowid" class="clickable-row" @click="populatehours( task.taskrowid )">
                                <td>{{ task.title }}</td>
                                <td>{{ task.esthours }}</td>
                                <td>{{ task.usedhrs }}</td>
                                <td class="border-0">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteTaskModal"
                                        @click="populatedeletetaskmodal( task );">
                                        Delete
                                    </button>
                                    <button type="button" class="btn btn-primary" @click="populateedittaskmodal( task )" data-toggle="modal" data-target="#editTaskModal">
                                        Edit
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    Hours
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addHoursModal" name="addhoursbutton" id="addhoursbutton">
                        +
                    </button>
                </div>
                <div class="row">
                    <div class="col">
                        <input v-model="taskrowidhoursedit" type="hidden">
                    </div>
                    <div class="col">
                        <input v-model="hourshoursedit" type="hidden">
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Name</th>
                                <th scope="col">Hrs</th>
                                <th scope="col">Notes</th>
                                <th scope="col">Inv#</th>
                                <th scope="col" class="border-0"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="hour in hourshoursedit" v-bind:key="hour.hoursid">
                                <td>{{ hour.dateentered }}</td>
                                <td>{{ hour.user_id }}</td>
                                <td>{{ hour.numhours }}</td>
                                <td>{{ hour.notes }}</td>
                                <td>{{ hour.invoiceno }}</td>
                                <td class="border-0">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editHoursModal" @click="populateedithourmodal( taskrowidhoursedit, custrowidhoursadd, hour );">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteHoursModal" @click="populatedeletehoursmodal( hour );">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props:[
            'csrf',
            'currentobject',
            'tasks',
            'projstatusrowid',
            'projtyperowid',
            'taskrowidadd',
            'taskrowidhoursedit',
            'hourshoursedit',
            'custrowidhoursadd',
            'addhoursbutton',
            'currentuser',
        ],
        data() { return { csrfToken: null } },
        created() {
            this.csrfToken = document.querySelector( 'meta[name="csrf-token"]' ).content;
        },
        methods: {
            populateedittaskmodal: function( task )
            {
                let self = this.$parent;
                self.taskrowidtaskedit = task.taskrowid;
                self.edittasktitle = task.title;
                self.edittaskesthours = task.esthours;
                self.edittaskusedhrs = task.usedhrs;
                self.edittaskbillingrate = task.billingrate;
                self.edittaskreqcompdate = task.reqcompdate;
            },
            populatedeletetaskmodal: function( task )
            {
                let self = this.$parent;
                self.deletetasktaskrowid = task.taskrowid;
                self.deletetasktask = task.title;
                self.populatedeletetaskmodal();
            },
            populatehours: function( taskrowid )
            {
                let self = this.$parent;
                self.current();
                self.populatehours( taskrowid );
                // if ( addhoursbutton.getAttribute( 'disabled' ) ) {
                //     addhoursbutton.setAttribute('disabled', false );
                // } else {
                //     addhoursbutton.setAttribute('disabled', true );
                // }
            },
            populateedithourmodal( taskrowidhoursedit, custrowidhoursadd, hour )
            {
                let self = this.$parent;
                self.edithourtaskrowid = taskrowidhoursedit;
                self.edithourcustrowid = custrowidhoursadd;
                self.edithourhoursid = hour.hoursid;
                self.edithouruser_id = hour.user_id;
                self.edithournumhours = hour.numhours;
                self.edithourdateentered = hour.dateentered;
                self.edithournotes = hour.notes;
                self.edithourinvoiceno = hour.invoiceno;
            },
            populatedeletehoursmodal( hour )
            {
                let self = this.$parent;
                self.deletehourshoursid = hour.hoursid;
                self.deletehoursemployee = hour.user_id;
                self.deletehoursdateentered = hour.dateentered;
                self.deletehoursnumhours = hour.numhours;
                self.populatedeletehoursmodal();
            },
        }
    }
</script>