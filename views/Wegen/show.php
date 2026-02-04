<?php $this->layout("layout", ["title" => "Weg details"]) ?>
<h1>Weg: <?= $this->e($weg->getNaam()) ?></h1>
<p>Locatie: <?= $this->e($weg->getLocatie()) ?></p>
<p>Duur: <?= $weg->getDuur() ?> minuten</p>
<a href="/wegen">Terug naar overzicht</a>