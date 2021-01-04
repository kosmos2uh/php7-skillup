<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Project</title>
    <link href="/static/css/bootstrap.min.css" rel="stylesheet">
    <link href="/static/css/styles.css" rel="stylesheet">
    <script src="/static/js/jquery-3.5.1.min.js"></script>
    <script src="/static/js/bootstrap.min.js"></script>
    <script src="/static/js/script.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="https://fakeimg.pl/120x50/ff0000%2C128/000%2C255/?text=LOGO" alt="Logo" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <?php include "include/template/menu.php" ?>
        </div>
    </div>
</nav>

<div class="container">