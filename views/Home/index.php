<?php
$this->layout("layout", ["title" => "Strooiwagenmanagment"]);


$url = "https://weerlive.nl/api/weerlive_api_v2.php?key=3184bf7422&locatie=Sneek";
$response = file_get_contents($url);
$data = json_decode($response, true);
$weer = $data['liveweer'][0];


$alarmTekst = $weer['wrsch_gc'];
$alarmKleur = 'blauw';

if (stripos($alarmTekst, 'geel') !== false) {
    $alarmKleur = 'geel';
} elseif (stripos($alarmTekst, 'oranje') !== false) {
    $alarmKleur = 'oranje';
} elseif (stripos($alarmTekst, 'rood') !== false) {
    $alarmKleur = 'rood';
} elseif ($alarmTekst == "0" || empty($alarmTekst)) {
    $alarmKleur = 'blauw';
    $alarmTekst = "Geen";
}
?>

<nav class="navbar-container">
    <div class="logo-section">
        <img src="logo_sudwest_fryslan.png" alt="Gemeente Súdwest-Fryslân">
    </div>

    <div class="nav-links">
        <a href="">Home</a>
        <a href="wegen">Wegen beheer</a>
    </div>
</nav>

<h1 class="hoofd-titel">Aantal Strooiwagens</h1>
<h2 class="cijfer"> 1 </h2>

<div class="weer-container">
    <div class="weer-blok blauw">
        <div class="label">Temperatuur</div>
        <div class="waarde">
            <?php echo $weer['temp']; ?>°C
        </div>
    </div>

    <div class="weer-blok blauw">
        <div class="label">Zicht</div>
        <div class="waarde">
            <?php echo $weer['zicht']; ?> meter
        </div>
    </div>

    <div class="weer-blok <?php echo $alarmKleur; ?>">
        <div class="label">Waarschuwing</div>
        <div class="waarde">
            <?php echo $alarmTekst; ?>
        </div>
    </div>

    <div class="weer-blok blauw">
        <div class="label">Soort Weer</div>
        <div class="waarde">
            <?php echo $weer['samenv']; ?>

        </div>
    </div>


</div>


<h2 class="datum"><?= date('d-m-Y') ?></h2>

<hr style="border: 0; border-top: 4px solid #737372; width: 100%; margin: 20px 0;">



<div class="analyse-sectie">
    <h2>Analyse</h2>
    <h3><?php echo $weer['lkop']; ?></h3>
    <p><?php echo $weer['ltekst']; ?></p>
</div>