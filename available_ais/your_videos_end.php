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


$prolificID = isset($_COOKIE['prolific_id']) ? $_COOKIE['prolific_id'] : '';


$video = "uploads/" . $prolificID . "/" . $prolificID . ".mp4";
$video1 = "uploads/" . $prolificID . "/" . $prolificID . "_720p_25_fps.mp4";
$video2 = "uploads/" . $prolificID . "/" . $prolificID . "_720p_25_fps_result_pi_ps_converted.mp4";
$done = "uploads/" . $prolificID . "/" . $prolificID . "_done.txt";

$filepath1 = realpath(__DIR__) . "/results/submissions_part2.csv";
$entryFoundCounter = 0;
$feedbackFound = false;
if(file_exists($filepath1)){
    $fp1 = fopen($filepath1, 'r') or die("Unable to open file!");
    while(false !== ($csv1 = fgetcsv($fp1))) {
        if($csv1[0] == $prolificID){
            $entryFoundCounter++;
            if($csv1[44] != ''){
                $feedbackFound = true;
            }
        }
    }
}

if(file_exists($video) && file_exists($video1) && file_exists($video2) && file_exists($done)){ //} file_exists($video3) && file_exists($video4) && file_exists($video5) && file_exists($video6)){
    if($entryFoundCounter == 1){
        header("Location: /your_videos_three.php");
        exit();
    } elseif($entryFoundCounter == 2 && !$feedbackFound){
        header("Location: /your_videos_four.php");
        exit();
    } elseif($entryFoundCounter == 0){
        header("Location: /your_videos_two.php");
        exit();
    }
}
if(!file_exists($video)){
    header("Location: /your_videos_one.php");
    exit();
}
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
                </p>
                <p class="text-center">
                    Please inform the person who sent you this link that you have finished.
                </p>
            </div>
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