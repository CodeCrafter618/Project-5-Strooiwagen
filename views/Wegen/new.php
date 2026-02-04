<?php $this->layout("layout", ["title" => "Nieuwe Weg"]) ?>

<style>
    body {
        font-family: sans-serif;
        background-color: #f4f4f4;
    }

    .header-geel {
        background-color: #ffde59;
        padding: 20px;
        text-align: center;
        border-bottom: 3px solid black;
    }

    .form-box {
        background: white;
        width: 400px;
        margin: 50px auto;
        padding: 20px;
        border: 3px solid #8a70ff;
        border-radius: 10px;
    }

    .form-box input {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        box-sizing: border-box;
        /* Zorgt dat input niet uit het kader loopt */
    }

    .knop-opslaan {
        background-color: #ffde59;
        width: 100%;
        padding: 12px;
        font-weight: bold;
        border: 2px solid black;
        cursor: pointer;
    }

    .knop-opslaan:hover {
        background-color: #e5c750;
    }
</style>



<div class="header-geel">
    <h1 style="margin: 0;">Nieuwe Weg Toevoegen</h1>
</div>

<div class="form-box">
    <form method="POST">
        <label>Naam van de weg:</label>
        <input type="text" name="naam" placeholder="Bijv. A7 " required>

        <label>Locatie:</label>
        <input type="text" name="locatie" placeholder="Bijv. Sneek" required>

        <label>Strooiduur (minuten):</label>
        <input type="number" name="strooiduur" placeholder="Bijv.  15" required>

        <hr>
        <p><strong>Stel de 3 temperaturen in:</strong></p>

        <?php for ($i = 1; $i <= 3; $i++): ?>
            <div style="display: flex; gap: 5px;">
                <input type="number" name="t<?= $i ?>" value="<?= ($i - 1) * -5 ?>" title="Temp">
                <input type="number" name="f<?= $i ?>" placeholder="Aantal keer" required>
            </div>
        <?php endfor; ?>

        <button type="submit" class="knop-opslaan">Opslaan en Terug</button>
    </form>
</div>