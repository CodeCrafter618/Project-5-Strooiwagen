<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/example.css">
    <title><?= $this->e($title) ?></title>
</head>

<body>
    <?php require(__DIR__ . '/header.php'); ?>

    <main>
        <?= $this->section("content") ?>
    </main>

    <?php require(__DIR__ . '/footer.php'); ?>
</body>

</html>