<div class="modal" id="modalLink" tabindex="-1">
    <div class="modal-guts">

        <form id="appEditLink">
            <h3>add/edit link
                <img v-bind:src="'https://api.aftaa.ru' + icon" alt="" style="max-width: 36px; max-height: 36px;">
            </h3>
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
            <div class="form-group">Icon: <br><input class="form-control" type="text" v-model="icon" value="">
                <small><a href="#" v-on:click="loadFavicon">загрузить на хост</a></small>
            </div>


            <div class="form-group">
                <label>
                    Private:
                    <input type="checkbox" v-model="private" true-value="1" false-value="0">
                </label>
            </div>

            <button type="submit" class="btn btn-primary" v-on:click="saveLink">SUBMIT</button>
        </form>

    </div>
</div>
