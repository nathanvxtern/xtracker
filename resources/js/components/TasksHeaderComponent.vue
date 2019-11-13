The row in the index file that contained this header
        <div class="row">
            <div class="col">
                <tasks-header-component :customers="currentObject.customers"
                                        :statuses="currentObject.statuses"
                                        v-bind:projrowid="projrowid"
                                        v-bind:customer="customer"
                                        v-bind:status="status">
                <tasks-header-component>
            </div>
        </div>

<template>
    <div>
        Selected Project
        <div class="row">
            <div class="d-inline col">
                <select name="customerUpdate" id="customerUpdate" class="form-control">
                    <option value="customer" selected>{{ customer }}</option>
                    <option v-for="customer of customers" :key="customer.custrowid">{{ customer.name }}</option>
                </select>
            </div>
            <div class="d-inline col">
                <select name="statusUpdate" id="statusUpdate" class="form-control">
                    <option value="status" selected>{{ status }}</option>
                    <option v-for="status of statuses" :key="status.projstatusrowid">{{ status.projstatus }}</option>
                </select>
            </div>
            <div class="d-inline col">
                <button class="d-inline btn btn-primary">Update Project</button>
            </div>
        </div>
        <div class="row">
            <div class="d-inline col">
                Task Status:
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
            'statuses',
            'projrowid',
            'customer',
            'status',
        ]
    }
</script>