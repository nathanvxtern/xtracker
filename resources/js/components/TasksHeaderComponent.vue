<template>
    <div>
        <div class="row">
            <div class="d-inline col">
                <b-dropdown id="projectCustomerDropdown" :text=currentcustomer class="d-inline m-md-2">
                    <b-dropdown-item v-for="customer of customers" v-bind:key="customer.name">{{ customer.name }}</b-dropdown-item>
                </b-dropdown>
                <div class="d-inline dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="projectStatus" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ currentproject ? "Status" : "Current Status" }}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="projectStatus">
                        <a class="dropdown-item" href="#">Open</a>
                        <a class="dropdown-item" href="#">Closed</a>
                    </div>
                </div>
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
        'currentproject',
        'currentcustomer',
        ]
    }
</script>