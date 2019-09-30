<template>
    <div>
        <div class="row">
            <div class="d-inline col">
                <select name="customerUpdate" id="c" class="form-control">
                    <option value="">{{customer}}</option>
                        <option v-for="c of customers" v-bind:key="c.id">{{ c.name }}</option>
                </select>
            </div>
            <div class="d-inline col">
                <select name="statusUpdate" id="s" class="form-control">
                    <option value="">{{status}}</option>
                        <option v-for="s of statuses" v-bind:key="s.projstatusrowid">{{ s.projstatus }}</option>
                </select>
            </div>
            <div class="d-inline col">
                <button class="d-inline btn btn-primary">Update Project</button>
            </div>
        </div>
        <div class="row">
            <div class="d-inline col">
                Filter Tasks:
                <div class="form-group form-check-inline">
                    <input type="checkbox" class="form-check-input" id="openFilter">
                    <label class="form-check-label" for="openFilter">Open</label>
                </div>
                <div class="form-group form-check-inline">
                    <input type="checkbox" class="form-check-input" id="closedFilter">
                    <label class="form-check-label" for="closedFilter">Closed</label>
                </div>
                <div class="form-group form-check-inline">
                    <input type="checkbox" class="form-check-input" id="archivedFilter">
                    <label class="form-check-label" for="archivedFilter">Archived</label>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:[ 'customers', 
            'project',
            'customer',
            'status',
            'statuses',
        ]
    }
</script>