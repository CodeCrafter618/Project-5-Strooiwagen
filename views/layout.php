<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/example.css">
    <title><?= $this->e($title) ?></title>
    <style>
        /* Global table spacing to apply across views */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table th,
        table td {
            padding: 12px 10px;
        }

        /* sensible default column sizes for forms/tables */
        .col-naam {
            width: 28%;
        }

        .col-locatie {
            width: 20%;
        }
    </style>
</head>

<body>
    <?php require(__DIR__ . '/header.php'); ?>

    <main>
        <?= $this->section("content") ?>
    </main>

    <?php require(__DIR__ . '/footer.php'); ?>
</body>

</html>