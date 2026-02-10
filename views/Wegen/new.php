<?php $this->layout("layout", ["title" => "Nieuwe Weg", "bodyClass" => "page-wegen-new"]) ?>



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

        <hr class="form-divider">
        <p><strong>Drempels (Temperatuur & Frequentie):</strong></p>

        <div class="temp-freq-grid temp-freq-grid--header">
            <span>Temperatuur (°C)</span>
            <span>Frequentie</span>
        </div>

        <?php for ($i = 1; $i <= 3; $i++): ?>
            <div class="temp-freq-grid">
                <input type="number" name="t<?= $i ?>" value="<?= ($i - 1) * -5 ?>" title="Drempel Temperatuur">
                <input type="number" name="f<?= $i ?>" placeholder="Aantal wagens" required>
            </div>
        <?php endfor; ?>

        <a href="/wegen"
            onclick="return confirm('Weet je zeker dat je terug wilt gaan? Niet opgeslagen wijzigingen gaan verloren.');">
            <button type="button" class="knop-opslaan">Terug naar wegenbeheer</button>
        </a>
        <button type="submit" class="knop-opslaan">Opslaan</button>
    </form>
</div>