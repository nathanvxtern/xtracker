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
                            <tr v-for="task of tasks" v-bind:key="task.id" class="clickable-row" @click="populatehours( task.taskrowid,task.hours,task.custrowid);">
                                <td>{{ task.title }}</td>
                                <td>{{ task.esthours }}</td>
                                <td>{{ task.usedhrs }}</td>
                                <th scope="rows">
                                    <button type="button" class="btn btn-primary" @click="populateedittaskmodal( task.taskrowid, task.title, task.esthours, task.usedhrs, task.billingrate )" data-toggle="modal" data-target="#editTaskModal">
                                        Edit/Delete
                                    </button>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    Hours
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addHoursModal">
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
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editHoursModal" @click="populateedithourmodal( taskrowidhoursedit, custrowidhoursadd, hour.hoursid, hour.numhours, hour.user_id, hour.dateentered, hour.notes, hour.invoiceno );
                                                                        updatenumhourstoedit( hour.hoursid, hour.numhours );
                                                                        updateuser_idtoedit( hour.hoursid, hour.user_id );
                                                                        updatedateenteredtoedit( hour.hoursid, hour.dateentered );
                                                                        updatenotestoedit( hour.hoursid, hour.notes );
                                                                        updateinvoicenotoedit( hour.hoursid, hour.invoiceno );"
                                                                        >Edit</button>
                                </td>
                                <td>
                                    <a :v-model="hour.hoursid" :href="'/confirm/delete/hour/'+hour.hoursid" class="btn btn-primary">
                                        Delete
                                    </a>
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
            'hoursidtoedit',
            'numhourstoedit',
            'notestoedit',
            'user_idtoedit',
            'dateenteredtoedit',
            'invoicenotoedit',
            'taskrowidhoursedit',
            'hourshoursedit',
            'custrowidhoursadd',
        ],
        data() { return { csrfToken: null }},
        created() {
            this.csrfToken = document.querySelector('meta[name="csrf-token"]').content
        },
        methods: {
            populatehours: function(taskrowidhoursedit,hourshoursedit,custrowidhoursadd)
            {
                let self = this.$parent;
                self.taskrowidhoursedit = taskrowidhoursedit;
                self.taskrowidadd = taskrowidhoursedit;
                self.hourshoursedit = hourshoursedit;
                self.custrowidhoursadd = custrowidhoursadd;

                self.viewtaskhourstaskrowid = taskrowidhoursedit;
                self.viewtaskhourshours = hourshoursedit;
                self.viewtaskhourscustrowid = custrowidhoursadd;
            },
            populateedittaskmodal: function(taskrowidtaskedit,edittasktitle,edittaskesthours,edittaskusedhrs,edittaskbillingrate)
            {
                let self = this.$parent;
                self.taskrowidtaskedit = taskrowidtaskedit;
                self.edittasktitle = edittasktitle;
                self.edittaskesthours = edittaskesthours;
                self.edittaskusedhrs = edittaskusedhrs;
                self.edittaskbillingrate = edittaskbillingrate;
            },
            updatenumhourstoedit: function(hoursidtoedit,numhourstoedit)
            {
                let self = this.$parent;
                self.numhourstoedit = numhourstoedit;
                self.hoursidtoedit = hoursidtoedit;
            },
            updateuser_idtoedit: function(hoursidtoedit,user_idtoedit)
            {
                let self = this.$parent;
                self.user_idtoedit = user_idtoedit;
                self.hoursidtoedit = hoursidtoedit;
            },
            updatedateenteredtoedit: function(hoursidtoedit,dateenteredtoedit)
            {
                let self = this.$parent;
                self.dateenteredtoedit = dateenteredtoedit;
                self.hoursidtoedit = hoursidtoedit;
            },
            updatenotestoedit: function(hoursidtoedit,notestoedit)
            {
                let self = this.$parent;
                self.notestoedit = notestoedit;
                self.hoursidtoedit = hoursidtoedit;
            },
            updateinvoicenotoedit: function(hoursidtoedit,invoicenotoedit)
            {
                let self = this.$parent;
                self.invoicenotoedit = invoicenotoedit;
                self.hoursidtoedit = hoursidtoedit;
            },
            populateedithourmodal( taskrowidhoursedit, custrowidhoursadd, hoursid, numhours, user_id, dateentered, notes, invoiceno )
            {
                let self = this.$parent;
                self.edithourtaskrowid = taskrowidhoursedit;
                self.edithourcustrowid = custrowidhoursadd;
                self.edithourhoursid = hoursid;
                self.edithouruser_id = user_id;
                self.edithournumhours = numhours;
                self.edithourdateentered = dateentered;
                self.edithournotes = notes;
                self.edithourinvoiceno = invoiceno;
            }
        }
    }
</script>