<?php $this->layout("layout", ["title" => "Wegenbeheer"]) ?>
<link rel="stylesheet" href="/css/style.css">

<div class="header-yellow">
    <div style="position: absolute; left: 20px; top: 15px;">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/29/Logo_S%C3%BAdwest-Frysl%C3%A2n.svg/1200px-Logo_S%C3%BAdwest-Frysl%C3%A2n.svg.png"
            height="50">
    </div>
    <h1 style="margin:0;">Wegenbeheer</h1>
</div>

<div style="margin-top: 40px;">
    <?php foreach ($wegen as $weg):
        $ws = $weg->getWeersomstandigheden()->toArray(); ?>
        <div class="weg-container">
            <form action="/wegen/edit/<?= $weg->getId() ?>" method="POST">
                <table class="weg-table">
                    <thead>
                        <tr>
                            <th>Naam</th>
                            <th>Locatie</th>
                            <th>Duur</th>
                            <th><input type="number" name="t1" class="h-in" value="<?= $ws[0]?->getTemperatuur() ?? 0 ?>"
                                    onblur="this.form.submit()">°C</th>
                            <th><input type="number" name="t2" class="h-in" value="<?= $ws[1]?->getTemperatuur() ?? -5 ?>"
                                    onblur="this.form.submit()">°C</th>
                            <th><input type="number" name="t3" class="h-in" value="<?= $ws[2]?->getTemperatuur() ?? -10 ?>"
                                    onblur="this.form.submit()">°C</th>
                            <th>Actie</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" name="naam" value="<?= $this->e($weg->getNaam()) ?>"
                                    onblur="this.form.submit()"></td>
                            <td><input type="text" name="locatie" value="<?= $this->e($weg->getLocatie()) ?>"
                                    onblur="this.form.submit()"></td>
                            <td><input type="number" name="strooiduur" value="<?= $weg->getStrooiduur() ?>"
                                    onblur="this.form.submit()"></td>
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
            <form id="del-<?= $weg->getId() ?>" action="/wegen/delete/<?= $weg->getId() ?>" method="POST"
                onsubmit="return confirm('Weg verwijderen?')"></form>
        </div>
    <?php endforeach; ?>
</div>

<a href="/wegen/new" class="plus-btn">+</a>