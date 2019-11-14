<template>
    <div>
        <div class="row">
            <div>
                Hours
            </div>
            <div class="col">
                <button @click="populatehourmodal( task.taskrowid )" type="button" class="btn btn-primary" data-toggle="modal" data-target="#addHoursModal">
                    Add
                </button>
            </div>
        </div>
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
                        <button @click="populatehourmodal( task.taskrowid )" type="button" class="btn btn-primary" data-toggle="modal" data-target="#addHoursModal">
                            Add
                        </button>
                    </td>
                    <td>
                        <button>
                            View Hours
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>