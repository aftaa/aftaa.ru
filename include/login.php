<div v-if="status == 500" class="alert-danger">
    500 Internal Server Error
</div>

<div class="alert-warning" v-if="status == 401">
    Вы не авторизованы.
</div>
