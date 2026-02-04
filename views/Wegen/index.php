<?php $this->layout("layout", ["title" => "Wegenbeheer"]) ?>

<style>
    body {
        font-family: sans-serif;
        background-color: #fff;
        margin: 0;
    }

    .header-yellow {
        background: #ffde59;
        padding: 20px;
        text-align: center;
        border-bottom: 2px solid #000;
        margin-bottom: 40px;
    }

    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 40px;
        padding-bottom: 100px;
    }

    /* De tabelstijl van de afbeelding */
    .weg-table {
        border-collapse: collapse;
        width: 90%;
        max-width: 800px;
        background: white;
        border: 3px solid #8a70ff;
        /* De paarse dikke rand */
    }

    .weg-table th,
    .weg-table td {
        border: 1px solid #8a70ff;
        padding: 15px;
        text-align: center;
        color: #000;
    }

    .weg-table th {
        font-weight: bold;
        background: #fff;
    }

    /* Input styling */
    .weg-table input {
        border: none;
        background: transparent;
        text-align: center;
        width: 100%;
        font-size: 16px;
        outline: none;
    }

    .h-in {
        font-weight: bold;
        width: 45px !important;
    }

    /* Actie knoppen */
    .btn-icon {
        background: none;
        border: none;
        cursor: pointer;
        font-size: 24px;
        padding: 0 5px;
    }

    /* De vierkante gele plus-knop */
    .plus-btn {
        position: fixed;
        bottom: 0;
        right: 0;
        background: #ffde59;
        width: 120px;
        height: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        font-size: 80px;
        color: black;
        font-weight: bold;
    }
</style>
<nav class="navbar-container">
    <div class="logo-section">
        <img src="logo_sudwest_fryslan.png" alt="Gemeente Súdwest-Fryslân">
    </div>

    <div class="nav-links">
        <a href="/">Home</a>
        <a href="wegen">Wegen beheer</a>
    </div>
</nav>
<br>

<div class="container">
    <?php foreach ($wegen as $weg):
        $ws = $weg->getWeersomstandigheden()->toArray(); ?>

        <form action="/wegen/edit/<?= $weg->getId() ?>" method="POST"
            style="width: 100%; display: flex; justify-content: center;">
            <table class="weg-table">
                <thead>
                    <tr>
                        <th>Naam</th>
                        <th>Locatie</th>
                        <th>Duur</th>
                        <th><input type="number" name="t1" class="h-in" value="<?= $ws[0]?->getTemperatuur() ?? 0 ?>"
                                onblur="this.form.submit()"></th>
                        <th><input type="number" name="t2" class="h-in" value="<?= $ws[1]?->getTemperatuur() ?? -5 ?>"
                                onblur="this.form.submit()"></th>
                        <th><input type="number" name="t3" class="h-in" value="<?= $ws[2]?->getTemperatuur() ?? -10 ?>"
                                onblur="this.form.submit()"></th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" name="naam" value="<?= $this->e($weg->getNaam()) ?>"
                                onblur="this.form.submit()"></td>
                        <td><input type="text" name="locatie" value="<?= $this->e($weg->getLocatie()) ?>"
                                onblur="this.form.submit()"></td>
                        <td><input type="text" name="strooiduur" value="<?= $weg->getStrooiduur() ?> min"
                                onblur="this.form.submit()"></td>
                        <td><input type="number" name="f1" value="<?= $ws[0]?->getFrequentie() ?? 0 ?>"
                                onblur="this.form.submit()"></td>
                        <td><input type="number" name="f2" value="<?= $ws[1]?->getFrequentie() ?? 0 ?>"
                                onblur="this.form.submit()"></td>
                        <td><input type="number" name="f3" value="<?= $ws[2]?->getFrequentie() ?? 0 ?>"
                                onblur="this.form.submit()"></td>
                        <td style="white-space: nowrap;">
                            <button type="submit" form="del-<?= $weg->getId() ?>" class="btn-icon">🗑️</button>

                        </td>
                    </tr>
                </tbody>
            </table>
        </form>

        <form id="del-<?= $weg->getId() ?>" action="/wegen/delete/<?= $weg->getId() ?>" method="POST"
            onsubmit="return confirm('Weg verwijderen?')"></form>

    <?php endforeach; ?>
</div>

<a href="/wegen/new" class="plus-btn">+</a>