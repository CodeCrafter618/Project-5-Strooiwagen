<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $this->e($title) ?>
    </title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar-container {
            background-color: #FFD966;
            display: flex;
            align-items: center;
            padding: 10px 40px;
            height: 80px;
            box-sizing: border-box;
        }

        .logo-section {
            display: flex;
            align-items: center;
            flex: 1;
        }

        .logo-section img {
            height: 50px;
            margin-right: 15px;
        }

        .nav-links {
            display: flex;
            gap: 50px;
            margin-right: 100px;
        }

        .nav-links a {
            text-decoration: none;
            color: #000;
            font-size: 32px;
            font-weight: 400;
        }

        .nav-links a:hover {
            opacity: 0.7;
        }

        .hoofd-titel {
            text-align: center;
            color: #bf0042;
            font-family: "proxima-nova", sans-serif;
            margin-top: 40px;
        }

        .cijfer {
            text-align: center;
            color: #53bf00;
            font-family: "Bree Serif", sans-serif;
            font-size: 64px;
            margin-bottom: 40px;
        }

        /* Weer Container Styling */
        .weer-container {
            display: flex;
            justify-content: center;
            margin: 20px auto;
            border: 4px solid #000;
            width: fit-content;
            overflow: hidden;
        }

        .weer-blok {
            width: 200px;
            height: 120px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            border-right: 2px solid #000;
            font-family: "proxima-nova", sans-serif;
        }

        .weer-blok:last-child {
            border-right: none;
        }

        /* Kleur Klassen */
        .blauw {
            background-color: #00B0F0;
            color: #000;
        }

        .geel {
            background-color: #FFD966;
            color: #000;
        }

        .oranje {
            background-color: #FFC000;
            color: #000;
        }

        .rood {
            background-color: #FF0000;
            color: #fff;
        }

        .groen {
            background-color: #92D050;
            color: #000;
        }

        .label {
            font-weight: bold;
            font-size: 20px;
            margin-bottom: 5px;
        }

        .waarde {
            font-size: 18px;
        }

        .datum {
            text-align: center;
            color: #bf0042;
            font-family: "proxima-nova", sans-serif;
            margin-top: 40px;
        }

        .analyse-sectie {
            text-align: center;
            font-family: "proxima-nova", sans-serif;
            padding: 20px;
            max-width: 1100px;
            margin: 0 auto;
        }

        .analyse-sectie h2 {
            color: #bf0042;
            /* De paars-rode kleur uit je screenshot */
            font-size: 48px;
            margin-bottom: 10px;
            font-weight: 400;
        }

        .analyse-sectie h3 {
            color: #888;
            /* Grijze kleur voor de subkop */
            font-size: 32px;
            margin-bottom: 20px;
            font-weight: 400;
        }

        .analyse-sectie p {
            font-size: 20px;
            line-height: 1.4;
            color: #000;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <?= $this->section("content") ?>
</body>

</html>