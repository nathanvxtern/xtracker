<div class="row">
    <div class="d-inline col">
        <select v-model="ctofilter" name="ctofilter" id="ctofilter" class="form-control" v-on:change="cfilter( ctofilter );">
            <option selected>Customer</option>
            <option v-for="customer in currentObject.customers" :key="customer.custrowid">@{{ customer.name }}</option>
        </select>
    </div>
    <div class="d-inline col">
        <div class="form-group form-check-inline">
            <input type="checkbox" class="form-check-input" id="openFilter">
            <label class="form-check-label" for="openFilter">Open</label>
        </div>
        <div class="form-group form-check-inline">
            <input type="checkbox" class="form-check-input" id="closedFilter">
            <label class="form-check-label" for="closedFilter">Closed</label>
        </div>
    </div>
    <div class="d-inline col">
        <a href="/filter/Customer" class="btn btn-primary">Filter</a>
        <a href="#" class="btn btn-primary">Reset</a>
    </div>
</div>