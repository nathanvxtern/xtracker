<template>
        <b-table :items="projects" caption-top>
            <template v-slot:table-caption>Projects</template>
            <template v-slot:cell(title)="data">
                <button type="button" class="btn btn-link" @click="gettasks( data ); getprojectcustomer( data );">
                    {{ data.value }}
                </button>
            </template>
        </b-table>
</template>

<script>
    export default {
        props:[ 'projects',
        ],
        methods: {
            getprojectcustomer: function( title )
            {
                let self = this;
                
                let current_path = "/customer/" + title;

                HTTP.get( current_path )

                    .then( response => {
                        console.log( response );
                        if( response.data.data ) {
                            console.log( response.data.data );
                            self.currentcustomer = response.data.data;
                        } else {
                            self.currentcustomer = [];
                        }
                    })

                    .catch( e => {
                        console.log( e );

                });
            },
            gettasks: function( title )
            {
                let self = this;
                
                let current_path = "/projecttasks/" + title;

                HTTP.get( current_path )

                    .then( response => {
                        console.log( response );
                        if( response.data.data ) {
                            console.log( response.data.data );
                            self.tasks = response.data.data;
                        } else {
                            self.tasks = [];
                        }
                    })

                    .catch( e => {
                        console.log( e );

                });
            },
        }
    }
</script>