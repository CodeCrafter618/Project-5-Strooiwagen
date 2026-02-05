<?php $this->layout("layout", ["title" => "Wegenbeheer"]) ?>

<div class="container">
    <?php foreach ($wegen as $weg):
        $ws = $weg->getWeersomstandigheden()->toArray();
        usort($ws, fn($a, $b) => $b->getTemperatuur() <=> $a->getTemperatuur());
        ?>
        <form action="/wegen/edit/<?= $weg->getId() ?>" method="POST"
            style="width: 100%; display: flex; justify-content: center;">
            <table class="weg-table">
                <thead>
                    <tr>
                        <th class="col-naam">Naam</th>
                        <th class="col-locatie">Locatie</th>
                        <th>KM</th>
                        <th>Duur</th>
                        <th class="temp-nu">Temp Nu</th>
                        <th>
                            <?= isset($ws[0]) ? $ws[0]->getTemperatuur() : 0 ?>°C
                        </th>
                        <th>
                            <?= isset($ws[1]) ? $ws[1]->getTemperatuur() : -5 ?>°C
                        </th>
                        <th>
                            <?= isset($ws[2]) ? $ws[2]->getTemperatuur() : -10 ?>°C
                        </th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" name="naam" value="<?= $this->e($weg->getNaam()) ?>"
                                onblur="this.form.submit()"></td>
                        <td><input type="text" name="locatie" value="<?= $this->e($weg->getLocatie()) ?>"
                                onblur="this.form.submit()"></td>
                        <td><input type="number" name="weglengte" value="<?= $weg->getWeglengte() ?>"
                                onblur="this.form.submit()"></td>
                        <td><input type="text" name="strooiduur" value="<?= $weg->getStrooiduur() ?> min"
                                onblur="this.form.submit()"></td>
                        <td class="temp-nu">
                            <?= $weg->getHuidigeTemperatuur() !== null ? number_format($weg->getHuidigeTemperatuur(), 1) : '--' ?>°C
                        </td>
                        <td><input type="number" name="f1" value="<?= $ws[0]?->getFrequentie() ?? 0 ?>"
                                onblur="this.form.submit()"></td>
                        <td><input type="number" name="f2" value="<?= $ws[1]?->getFrequentie() ?? 0 ?>"
                                onblur="this.form.submit()"></td>
                        <td><input type="number" name="f3" value="<?= $ws[2]?->getFrequentie() ?? 0 ?>"
                                onblur="this.form.submit()"></td>
                        <td style="display: flex; justify-content: center; gap: 10px; border: none;">
                            <button type="submit" form="del-<?= $weg->getId() ?>" class="btn-icon">🗑️</button>
                            <span style="font-size: 20px; cursor: pointer;">✏️</span>
                        </td>
                    </tr>
                </tbody>
            </table>

            <input type="hidden" name="t1" value="<?= $ws[0]?->getTemperatuur() ?? 0 ?>">
            <input type="hidden" name="t2" value="<?= $ws[1]?->getTemperatuur() ?? -5 ?>">
            <input type="hidden" name="t3" value="<?= $ws[2]?->getTemperatuur() ?? -10 ?>">
        </form>

        <form id="del-<?= $weg->getId() ?>" action="/wegen/delete/<?= $weg->getId() ?>" method="POST"
            onsubmit="return confirm('Weg verwijderen?')"></form>
    <?php endforeach; ?>
</div>

<a href="/wegen/new" class="plus-btn">+</a>