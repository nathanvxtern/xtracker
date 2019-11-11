<div>
    <a>
        Quick Add
    </a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">customer</th>
                <th scope="col">project</th>
                <th scope="col">task</th>
                <th scope="col">used of estimated</th>
                <th scope="col">empty column</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="task in currentObject.recenttasks" v-bind:key="task.taskrowid">
                <td>
                    @{{ task.custrowid }}
                </td>
                <td>
                    @{{ task.projrowid }}
                </td>
                <td>
                    @{{ task.taskrowid }}
                </td>
                <td>
                    used of estimated
                </td>
                <td>
                    <a href="/" class="btn btn-primary">
                        Add Hours
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
</div>