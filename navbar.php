<?php

?>
<style>
    body {
        margin: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .navbar-container {
        background-color: #FFD966;

        display: flex;
        align-items: center;
        padding: 10px 40px;
        height: 80px;
        box-sizing: border-box;
    }

    .logo-section {
        display: flex;
        align-items: center;
        flex: 1;
    }

    .logo-section img {
        height: 50px;

        margin-right: 15px;
    }

    .nav-links {
        display: flex;
        gap: 50px;
        margin-right: 100px;

    }

    .nav-links a {
        text-decoration: none;
        color: #000;
        font-size: 32px;

        font-weight: 400;
    }

    .nav-links a:hover {
        opacity: 0.7;
    }
</style>

<nav class="navbar-container">
    <div class="logo-section">
        <img src="logo_sudwest_fryslan.png" alt="Gemeente Súdwest-Fryslân">
    </div>

    <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="wegenbeheer.php">Wegen beheer</a>
    </div>
</nav>