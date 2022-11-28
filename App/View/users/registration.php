<?php include './App/View/layout/header.php' ?>

<div class="container" align="center">
    <div class="reg_form">
        <form method="post" action="/registration">
            <div class="form-group">
                <label for="email">Почта:</label>
                <input type="text"
                       name="email"
                       class="form-control"
                       id="email"
                       placeholder="Введите почту">
            </div>
            <div class="form-group">
                <label for="login">Почта:</label>
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
            <div align="left">
                <input type="radio" name="role_id" value="1" /> Regular <br>
                <input type="radio" name="role_id" value="2" /> Driver
            </div>
            <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
        </form>
    </div>
</div>
<style>
    .reg_form {
        max-width: 300px;
        margin-top: 100px;
    }
    div {
        margin: 10px;
    }
</style>

<?php include './App/View/layout/footer.php' ?>
