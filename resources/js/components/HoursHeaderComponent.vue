<template>
    <div>
        <a>Task</a>
        <a>{{ taskrowid }}</a>
    </div>
</template>

<script>
    export default {
        props:[ 'taskrowid',
        ]
    }
</script>