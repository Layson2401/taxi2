<html lang="ru_RU">

<head>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Users</title>
</head>
<body>
<h1 align="center">Users</h1>
<div class="container">
    <div>
        <a
            href="/users/create"
            class="btn btn-primary"
        >
            Добавить пользователя
        </a>
    </div>
    <table class="table table-striped">
        <caption>List of users</caption>
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Login</th>
            <th scope="col">Email</th>
            <th>Управление</th>
        </tr>
        </thead>
        <tbody>
        <?php /** @var array $users */
        foreach ($users as $user): ?>
                <tr>
                    <th scope="row"><?php echo $user->id ?></th>
                    <td><?php echo $user->login ?></td>
                    <td><?php echo $user->email ?></td>
                    <td>
                        <a class="btn btn-primary btn-sm"
                           href="/users/<?php echo $user->id; ?>/edit">Edit
                        </a>
                        <a class="btn btn-danger btn-sm"
                           href="/users/<?php echo $user->id; ?>/delete">Delete
                        </a>

                    </td>
                </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap в связке с Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

</body>
</html>