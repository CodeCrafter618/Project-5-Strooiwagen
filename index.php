<?php $this->layout("layout", ["title" => "Wegenbeheer"]) ?>

<style>
    .weg-tabel-wrapper {
        display: flex;
        justify-content: center;
        margin: 40px 0;
    }

    .weg-tabel {
        border-collapse: collapse;
        width: 90%;
        max-width: 1200px;
        border: 3px solid #6B8FFF;
    }

    .weg-tabel thead th,
    .weg-tabel tbody td {
        border-right: 3px solid #6B8FFF;
        border-bottom: 3px solid #6B8FFF;
        padding: 16px 12px;
        text-align: center;
        font-weight: 500;
    }

    .weg-tabel thead th:last-child,
    .weg-tabel tbody td:last-child {
        border-right: none;
    }

    .weg-tabel tbody tr:last-child td {
        border-bottom: none;
    }

    .weg-tabel thead th {
        background: #f9f9f9;
        font-weight: bold;
    }

    .weg-tabel input {
        width: 100%;
        border: 1px solid #ddd;
        padding: 4px;
        box-sizing: border-box;
    }
</style>

<?php foreach ($wegen as $weg):
    $ws = $weg->getWeersomstandigheden()->toArray();
    usort($ws, fn($a, $b) => $b->getTemperatuur() <=> $a->getTemperatuur());
    ?>
    <div class="weg-tabel-wrapper">
        <form action="/wegen/edit/<?= $weg->getId() ?>" method="POST" style="width:100%;max-width:1200px;">
            <table class="weg-tabel">
                <thead>
                    <tr>
                        <th>Naam</th>
                        <th>Locatie</th>
                        <th>Duur</th>
                        <th><input type="number" name="t1" value="<?= $ws[0]?->getTemperatuur() ?? 0 ?>"
                                onblur="this.form.submit()" style="width:50px;text-align:center;"> °C</th>
                        <th><input type="number" name="t2" value="<?= $ws[1]?->getTemperatuur() ?? -5 ?>"
                                onblur="this.form.submit()" style="width:50px;text-align:center;"> °C</th>
                        <th><input type="number" name="t3" value="<?= $ws[2]?->getTemperatuur() ?? -10 ?>"
                                onblur="this.form.submit()" style="width:50px;text-align:center;"> °C</th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" name="naam" value="<?= $this->e($weg->getNaam()) ?>"
                                onblur="this.form.submit()">
                        </td>
                        <td><input type="text" name="locatie" value="<?= $this->e($weg->getLocatie()) ?>"
                                onblur="this.form.submit()"></td>
                        <td><input type="text" name="strooiduur" value="<?= $weg->getStrooiduur() ?> min"
                                onblur="this.form.submit()"></td>
                        <td><input type="number" name="weglengte" value="<?= $weg->getWeglengte() ?>"
                                onblur="this.form.submit()"></td>
                        <td class="temp-nu">
                            <?= $weg->getHuidigeTemperatuur() !== null ? number_format($weg->getHuidigeTemperatuur(), 1) : '--' ?>°C
                        </td>

                        <td><input type="number" name="f1" value="<?= $ws[0]?->getFrequentie() ?? 0 ?>"
                                onblur="this.form.submit()" style="text-align:center;"></td>
                        <td><input type="number" name="f2" value="<?= $ws[1]?->getFrequentie() ?? 0 ?>"
                                onblur="this.form.submit()" style="text-align:center;"></td>
                        <td><input type="number" name="f3" value="<?= $ws[2]?->getFrequentie() ?? 0 ?>"
                                onblur="this.form.submit()" style="text-align:center;"></td>
                        <td style="display:flex;justify-content:center;gap:10px;">
                            <button type="submit" form="del-<?= $weg->getId() ?>" class="btn-icon">🗑️</button>
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