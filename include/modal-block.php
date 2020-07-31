<div class="modal" id="modalBlock" tabindex="-1">
    <div class="modal-guts">
        <h4>add/edit block</h4>

        <form id="appBlock">
            <div class="form-group">Name: <br><input class="form-control" type="text" v-model="name" value=""></div>
            <div class="form-group">ColNum: <br><input class="form-control" type="text" v-model.number="col_num" value=""></div>
            <div class="form-group">Sort: <br><input class="form-control" type="text" v-model.number="sort" value=""></div>

            <div class="form-group">
                <label>
                    Private:
                    <input type="checkbox" v-model="private" true-value="1" false-value="0">
                </label>
            </div>

            <button type="submit" class="btn btn-primary" v-on:click="saveBlock">submit</button>
        </form>

    </div>
</div>
