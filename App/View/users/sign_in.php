<?php include './App/View/layout/header.php' ?>

<div class="container" align="center">
    <div class="sign_in_form">
        <form method="post" action="/sign_in">
            <div class="form-group">
                <label for="email">Почта:</label>
                <input type="text"
                       name="email"
                       class="form-control"
                       id="email"
                       placeholder="Введите почту">
            </div>
            <div class="form-group">
                <label for="password">Пароль:</label>
                <input type="text"
                       name="password"
                       class="form-control"
                       id="password"
                       placeholder="Введите пароль">
            </div>
            <button type="submit" class="btn btn-primary">Войти</button>
        </form>
    </div>
</div>
<style>
    .sign_in_form {
        max-width: 300px;
        margin-top: 100px;
    }
</style>

<?php include './App/View/layout/footer.php' ?>
