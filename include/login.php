тут будет логин

<div v-if="status == 500" class="alert-danger">
    500 Internal Server Error
</div>

<div class="alert-warning" v-if="401 == status">
    Вы не авторизованы.
</div>
