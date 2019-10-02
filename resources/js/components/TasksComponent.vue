<template>
    <table class="table">
        <thead>
            <tr>    
                <th scope="col">Task</th>
                <th scope="col" class="table-secondary">Hours:</th>
                <th scope="col" class="table-secondary">Est.</th>
                <th scope="col" class="table-secondary">Used</th>
                <th scope="col" class="table-secondary">Rate</th>
                <th class="table-secondary"></th>
                <th class="table-secondary"></th>
                <th class="border-0"></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="task of tasks" v-bind:key="task.id">
                <th scope="rows">
                    <a href="#" data-toggle="modal" data-target="#editTaskModal">
                        {{ task.title }}
                    </a>
                </th>
                <td class="table-secondary"></td>
                <td class="table-secondary">{{ task.esthours }}</td>
                <td class="table-secondary">Used</td>
                <td class="table-secondary">{{ task.billingrate }}</td>
                <td class="table-secondary">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addHoursModal">
                        Add
                    </button>
                </td>
                <td class="table-secondary">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editHoursModal">
                        Edit
                    </button>
                </td>
                <td class="border-0">
                    <a href="#" class="btn btn-primary">
                        Delete
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        props:[ 'tasks' ]
    }
</script>