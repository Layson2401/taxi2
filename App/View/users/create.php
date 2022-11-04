<?php include './App/View/layout/header.php' ?>
<h1 align="center">Users</h1>
<div class="container">
    <form method="post" action="/users/add">
        <div class="form-group">
            <label for="login">Логин:</label>
            <input type="text"
                   name="login"
                   class="form-control"
                   id="login"
                   placeholder="Введите логин">
        </div>
        <div class="form-group">
            <label for="password">Пароль:</label>
            <input type="text"
                   name="password"
                   class="form-control"
                   id="password"
                   placeholder="Введите пароль">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text"
                   name="email"
                   class="form-control"
                   id="email"
                   placeholder="Введите email">
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
</div>
<?php include './App/View/layout/footer.php' ?>