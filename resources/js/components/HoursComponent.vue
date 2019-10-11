<template>
    <table class="table">
        <thead>
            <tr>    
                <th scope="col">Hour</th>
                <th class="border-0"></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="hour of hours" :key="hour.hoursid">
                <th scope="rows">
                    <a>{{ hour.hoursid }}</a>
                </th>
                <td class="border-0">
                    <a href="#" class="btn btn-primary">
                        Edit
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        props:[ 'hours' ]
    }
</script>