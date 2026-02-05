<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< Updated upstream
    <title><?= $this->e($title) ?></title>
</head>

<body>

=======
    <link rel="stylesheet" href="/example.css">
    <title>
        <?= $this->e($title) ?>
    </title>
    <style>

    </style>
</head>

<body>
    <?= $this->insert("header") ?>
>>>>>>> Stashed changes
    <?= $this->section("content") ?>
    <?= $this->insert("footer") ?>
</body>

</html>