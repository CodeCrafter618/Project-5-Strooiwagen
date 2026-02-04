<?php $this->layout("layout", ["title" => "Weg Bewerken"]) ?>

<h1>Weg Bewerken</h1>

<?php if (isset($error)): ?>
    <div style="color: red; margin: 10px 0;">
        <?= $this->e($error) ?>
    </div>
<?php endif; ?>

<form method="post" style="max-width: 500px;">
    <div style="margin-bottom: 15px;">
        <label for="naam" style="display: block; margin-bottom: 5px;">Naam *</label>
        <input type="text" id="naam" name="naam" required style="width: 100%; padding: 8px;"
            value="<?= $this->e($weg->getNaam()) ?>">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="locatie" style="display: block; margin-bottom: 5px;">Locatie *</label>
        <input type="text" id="locatie" name="locatie" required style="width: 100%; padding: 8px;"
            value="<?= $this->e($weg->getLocatie()) ?>">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="duur" style="display: block; margin-bottom: 5px;">Stroomduur (minuten) *</label>
        <input type="number" id="duur" name="duur" required min="1" style="width: 100%; padding: 8px;"
            value="<?= $weg->getDuur() ?>">
    </div>

    <h3>Temperatuur Instellingen</h3>

    <div style="margin-bottom: 15px;">
        <label for="temp_min0" style="display: block; margin-bottom: 5px;">Bij -0°C</label>
        <input type="number" id="temp_min0" name="temp_min0" min="0" style="width: 100%; padding: 8px;"
            value="<?= $weg->getTempMin0() ?>">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="temp_min5" style="display: block; margin-bottom: 5px;">Bij -5°C</label>
        <input type="number" id="temp_min5" name="temp_min5" min="0" style="width: 100%; padding: 8px;"
            value="<?= $weg->getTempMin5() ?>">
    </div>

    <div style="margin-bottom: 20px;">
        <label for="temp_min10" style="display: block; margin-bottom: 5px;">Bij -10°C</label>
        <input type="number" id="temp_min10" name="temp_min10" min="0" style="width: 100%; padding: 8px;"
            value="<?= $weg->getTempMin10() ?>">
    </div>

    <button type="submit"
        style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; cursor: pointer;">
        Wijzigingen Opslaan
    </button>

    <a href="/wegen"
        style="margin-left: 10px; padding: 10px 20px; background-color: #ccc; color: black; text-decoration: none;">
        Annuleren
    </a>
</form>