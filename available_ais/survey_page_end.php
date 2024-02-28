<?php
/*
 * ================
 * Error reporting.
 * ================
 */
error_reporting(E_ALL);
ini_set('display_errors', 0); // SET IT TO 0 ON A LIVE SERVER !!!

/*
 * ==================================================================
 * Execute operations upon form submit (store form data in date.csv).
 * ==================================================================
 */
include 'save_data.php';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assessing Automated Vehicle Capabilities</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <style>
        section{
            padding: 60px 0;
        }
    </style>
</head>
<body>

<section id="topics">
    <div class="container-md bg-light my-3 py-3">
        <div class="text-center">
            <h1 class="display-2 mb-5">End of the survey</h1>
        </div>

        <div class="row g-4 justify-content-center align-items-center">
            <div class="col-md-5 text-center text-md-start pb-3">
                <p class="text-center">
                    Thank you for participating in this online survey!
                    If you want to see how your own video looks in the eyes of an AI you can do that!
                </p>
                <p class="text-center">
                    In one week we will launch a second survey, where you can upload your own videos and see how an AI sees them.
                    Click on the "Register for follow-up survey" button.
                </p>
                <p class="text-center">
                    If not just close this tab, you can return to Prolific by clicking the "Go back to Prolific" button.
                </p>
            </div>
        </div>
        <div class="text-center my-3">
            <a class="btn btn-primary btn-lg" href="https://app.prolific.co/submissions/complete?cc=17105C89" role="button">Go back to Prolific</a>
        </div>
        <div class="text-center my-3">
            <a class="btn btn-primary btn-lg" href="https://app.prolific.co/submissions/complete?cc=CZ1LLYEV" role="button">Register for follow-up survey</a>
        </div>
        <div class="progress" style="height: 20px;">
            <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%</div>
        </div>
    </div>
</section>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script>
    const tooltips = document.querySelectorAll('.tt')
    tooltips.forEach(t => {
        new bootstrap.Tooltip(t)
    })
</script>
</body>
</html>