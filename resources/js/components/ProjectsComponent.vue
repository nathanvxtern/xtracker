<template>
        <b-table :items="projects" :fields="fields" caption-top>
            <template v-slot:table-caption>Projects</template>
            <b-button @click="getProjectTasks">title</b-button>
        </b-table>
</template>

<script>
    export default {
        props:[ 'projects',
        ],
        data() {
            return {
                fields: ['id', 'title', 'customer'],
                items: projects
            }
        }
    }
</script>