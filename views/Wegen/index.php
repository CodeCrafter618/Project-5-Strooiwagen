<?php $this->layout("layout", ["title" => "Wegenbeheer", "bodyClass" => "page-wegen-index"]) ?>

<?php if (isset($_GET['error']) && $_GET['error'] === 'exists'): ?>
    <p class="form-error">Deze weg bestaat al.</p>
<?php endif; ?>

<?php foreach ($wegen as $weg):
    $ws = $weg->getWeersomstandigheden()->toArray();
    usort($ws, fn($a, $b) => $b->getTemperatuur() <=> $a->getTemperatuur());
    ?>
    <div class="weg-tabel-wrapper">
        <form action="/wegen/edit/<?= $weg->getId() ?>" method="POST" class="weg-form">
            <table class="weg-tabel">
                <thead>
                    <tr>
                        <th class="weg-col-naam">Naam</th>
                        <th class="weg-col-locatie">Locatie</th>
                        <th class="weg-col-duur">Duur (min)</th>
                        <th class="weg-col-weglengte">Weglengte</th>
                        <th class="weg-col-nu">Nu</th>

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

                        <th class="weg-col-acties">Acties</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" name="naam" value="<?= $this->e($weg->getNaam()) ?>"
                                onblur="this.form.submit()"></td>
                        <td><input type="text" name="locatie" value="<?= $this->e($weg->getLocatie()) ?>" pattern="[^0-9]*"
                                title="Geen cijfers toegestaan" onblur="this.form.submit()"></td>
                        <td><input type="number" name="strooiduur" value="<?= $weg->getStrooiduur() ?>" min="0" step="1"
                                onblur="this.form.submit()"></td>
                        <td><input type="number" name="weglengte" value="<?= $weg->getWeglengte() ?>" min="0" step="1"
                                onblur=" this.form.submit()"></td>
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