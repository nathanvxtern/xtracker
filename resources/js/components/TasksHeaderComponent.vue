<template>
    <div>
        <div>
            <div class="d-inline">
                Customer:
                <b-dropdown id="projectCustomerDropdown" :text=currentcustomer class="m-md-2">
                    <b-dropdown-item v-for="customer of customers" v-bind:key="customer.name">{{ customer.name }}</b-dropdown-item>
                </b-dropdown>
            </div>
            <div class="d-inline">
                Project Status:
                <div class="d-inline dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="projectStatus" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ currentproject ? "No Project Selected" : "Current Status" }}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="projectStatus">
                        <a class="dropdown-item" href="#">Open</a>
                        <a class="dropdown-item" href="#">Closed</a>
                    </div>
                </div>
            </div>
            <a href="#" class="d-inline btn btn-primary">Update Project</a>
        </div>
        <div>
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
</template>

<script>
    export default {
        props:[ 'customers', 
            'currentproject',
            'currentcustomer',
        ]
    }
</script>