<div class="row">
    <div class="d-inline col">
        <select v-model="ctofilter" name="ctofilter" id="ctofilter" class="form-control" v-on:change="cfilter( ctofilter );">
            <option selected>Customer</option>
            <option v-for="customer in currentobject.customers" :key="customer.custrowid">@{{ customer.name }}</option>
        </select>
    </div>
    <div class="d-inline col">
        <a :href="'/filter/'+ctofilter+'/'+popentofilter+'/'+pclosedtofilter" class="btn btn-primary">Filter</a>
        <a href="/" class="btn btn-primary">Reset</a>
    </div>
</div>
<div class="row">
    <div class="d-inline col">
        Project Status:
        <div class="form-group form-check-inline">
            <input type="checkbox" class="form-check-input" id="popentofilter" v-on:change="popenfilter( popentofilter );">
            <label class="form-check-label" for="popentofilter">Open</label>
        </div>
        <div class="form-group form-check-inline">
            <input type="checkbox" class="form-check-input" id="pclosedtofilter" v-on:change="pclosedfilter( pclosedtofilter );">
            <label class="form-check-label" for="pclosedtofilter">Closed</label>
        </div>
    </div>
</div>