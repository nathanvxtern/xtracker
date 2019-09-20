<template>
    <table class="table">
        <thead>
            <tr>    
                <th scope="col">Task</th>
                <th scope="col">Est. Hours</th>
                <th scope="col">Used Hours</th>
                <th scope="col">Rate/Hour</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="task of tasks" v-bind:key="task.title">
                <th scope="rows">
                    <a href="#" data-toggle="modal" data-target="#editTaskModal">
                        {{ task.title }}
                    </a>
                </th>
                <td>Est Hours</td>
                <td>Used Hours</td>
                <td>Rate/Hour</td>
                <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addHoursModal">
                        Add Hours
                    </button>
                </td>
                <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editHoursModal">
                        Edit Hours
                    </button>
                </td>
                <td>
                    <a href="#" class="btn btn-primary">
                        Delete Task
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        props:[ 'tasks',
        ],
    }
</script>