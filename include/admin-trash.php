
<div class="container" v-if="trash">
    <hr size="1 ">
    <h1><img src="image/recycle.png" width="64" height="64" alt=""> Recycle bin</h1>

    <div class="row">
        <div v-for="(column, colNum) in trash">
            <div class="block col-sm-6 col-lg-4" v-bind:class="{ dropped: block.deleted }" v-for="(block, blockName) in column">

                <div class="ui-icon ui-icon-key private" style="float: left;" v-if="block.private"></div>
                <h3 class="mt-3">
                    <span v-html="blockName"></span>
                    <a href="api/admin/block/restore.php" v-bind:data-id="block.id" v-on:click="restore"
                       class="ui-icon ui-icon-arrow-1-e-w">
                    </a>
                </h3>


                <table class="table-hover table-bordered">
                    <tr v-for="link in block.links">
                        <td>
                            <a v-bind:href="link.icon" target="_blank">
                                <img alt="" v-bind:src="link.icon" width="16" height="16">
                            </a>&nbsp;
                        </td>
                        <td>
                            <a v-bind:href="link.href" target="_blank" v-html="link.name"
                               v-bind:data-id="link.id" v-on:click="conversion"></a>
                        </td>
                        <td width="20">
                            <a href="api/admin/link/recovery.php" v-bind:data-id="link.id" v-on:click="recovery"
                               class="ui-icon ui-icon-arrow-1-e-w">
                            </a>
                        </td>
                    </tr>
                </table>

            </div>
        </div>
    </div>
    <br><br><br>
</div>
