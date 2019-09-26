<template>
    <table class="table">
        <thead>
            <tr>    
                <th scope="col">Project</th>
                <th scope="col">Customer</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="project of currentprojects" v-bind:key="project.id">
                <th scope="rows">
                    <a href="#" @click="this.$emit( 'getProjectTasks', project.id ); this.$emit('getProjectCustomer', project.id );">
                        {{ project.title }}
                    </a>
                </th>
                <td>{{ project.customer }}</td>
            </tr>
        </tbody>
    </table>
</template>

<script>

    export default {
        props:[ 'currentprojects',  
                'currentproject',
                'currentcustomer',
                'currentprojecttasks' ],
        methods: {
        }
    }
    
</script>