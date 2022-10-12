<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>
<style>
    .container {
        display: grid;
        place-items: center;
    }

    .section {
        display: none;
    }

    .section.active {
        display: block;
    }


    .nav button {
        background: #ccc;
        padding: 10px 15px;
        margin-left: 6px;
        border-radius: 50%;
        cursor: pointer;
        opacity: .5;
        border: none;
        height: 80px;
    }

    .next,
    .previous {
        padding: 15px 10px;
        border-radius: 6px;
        background: deepskyblue;
        color: white;
        border: 0;
        outline: none;
        cursor: pointer;
        width: 100px;
        visibility: hidden;
    }

    .button-active {
        opacity: 1 !important;
        visibility: visible;
    }

    body {
        font-size: 120%;
    }
</style>
<script>
    const sectionContent = ["r1", "r2", "r3", "r4", "r5", "r6", "r7", "r8"];
    let currentSection = sectionContent[0];

    const displayContent = (q, area) => {
        document.getElementById(q).classList.add("active");
        document.getElementById(q + "-button").classList.add("button-active");
        currentSection = sectionContent[area.indexOf(q)];
        const toNone = area.filter(e => e !== q);
        for (i in toNone) {
            document.getElementById(toNone[i]).classList.remove("active");
            document.getElementById(toNone[i] + "-button").classList.remove("button-active");
        }
        if (sectionContent.indexOf(q) == 0) {
            document.getElementById("previous").classList.remove("button-active");
            document.getElementById("next").classList.add("button-active");
        } else if (sectionContent.indexOf(q) == sectionContent.length - 1) {
            document.getElementById("previous").classList.add("button-active");
            document.getElementById("next").classList.remove("button-active");
        } else {
            document.getElementById("previous").classList.add("button-active");
            document.getElementById("next").classList.add("button-active");
        }
    }

    const displayR1 = () => displayContent("r1", sectionContent);
    const displayR2 = () => displayContent("r2", sectionContent);
    const displayR3 = () => displayContent("r3", sectionContent);
    const displayR4 = () => displayContent("r4", sectionContent);
    const displayR5 = () => displayContent("r5", sectionContent);
    const displayR6 = () => displayContent("r6", sectionContent);
    const displayR7 = () => displayContent("r7", sectionContent);
    const displayR8 = () => displayContent("r8", sectionContent);
    const displayNext = () => displayContent(sectionContent[sectionContent.indexOf(currentSection) + 1], sectionContent);
    const displayPrevious = () => displayContent(sectionContent[sectionContent.indexOf(currentSection) - 1], sectionContent);
</script>
<header class="header">
    <?php include('header.php') ?>
</header>
<br><br><br><br><br><br><br><br><br><br><br><br>

<body>
    
</body>

</html>