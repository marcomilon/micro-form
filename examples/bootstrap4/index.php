<?php

require __DIR__ . '/vendor/autoload.php';

use micro\JsonDs;
use micro\Form;

$jsonString = <<<EOS
        [
            {
                "tag": "input",
                "id": "username",
                "for": "username",
                "label": "Email *",
                "type": "text",
                "name": "username",
                "class": "form-control",
                "tip": "Please enter your email",
                "required": "required"
            },
            {
                "tag": "input",
                "id": "password",
                "for": "password",
                "label": "Password *",
                "type": "password",
                "name": "password",
                "class": "form-control",
                "required": "required"
            },
            {
                "tag": "input",
                "id": "confirm-password",
                "for": "confirm-password",
                "label": "Confirm password",
                "type": "password",
                "name": "confirm-password",
                "class": "form-control"
            },
            {
                "tag": "input",
                "id": "name",
                "for": "name",
                "label": "Name",
                "type": "text",
                "name": "name",
                "class": "form-control",
                "required": "required"
            },
            {
                "tag": "textarea",
                "id": "address",
                "for": "address",
                "label": "Address",
                "rows": "5",
                "cols": "33",
                "value": "",
                "placeholder": "Your Address",
                "class": "form-control",
                "required": "required"
            },
            {
                "tag": "select",
                "name": "plan",
                "for": "plan-select",
                "id": "plan-select",
                "class": "form-control",
                "label": "Choose your plan",
                "value": [
                    {
                        "tag": "option",
                        "label": "--Please choose an option--",
                        "value": ""
                    },
                    {
                        "tag": "option",
                        "label": "Free",
                        "value": "free"
                    },
                    {
                        "tag": "option",
                        "label": "$99 a year",
                        "value": "99"
                    }
                ]
            },
            {
                "tag": "button",
                "type": "submit",
                "value": "Submit now",
                "class": "btn btn-primary btn-block"
            }
        ]
EOS;

$jsonDs = new JsonDs();
$jsonForm = new Form($jsonDs);

?><!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>Sign in</title>
</head>

<body>

    <div class="container mt-5 w-25">

        <h1>Sign in</h1>

        <form>
            <?= $jsonForm->render($jsonString) ?>
        </form>

    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    -->
</body>

</html>