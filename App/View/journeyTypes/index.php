<html lang="ru_RU">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>JourneyTypes</title>
</head>
<body>
<h1 align="center">JourneyTypes</h1>
<div>
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
        </tr>
        </thead>
        <tbody>
        <?php /** @var array $journeyTypes */
        foreach ($journeyTypes as $journeyType):?>
            <tr>
                <th scope="row"><?php echo $journeyType->id ?></th>
                <td><?php echo $journeyType->name ?></td>
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