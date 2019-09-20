<template>
        <b-table :items="projects" caption-top>
            <template v-slot:table-caption>Projects</template>
            <template v-slot:cell(title)="data">
                <button type="button" class="btn btn-link" @click="tasks( '{{ $project->id }}' ); getProjectCustomer( '{{ $project->id }}' );">
                    {{ data.value }}
                </button>
            </template>
        </b-table>
</template>

<script>
    export default {
        props:[ 'projects',
        ],
    }
</script>