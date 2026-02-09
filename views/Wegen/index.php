<?php $this->layout("layout", ["title" => "Wegenbeheer"]) ?>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #fff;
        margin: 0;
    }

    .weg-tabel-wrapper {
        display: flex;
        justify-content: center;
        margin: 40px 0;
    }

    .weg-tabel {
        border-collapse: collapse;
        width: 95%;
        max-width: 1300px;
        border: 2px solid #8A99FF;
    }

    /* Header styling */
    .weg-tabel thead th {
        border: 2px solid #8A99FF;
        padding: 20px 10px;
        text-align: center;
        color: #333;
        font-weight: bold;
        font-size: 15px;
        background-color: #fff;
    }

    /* Cell styling */
    .weg-tabel tbody td {
        border: 2px solid #8A99FF;
        padding: 15px 10px;
        text-align: center;
        color: #333;
        font-size: 15px;
    }

    /* Input container voor gradenteken */
    .input-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 2px;
    }

    /* Input styling */
    .weg-tabel input {
        width: 100%;
        border: none;
        text-align: center;
        font-size: 15px;
        outline: none;
        background: transparent;
        padding: 8px 0;
    }

    /* Specifieke breedte voor getal-inputs om gradenteken er strak naast te houden */
    .input-wrapper input {
        width: 40px;
    }

    .weg-tabel input:focus {
        background-color: #f0f2ff;
        border-radius: 4px;
    }

    .col-temp-edit {
        width: 120px;
    }

    .temp-badge {
        font-weight: bold;
        font-size: 16px;
    }

    /* Acties kolom */
    .btn-del {
        background: none;
        border: none;
        cursor: pointer;
        padding: 0;
        font-size: 22px;
        transition: transform 0.2s;
        display: inline-block;
    }

    .btn-del:hover {
        transform: scale(1.2);
    }
</style>

<?php foreach ($wegen as $weg):
    $ws = $weg->getWeersomstandigheden()->toArray();
    usort($ws, fn($a, $b) => $b->getTemperatuur() <=> $a->getTemperatuur());
    ?>
    <div class="weg-tabel-wrapper">
        <form action="/wegen/edit/<?= $weg->getId() ?>" method="POST" style="width:100%; max-width:1300px;">
            <table class="weg-tabel">
                <thead>
                    <tr>
                        <th style="width: 200px;">Naam</th>
                        <th style="width: 200px;">Locatie</th>
                        <th style="width: 120px;">Duur</th>
                        <th style="width: 120px;">Weglengte</th>
                        <th style="width: 90px;">Nu</th>

                        <th class="col-temp-edit">
                            <div class="input-wrapper">
                                <input type="number" name="t1" value="<?= $ws[0]?->getTemperatuur() ?? 0 ?>"
                                    onblur="this.form.submit()">°C
                            </div>
                        </th>
                        <th class="col-temp-edit">
                            <div class="input-wrapper">
                                <input type="number" name="t2" value="<?= $ws[1]?->getTemperatuur() ?? -5 ?>"
                                    onblur="this.form.submit()">°C
                            </div>
                        </th>
                        <th class="col-temp-edit">
                            <div class="input-wrapper">
                                <input type="number" name="t3" value="<?= $ws[2]?->getTemperatuur() ?? -10 ?>"
                                    onblur="this.form.submit()">°C
                            </div>
                        </th>

                        <th style="width: 120px;">Acties</th>
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
                        <td><input type="number" name="weglengte" value="<?= $weg->getWeglengte() ?>"
                                onblur="this.form.submit()"></td>
                        <td>
                            <span class="temp-badge">
                                <?= $weg->getHuidigeTemperatuur() !== null ? number_format($weg->getHuidigeTemperatuur(), 1) : '--' ?>°C
                            </span>
                        </td>

                        <td><input type="number" name="f1" value="<?= $ws[0]?->getFrequentie() ?? 0 ?>"
                                onblur="this.form.submit()"></td>
                        <td><input type="number" name="f2" value="<?= $ws[1]?->getFrequentie() ?? 0 ?>"
                                onblur="this.form.submit()"></td>
                        <td><input type="number" name="f3" value="<?= $ws[2]?->getFrequentie() ?? 0 ?>"
                                onblur="this.form.submit()"></td>

                        <td>
                            <button type="submit" form="del-<?= $weg->getId() ?>" class="btn-del">🗑️</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

    <form id="del-<?= $weg->getId() ?>" action="/wegen/delete/<?= $weg->getId() ?>" method="POST"
        onsubmit="return confirm('Weg verwijderen?')"></form>
<?php endforeach; ?>

<a href="/wegen/new" class="plus-btn">+</a>