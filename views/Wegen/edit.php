<?php $this->layout("layout", ["title" => "Weg Bewerken"]) ?>

<h1>Weg Bewerken</h1>

<?php if (isset($error)): ?>
    <div class="form-error">
        <?= $this->e($error) ?>
    </div>
<?php endif; ?>

<form method="post" class="weg-edit-form">
    <div class="form-row">
        <label for="naam" class="form-label">Naam *</label>
        <input type="text" id="naam" name="naam" required class="form-input" value="<?= $this->e($weg->getNaam()) ?>">
    </div>

    <div class="form-row">
        <label for="locatie" class="form-label">Locatie *</label>
        <input type="text" id="locatie" name="locatie" required class="form-input"
            value="<?= $this->e($weg->getLocatie()) ?>">
    </div>

    <div class="form-row">
        <label for="duur" class="form-label">Stroomduur (minuten) *</label>
        <input type="number" id="duur" name="duur" required min="1" class="form-input" value="<?= $weg->getDuur() ?>">
    </div>

    <h3>Temperatuur Instellingen</h3>

    <div class="form-row">
        <label for="temp_min0" class="form-label">Bij -0°C</label>
        <input type="number" id="temp_min0" name="temp_min0" min="0" class="form-input"
            value="<?= $weg->getTempMin0() ?>">
    </div>

    <div class="form-row">
        <label for="temp_min5" class="form-label">Bij -5°C</label>
        <input type="number" id="temp_min5" name="temp_min5" min="0" class="form-input"
            value="<?= $weg->getTempMin5() ?>">
    </div>

    <div class="form-row form-row--spaced">
        <label for="temp_min10" class="form-label">Bij -10°C</label>
        <input type="number" id="temp_min10" name="temp_min10" min="0" class="form-input"
            value="<?= $weg->getTempMin10() ?>">
    </div>

    <button type="submit" class="btn-primary">Wijzigingen Opslaan</button>

    <a href="/wegen" class="btn-secondary">Annuleren</a>
</form>