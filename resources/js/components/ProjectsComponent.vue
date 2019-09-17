<template>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Project</th>
                <th scope="col">Customer</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="project of projects" v-bind:key="project.id">
                <th scope="row">
                    <b-button @click="getProjectTasks( '{{ project.id }}' ); getProjectCustomer( '{{ project.id }}' );">
                        {{ project.title }}
                    </b-button>
                </th>
                <td>{{ project.customer }}</td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        props:[ 
            'projects',
        ]
    }
</script>