<?php $this->layout("layout", ["title" => "Nieuwe Weg"]) ?>

<style>
    body {
        font-family: sans-serif;
        background-color: #f4f4f4;
        margin: 0;
    }

    .header-geel {
        background-color: #ffde59;
        padding: 20px;
        text-align: center;
        border-bottom: 3px solid black;
    }

    .form-box {
        background: white;
        width: 450px;
        margin: 50px auto;
        padding: 30px;
        border: 3px solid #000000;
        ;
        border-radius: 10px;

    }

    .form-box label {
        font-weight: bold;
        display: block;
        margin-top: 10px;
    }

    .form-box input {
        width: 100%;
        padding: 12px;
        margin-top: 5px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 16px;
    }

    .temp-freq-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin-top: 10px;
    }

    .knop-opslaan {
        background-color: #ffde59;
        width: 100%;
        padding: 15px;
        font-weight: bold;
        border: 2px solid black;
        cursor: pointer;
        font-size: 18px;
        margin-top: 20px;
        text-transform: uppercase;
    }

    .knop-opslaan:hover {
        background-color: #e5c750;
    }
</style>



<div class="form-box">
    <form method="POST">
        <label>Naam van de weg:</label>
        <input type="text" name="naam" placeholder="Bijv. A7" required>

        <label>Locatie (voor temperatuur):</label>
        <input type="text" name="locatie" placeholder="Bijv. Sneek" required>

        <label>Weglengte (in KM):</label>
        <input type="number" step="1" name="weglengte" placeholder="Bijv. 20" required>

        <label>Strooiduur (minuten):</label>
        <input type="number" name="strooiduur" placeholder="Bijv. 15" required>

        <hr style="margin: 20px 0; border: 1px solid #eee;">
        <p><strong>Drempels (Temperatuur & Frequentie):</strong></p>

        <div class="temp-freq-grid" style="font-size: 12px; color: #666;">
            <span>Temperatuur (°C)</span>
            <span>Frequentie (Efficiency)</span>
        </div>

        <?php for ($i = 1; $i <= 3; $i++): ?>
            <div class="temp-freq-grid">
                <input type="number" name="t<?= $i ?>" value="<?= ($i - 1) * -5 ?>" title="Drempel Temperatuur">
                <input type="number" name="f<?= $i ?>" placeholder="Aantal wagens" required>
            </div>
        <?php endfor; ?>

        <button type="submit" class="knop-opslaan">Opslaan en Terug</button>
    </form>
</div>