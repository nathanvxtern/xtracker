<template>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Task</th>
                <th scope="col" class="border-0"></th>
                <th scope="col">Hours:</th>
                <th scope="col"></th>
                <th scope="col" class="table-secondary">Est.</th>
                <th scope="col" class="table-secondary">Used</th>
                <th scope="col" class="table-secondary">Rate</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="task of tasks" v-bind:key="task.id">
                <th scope="rows">
                    <a href="#" @click="populateedittaskmodal( task.taskrowid, task.title, task.esthours, task.usedhrs, task.billingrate )" data-toggle="modal" data-target="#editTaskModal">
                        {{ task.title }}
                    </a>
                </th>
                <td class="border-0">
                </td>
                <td class="border-0">
                    <button @click="populatehourmodal( task.taskrowid )" type="button" class="btn btn-primary" data-toggle="modal" data-target="#addHoursModal">
                        Add
                    </button>
                </td>
                <td class="border-0">
                    <button @click="populateedithourmodal( task.taskrowid, task.hours )" type="button" class="btn btn-primary" data-toggle="modal" data-target="#editHoursModal">
                        Edit
                    </button>
                </td>
                <td class="table-secondary">{{ task.esthours }}</td>
                <td class="table-secondary">{{ task.usedhrs }}</td>
                <td class="table-secondary">{{ task.billingrate }}</td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        props:[ 'tasks',
            'projstatusrowid',
            'projtyperowid',
            'taskrowidadd',
        ],
        methods: {
            populatehourmodal: function(taskrowidadd)
            {
                let self = this.$parent;
                self.taskrowidadd = taskrowidadd;
                console.log( self.taskrowidadd );
            },
            populateedithourmodal: function(taskrowidhoursedit,hourshoursedit)
            {
                let self = this.$parent;
                self.taskrowidhoursedit = taskrowidhoursedit;
                self.hourshoursedit = hourshoursedit;
            },
            populateedittaskmodal: function(taskrowidtaskedit,edittasktitle,edittaskesthours,edittaskusedhrs,edittaskbillingrate)
            {
                let self = this.$parent;
                self.taskrowidtaskedit = taskrowidtaskedit;
                self.edittasktitle = edittasktitle;
                self.edittaskesthours = edittaskesthours;
                self.edittaskusedhrs = edittaskusedhrs;
                self.edittaskbillingrate = edittaskbillingrate;
            }
        }
    }
</script>