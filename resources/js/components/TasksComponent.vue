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
                                <th scope="col">Est.</th>
                                <th scope="col">Used</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="task of tasks" v-bind:key="task.id">
                                <td>{{ task.title }}</td>
                                <td>{{ task.esthours }}</td>
                                <td>{{ task.usedhrs }}</td>
                                <th scope="rows">
                                    <button type="button" class="btn btn-primary" @click="populateedittaskmodal( task.taskrowid, task.title, task.esthours, task.usedhrs, task.billingrate )" data-toggle="modal" data-target="#editTaskModal">
                                        Edit/Delete
                                    </button>
                                </th>
                                <td>
                                    <button @click="populatehours( task.taskrowid,task.hours,task.custrowid);" type="button" class="btn btn-primary">
                                        View
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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addHoursModal">
                        +
                    </button>
                </div>
                <div class="row">
                    <form id="edit_hours_form" :action="'/hours/edit/' + hoursidtoedit + '/' + numhourstoedit + '/' + user_idtoedit + '/' + dateenteredtoedit + '/' + notestoedit + '/' + invoicenotoedit" method="POST" name="edit_hours_form">

                        <input type="hidden" :value="csrfToken" name="_token"/>
                        
                        <div>
                            <div class="col-md-4 col-sm-6 col-xs-12 input-padding">
                                <input v-model="taskrowidhoursedit" type="hidden" class="form-control" id="create-link-taskrowid" name="taskrowid">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 input-padding">
                                <input v-model="hourshoursedit" type="hidden" class="form-control" id="create-link-hours" name="hours">
                            </div>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">numhours</th>
                                    <th scope="col">employee</th>
                                    <th scope="col">dateentered</th>
                                    <th scope="col">notes</th>
                                    <th scope="col">invoiceno</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(hour,index) in hourshoursedit" v-bind:key="hourshoursedit[index].hoursid">
                                    <td>
                                        <input v-model="hourshoursedit[index].numhours" type="text" class="form-control" id="create-link-numhours" name="numhours" @change="updatenumhourstoedit( hour.hoursid, hour.numhours )">
                                    </td>
                                    <td>
                                        <select v-model="hourshoursedit[index].user_id" class="form-control" id="user_id" name="user_id" placeholder="user" @change="updateuser_idtoedit( hour.hoursid, hour.user_id )">
                                            <option selected>Employee</option>
                                            <option v-for="user in currentobject.users" :key="user.user_id">{{ user.name }}</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input v-model="hourshoursedit[index].dateentered" type="text" class="form-control" id="create-link-dateentered" name="dateentered" @change="updatedateenteredtoedit( hour.hoursid, hour.dateentered )">
                                    </td>
                                    <td>
                                        <input v-model="hourshoursedit[index].notes" type="text" class="form-control" id="create-link-notes" name="notes" @change="updatenotestoedit( hour.hoursid, hour.notes )">
                                    </td>
                                    <td>
                                        <input v-model="hourshoursedit[index].invoiceno" type="text" class="form-control" id="create-link-invoiceno" name="invoiceno" @change="updateinvoicenotoedit( hour.hoursid, hour.invoiceno )">
                                    </td>
                                    <td>
                                        <input v-model="hourshoursedit[index].hoursid" type="hidden" class="form-control" id="create-link-hoursid" name="hoursid">
                                    </td>
                                    <td>
                                        <a :v-model="hour.hoursid" :href="'/confirm/delete/hour/'+hour.hoursid" class="btn btn-primary">
                                            Delete
                                        </a>
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-primary" form="edit_hours_form"
                                                        data-form-id="edit_hours_form"
                                                        data-modal-id="edit-hours-modal"
                                                        @click="updatenumhourstoedit( hour.hoursid, hour.numhours );
                                                                updateuser_idtoedit( hour.hoursid, hour.user_id );
                                                                updatedateenteredtoedit( hour.hoursid, hour.dateentered );
                                                                updatenotestoedit( hour.hoursid, hour.notes );
                                                                updateinvoicenotoedit( hour.hoursid, hour.invoiceno );">Update</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
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
        }
    }
</script>