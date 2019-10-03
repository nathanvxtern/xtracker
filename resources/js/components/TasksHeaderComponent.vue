<template>
    <div>
        <div class="row">
            <div class="d-inline col">
                <select name="customerUpdate" id="customerUpdate" class="form-control">
                    <option value="" selected>Customer</option>
                    <option v-for="customer of customers" v-bind:key="customer.custrowid">{{ customer.name }}</option>
                </select>
            </div>
            <div class="d-inline col">
                <select name="statusUpdate" id="statusUpdate" class="form-control">
                    <option value="" selected>Status</option>
                    <option v-for="status of statuses" v-bind:key="status.projstatusrowid">{{ status.projstatus }}</option>
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