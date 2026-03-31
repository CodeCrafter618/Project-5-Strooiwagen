<?php
$this->layout("layout", ["title" => "Strooiwagenmanagment"]);


$apiKey = $_ENV['WEERLIVE_API_KEY'];
$locatie = $_ENV['WEERLIVE_LOCATIE'];


$url = "https://weerlive.nl/api/weerlive_api_v2.php?key=" . $apiKey . "&locatie=" . urlencode($locatie);


$response = @file_get_contents($url);
$data = json_decode($response, true);


$temp = $data['liveweer'][0]['temp'] ?? 'Onbekend';



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



<h1 class="hoofd-titel">Aantal Strooiwagens</h1>
<h2 class="cijfer"> <?php echo $aantalWagens; ?> </h2>

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


<h2 class="datum" id="live-klok">
    <?= date('d-m-Y H:i:s') ?>
</h2>

<script>
    function updateTijd() {
        const nu = new Date();

        const datum = nu.getDate().toString().padStart(2, '0') + '-' +
            (nu.getMonth() + 1).toString().padStart(2, '0') + '-' +
            nu.getFullYear();

        const tijd = nu.getHours().toString().padStart(2, '0') + ':' +
            nu.getMinutes().toString().padStart(2, '0') + ':' +
            nu.getSeconds().toString().padStart(2, '0');

        document.getElementById('live-klok').innerHTML = datum + ' ' + tijd;
    }

    setInterval(updateTijd, 1000);
</script>

<hr class="section-divider">



<div class="analyse-sectie">
    <h2>Analyse</h2>
    <h3>
        <?php echo $weer['verw']; ?>
    </h3>
    <p>
        <?php echo $weer['ltekst']; ?>
    </p>
</div>