<div class="modal" id="modalLink" tabindex="-1">
    <div class="modal-guts">
        <h3>add/edit link</h3>

        <form id="appEditLink">
            <div class="form-group">
                Block:<br>
                <select v-model="block_id" class="form-control" required>
                    <option v-for="(block, block_id) in blocks" v-bind:value="block_id">
                        {{ block }}
                    </option>
                </select>
            </div>
            <div class="form-group">Name: <br><input class="form-control" type="text" v-model="name" value=""></div>
            <div class="form-group">Href: <br><input class="form-control" type="text" v-model="href" value=""></div>
            <div class="form-group">Icon: <br><input class="form-control" type="text" v-model="icon" value=""></div>

            <div class="form-group">
                <label>
                    Private:
                    <input type="checkbox" v-model="private" true-value="1" false-value="0">
                </label>
            </div>

            <button type="submit" class="btn btn-primary" v-on:click="saveLink">Save link</button>
        </form>

    </div>
</div>
