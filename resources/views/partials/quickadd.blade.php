<div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">customer</th>
                <th scope="col">project</th>
                <th scope="col">task</th>
                <th scope="col">used of estimated</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="task in currentobject.recenttasks" v-bind:key="task.taskrowid">
                <td>
                    @{{ task.proj.customer.name }}
                </td>
                <td>
                    @{{ task.proj.title }}
                </td>
                <td>
                    @{{ task.title }}
                </td>
                <td>
                    @{{ task.usedhrs }} of @{{ task.esthours }} hours
                </td>
                <td>
                    <button @click="populatehourmodal( task.taskrowid,task.proj.custrowid,task.hours )" type="button" class="btn btn-primary" data-toggle="modal" data-target="#addHoursModal">
                        Add
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</div>