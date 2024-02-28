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
$filepath = realpath(__DIR__) . "/results/demographic_part2.csv";
$prolificID = $_COOKIE['prolific_id'];
$counter = 0;
if(file_exists($filepath)){
    $fp = fopen($filepath, 'r') or die("Unable to open file!");
    while(false !== ($csv = fgetcsv($fp))) {
        $counter++;
        if($csv[0] == $prolificID){
            $counter++;
            break;
        }
    }
}
$video = "uploads/" . $prolificID . "/" . $prolificID . ".mp4";
$video1 = "uploads/" . $prolificID . "/" . $prolificID . "_720p_25_fps.mp4";
$video2 = "uploads/" . $prolificID . "/" . $prolificID . "_720p_25_fps_result_pi_ps_converted.mp4";
$done = "uploads/" . $prolificID . "/" . $prolificID . "_done.txt";
//$video2 = "uploads/" . $prolificID . "/" . $prolificID . "_result_ps.mp4";
//$video3 = "uploads/" . $prolificID . "/" . $prolificID . "_result_ps_converted.mp4";
//$video4 = "uploads/" . $prolificID . "/" . $prolificID . "_result_pi.mp4";
//$video5 = "uploads/" . $prolificID . "/" . $prolificID . "_result_pi_ps.mp4";

$filepath1 = realpath(__DIR__) . "/results/submissions_part2.csv";
$entryFoundCounter = 0;
if(file_exists($filepath1)){
    $fp1 = fopen($filepath1, 'r') or die("Unable to open file!");
    while(false !== ($csv1 = fgetcsv($fp1))) {
        if($csv1[0] == $prolificID){
            $entryFoundCounter++;
        }
    }
}

if(file_exists($video) && file_exists($video1) && file_exists($video2) && file_exists($done)){ //} file_exists($video3) && file_exists($video4) && file_exists($video5) && file_exists($video6)){
    if($entryFoundCounter == 2){
        header("Location: /your_videos_four.php");
        exit();
    } elseif($entryFoundCounter == 0){
        header("Location: /your_videos_two.php");
        exit();
    }
}

if(file_exists($video)){
    if(!(file_exists($video1) && file_exists($video2) && file_exists($done))){//&& file_exists($video3) && file_exists($video4) && file_exists($video5) && file_exists($video6))){
        //if($timeNow < $timeToContinue){
            header("Location: /too_early.php");
            exit();
        //} 
    }
} else {
    header("Location: /your_videos_one.php");
    exit();
}

$counterMod2 = $counter % 2;
$videoPath = "uploads/" . $prolificID . "/" . $prolificID . "_720p_25_fps_result_pi_ps_converted.mp4";
$videoDescription = "";
    if($counterMod2 == 1){
        $videoPath = $videoPath = "uploads/" . $prolificID . "/" . $prolificID . "_720p_25_fps_result_pi_ps_converted.mp4";
        $videoDescription = "While driving, a <b>symbol</b> is displayed <b>above detected persons</b>. Symbols above people whose intention has been safely detected are displayed in <b>two colors</b>: They are displayed in <b>light blue</b> if the intention is to <b>stay on the sidewalk</b>, in <b>dark blue</b> if the <b>intention is to cross the street</b>. Symbols over people whose intention was <b>not recognized with certainty</b> are displayed in <b>yellow</b>.
    Also, <b>vehicles, pedestrians and traffic signs are marked in color</b>. The marking is realized by coloring the respective object. The following color assignment applies: <br><b>pedestrians and cyclists</b> are marked in <b>red</b>, <br><b>vehicles</b> are marked in <b>blue</b> <br>and <b>traffic signs and traffic lights</b> are marked in <b>yellow</b>.<br>";
} 
    if($counterMod2 == 0) {
        $videoPath = $videoPath = "uploads/" . $prolificID . "/" . $prolificID . "_720p_25_fps.mp4";
        $videoDescription = "In this scene, while driving, vehicles, pedestrians and traffic signs are not marked.";
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
        <div id="videoDIV">
            <div class="text-center">
                <h1 class="display-2 mb-5">Video 2</h1>
            </div>

            <div class="row g-4 justify-content-center align-items-center">
                <div class="col-md-10 text-center text-md-start pb-3">
                    <p>
                        In the following video, imagine that you see an autonomous car driving.
                    </p>
                    <p>
                        <?php echo $videoDescription; ?>
                    </p>
                </div>
            </div>

            <div class="row justify-content-center my-3" id="videoDiv">
                <div class="col text-center">
                    <div class="ratio ratio-16x9">
                        <video width="1280" height="720" controls preload="auto" id="video">
                            <source src="<?php echo $videoPath ?>" type="video/mp4">
    <!--                        <source src="/uploads/test.mp4" type="video/mp4">-->
                            
    <!--                        Befehl für Konvertierun damit mans im Browser sieht: ffmpeg -i ulm_video_720p_result_od_backup.mp4 -c:v libx264 -crf 12 -c:a copy out_3.mp4
                                                                                    crf ist die Qualität (23 ist standart, 18 considered "visually lossless")-->
    <!--                        <source src="/uploads/ulm_videos/ulm_video_720p_result_od_reconverted.mp4" type="video/mp4">-->

                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
            </div>

            <div class="row g-4 justify-content-center align-items-center">
                <div class="col-md-5 text-center text-md-start pb-3">
                    <p>
                        Please watch the video above, answer the questions after the video ends. Click on "Send" to submit your answers.
                    </p>
                </div>
            </div>
        </div>
        <!--
        <div class="text-center my-3">
            <a class="btn btn-primary btn-lg" href="survey_page_three.php" role="button">Next</a>
        </div>
        -->
        <form action="your_videos_four.php" method="post" class="row g-3 needs-validation" id="questionsForm" name="questionsForm" onsubmit="return validateForm()" novalidate style="display: none">

            <input type="hidden" name="current_page" value="page2" />
            <input type="hidden" name="study_part" value="2" />
            <input type="hidden" name="condition" value="<?php echo $counterMod2 ?>" />

            <div class="container text-start">
                <div class="text-center">
                    <h1 class="display">Instability of Situation</h1>
                </div>
                <div class="row justify-content-start">
                    <div class="col-1">
                    </div>
                    <div class="col-10">
                        <h4>
                            How changeable is the situation? Is the situation highly unstable and likely to change suddenly (High) or is it very stable and straightforward (Low)?
                        </h4>
                    </div>
                    <div class="col-1">
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <div class="form-check form-check-inline">
                            Low
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion1" id="inlineRadio1" value="1" required>
                            <label class="form-check-label" for="inlineRadio1">1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion1" id="inlineRadio2" value="2" required>
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion1" id="inlineRadio3" value="3" required>
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion1" id="inlineRadio4" value="4" required>
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion1" id="inlineRadio5" value="5" required>
                            <label class="form-check-label" for="inlineRadio5">5</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion1" id="inlineRadio6" value="6" required>
                            <label class="form-check-label" for="inlineRadio6">6</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion1" id="inlineRadio7" value="7" required>
                            <label class="form-check-label" for="inlineRadio7">7</label>
                        </div>
                        <div class="form-check form-check-inline">
                            High
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
            </div>

            <div class="container text-start">
                <div class="text-center">
                    <h1 class="display">Complexity of Situation</h1>
                </div>
                <div class="row justify-content-start">
                    <div class="col-1">
                    </div>
                    <div class="col-10">
                        <h4>
                            How complicated is the situation? Is it complex with many interrelated components (High) or is it simple and straightforward (Low)?
                        </h4>
                    </div>
                    <div class="col-1">
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <div class="form-check form-check-inline">
                            Low
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion2" id="inlineRadio1" value="1" required>
                            <label class="form-check-label" for="inlineRadio1">1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion2" id="inlineRadio2" value="2" required>
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion2" id="inlineRadio3" value="3" required>
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion2" id="inlineRadio4" value="4" required>
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion2" id="inlineRadio5" value="5" required>
                            <label class="form-check-label" for="inlineRadio5">5</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion2" id="inlineRadio6" value="6" required>
                            <label class="form-check-label" for="inlineRadio6">6</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion2" id="inlineRadio7" value="7" required>
                            <label class="form-check-label" for="inlineRadio7">7</label>
                        </div>
                        <div class="form-check form-check-inline">
                            High
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
            </div>

            <div class="container text-start">
                <div class="text-center">
                    <h1 class="display">Variability of Situation</h1>
                </div>
                <div class="row justify-content-start">
                    <div class="col-1">
                    </div>
                    <div class="col-10">
                        <h4>
                            How many variables are changing within the situation? Are there a large number of factors varying (High) or are there very few variables changing (Low)?
                        </h4>
                    </div>
                    <div class="col-1">
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <div class="form-check form-check-inline">
                            Low
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion3" id="inlineRadio1" value="1" required>
                            <label class="form-check-label" for="inlineRadio1">1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion3" id="inlineRadio2" value="2" required>
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion3" id="inlineRadio3" value="3" required>
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion3" id="inlineRadio4" value="4" required>
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion3" id="inlineRadio5" value="5" required>
                            <label class="form-check-label" for="inlineRadio5">5</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion3" id="inlineRadio6" value="6" required>
                            <label class="form-check-label" for="inlineRadio6">6</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion3" id="inlineRadio7" value="7" required>
                            <label class="form-check-label" for="inlineRadio7">7</label>
                        </div>
                        <div class="form-check form-check-inline">
                            High
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
            </div>

            <div class="container text-start">
                <div class="text-center">
                    <h1 class="display">Arousal</h1>
                </div>
                <div class="row justify-content-start">
                    <div class="col-1">
                    </div>
                    <div class="col-10">
                        <h4>
                            How aroused are you in the situation? Are you alert and ready for activity (High) or do you have a low degree of alertness (Low)?
                        </h4>
                    </div>
                    <div class="col-1">
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <div class="form-check form-check-inline">
                            Low
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion4" id="inlineRadio1" value="1" required>
                            <label class="form-check-label" for="inlineRadio1">1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion4" id="inlineRadio2" value="2" required>
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion4" id="inlineRadio3" value="3" required>
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion4" id="inlineRadio4" value="4" required>
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion4" id="inlineRadio5" value="5" required>
                            <label class="form-check-label" for="inlineRadio5">5</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion4" id="inlineRadio6" value="6" required>
                            <label class="form-check-label" for="inlineRadio6">6</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion4" id="inlineRadio7" value="7" required>
                            <label class="form-check-label" for="inlineRadio7">7</label>
                        </div>
                        <div class="form-check form-check-inline">
                            High
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
            </div>


            <div class="container text-start">
                <div class="text-center">
                    <h1 class="display">Concentration of Attention</h1>
                </div>
                <div class="row justify-content-start">
                    <div class="col-1">
                    </div>
                    <div class="col-10">
                        <h4>
                            How much are you concentrating on the situation? Are you concentrating on many aspects of the situation (High) or focussed on only one (Low)?
                        </h4>
                    </div>
                    <div class="col-1">
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <div class="form-check form-check-inline">
                            Low
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion5" id="inlineRadio1" value="1" required>
                            <label class="form-check-label" for="inlineRadio1">1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion5" id="inlineRadio2" value="2" required>
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion5" id="inlineRadio3" value="3" required>
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion5" id="inlineRadio4" value="4" required>
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion5" id="inlineRadio5" value="5" required>
                            <label class="form-check-label" for="inlineRadio5">5</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion5" id="inlineRadio6" value="6" required>
                            <label class="form-check-label" for="inlineRadio6">6</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion5" id="inlineRadio7" value="7" required>
                            <label class="form-check-label" for="inlineRadio7">7</label>
                        </div>
                        <div class="form-check form-check-inline">
                            High
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
            </div>

            <div class="container text-start">
                <div class="text-center">
                    <h1 class="display">Division of Attention</h1>
                </div>
                <div class="row justify-content-start">
                    <div class="col-1">
                    </div>
                    <div class="col-10">
                        <h4>
                            How much is your attention divided in the situation? Are you concentrating on many aspects of the situation (High) or focussed on only one (Low)?
                        </h4>
                    </div>
                    <div class="col-1">
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <div class="form-check form-check-inline">
                            Low
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion6" id="inlineRadio1" value="1" required>
                            <label class="form-check-label" for="inlineRadio1">1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion6" id="inlineRadio2" value="2" required>
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion6" id="inlineRadio3" value="3" required>
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion6" id="inlineRadio4" value="4" required>
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion6" id="inlineRadio5" value="5" required>
                            <label class="form-check-label" for="inlineRadio5">5</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion6" id="inlineRadio6" value="6" required>
                            <label class="form-check-label" for="inlineRadio6">6</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion6" id="inlineRadio7" value="7" required>
                            <label class="form-check-label" for="inlineRadio7">7</label>
                        </div>
                        <div class="form-check form-check-inline">
                            High
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
            </div>

            <div class="container text-start">
                <div class="text-center">
                    <h1 class="display">Spare Mental Capacity</h1>
                </div>
                <div class="row justify-content-start">
                    <div class="col-1">
                    </div>
                    <div class="col-10">
                        <h4>
                            How much mental capacity do you have to spare in the situation? Do you have sufficient to attend to many variables (High) or nothing to spare at all (Low)?
                        </h4>
                    </div>
                    <div class="col-1">
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <div class="form-check form-check-inline">
                            Low
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion7" id="inlineRadio1" value="1" required>
                            <label class="form-check-label" for="inlineRadio1">1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion7" id="inlineRadio2" value="2" required>
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion7" id="inlineRadio3" value="3" required>
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion7" id="inlineRadio4" value="4" required>
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion7" id="inlineRadio5" value="5" required>
                            <label class="form-check-label" for="inlineRadio5">5</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion7" id="inlineRadio6" value="6" required>
                            <label class="form-check-label" for="inlineRadio6">6</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion7" id="inlineRadio7" value="7" required>
                            <label class="form-check-label" for="inlineRadio7">7</label>
                        </div>
                        <div class="form-check form-check-inline">
                            High
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
            </div>

            <div class="container text-start">
                <div class="text-center">
                    <h1 class="display">Information Quantity</h1>
                </div>
                <div class="row justify-content-start">
                    <div class="col-1">
                    </div>
                    <div class="col-10">
                        <h4>
                            How much information have you gained about the situation? Have you received and understood a great deal of knowledge (High) or very little (Low)?
                        </h4>
                    </div>
                    <div class="col-1">
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <div class="form-check form-check-inline">
                            Low
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion8" id="inlineRadio1" value="1" required>
                            <label class="form-check-label" for="inlineRadio1">1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion8" id="inlineRadio2" value="2" required>
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion8" id="inlineRadio3" value="3" required>
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion8" id="inlineRadio4" value="4" required>
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion8" id="inlineRadio5" value="5" required>
                            <label class="form-check-label" for="inlineRadio5">5</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion8" id="inlineRadio6" value="6" required>
                            <label class="form-check-label" for="inlineRadio6">6</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion8" id="inlineRadio7" value="7" required>
                            <label class="form-check-label" for="inlineRadio7">7</label>
                        </div>
                        <div class="form-check form-check-inline">
                            High
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
            </div>

            <div class="container text-start">
                <div class="text-center">
                    <h1 class="display">Information Quality</h1>
                </div>
                <div class="row justify-content-start">
                    <div class="col-1">
                    </div>
                    <div class="col-10">
                        <h4>
                        How good/accurate/of value was the information provided? Was it accessible, usable, and accurate (High) or difficult to obtain and inaccurate (Low)?
                        </h4>
                    </div>
                    <div class="col-1">
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <div class="form-check form-check-inline">
                            Low
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion9" id="inlineRadio1" value="1" required>
                            <label class="form-check-label" for="inlineRadio1">1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion9" id="inlineRadio2" value="2" required>
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion9" id="inlineRadio3" value="3" required>
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion9" id="inlineRadio4" value="4" required>
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion9" id="inlineRadio5" value="5" required>
                            <label class="form-check-label" for="inlineRadio5">5</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion9" id="inlineRadio6" value="6" required>
                            <label class="form-check-label" for="inlineRadio6">6</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion9" id="inlineRadio7" value="7" required>
                            <label class="form-check-label" for="inlineRadio7">7</label>
                        </div>
                        <div class="form-check form-check-inline">
                            High
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
            </div>

            <div class="container text-start">
                <div class="text-center">
                    <h1 class="display">Familiarity with Situation</h1>
                </div>
                <div class="row justify-content-start">
                    <div class="col-1">
                    </div>
                    <div class="col-10">
                        <h4>
                            How familiar are you with the situation? Do you have a great deal of relevant experience (High) or is it a new situation (Low)?
                        </h4>
                    </div>
                    <div class="col-1">
                    </div>
                </div>
                <div class="row justify-content-start mb-3">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <div class="form-check form-check-inline">
                            Low
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion10" id="inlineRadio1" value="1" required>
                            <label class="form-check-label" for="inlineRadio1">1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion10" id="inlineRadio2" value="2" required>
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion10" id="inlineRadio3" value="3" required>
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion10" id="inlineRadio4" value="4" required>
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion10" id="inlineRadio5" value="5" required>
                            <label class="form-check-label" for="inlineRadio5">5</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion10" id="inlineRadio6" value="6" required>
                            <label class="form-check-label" for="inlineRadio6">6</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="SARTQuestion10" id="inlineRadio7" value="7" required>
                            <label class="form-check-label" for="inlineRadio7">7</label>
                        </div>
                        <div class="form-check form-check-inline">
                            High
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-1">
                    </div>
                    <div class="col-10">
                        <h4>
                        Examination of Attention: Please select the fifth option
                        </h4>
                    </div>
                    <div class="col-1">
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <div class="form-check form-check-inline">
                            Low
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="DistractorQuestion2" id="inlineRadio1" value="1" required>
                            <label class="form-check-label" for="inlineRadio1">1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="DistractorQuestion2" id="inlineRadio2" value="2" required>
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="DistractorQuestion2" id="inlineRadio3" value="3" required>
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="DistractorQuestion2" id="inlineRadio4" value="4" required>
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="DistractorQuestion2" id="inlineRadio5" value="5" required>
                            <label class="form-check-label" for="inlineRadio4">5</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="DistractorQuestion2" id="inlineRadio6" value="6" required>
                            <label class="form-check-label" for="inlineRadio4">6</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="DistractorQuestion2" id="inlineRadio7" value="7" required>
                            <label class="form-check-label" for="inlineRadio5">7</label>
                        </div>
                        <div class="form-check form-check-inline">
                            High
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
            </div>


            <div class="container text-start">
                <div class="text-center">
                    <h1 class="display">Mental Demand</h1>
                </div>
                <div class="row justify-content-start">
                    <div class="col-1">
                    </div>
                    <div class="col-10">
                        <h4>
                            How much mental demand was involved in receiving and processing information (e.g., thinking, deciding, calculating, remembering, looking, searching ...)? Was the task easy or challenging, simple or complex, does it require high accuracy or is it error tolerant?
                        </h4>
                    </div>
                    <div class="col-1">
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                    <label for="TLXQuestion1" class="form-label"></label>
                        <select class="form-select" name="TLXQuestion1" id="TLXQuestion1" aria-label="Default select example" required>
                            <option value="0" selected>Please choose...</option>
                            <option value="1">1 - Very Low</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20 - Very High</option>
                        </select>
                    </div>
                    <div class="col-3">
                    </div>
                </div>
            </div>

            <div class="container text-start">
                <div class="text-center">
                    <h1 class="display">Perceived Safety</h1>
                </div>
                <div class="row justify-content-start">
                    <div class="col-1">
                    </div>
                    <div class="col-10">
                        <h4>
                            How would you estimate your current emotional state?
                        </h4>
                    </div>
                    <div class="col-1">
                    </div>
                </div>
                <div class="row justify-content-start mb-3">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <div class="form-check form-check-inline align-bottom">
                            anxious
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PSQuestion1" id="inlineRadio1" value="-3" required>
                            <label class="form-check-label" for="inlineRadio1"></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PSQuestion1" id="inlineRadio2" value="-2" required>
                            <label class="form-check-label" for="inlineRadio2"></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PSQuestion1" id="inlineRadio3" value="-1" required>
                            <label class="form-check-label" for="inlineRadio3"></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PSQuestion1" id="inlineRadio4" value="0" required>
                            <label class="form-check-label" for="inlineRadio4"></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PSQuestion1" id="inlineRadio5" value="1" required>
                            <label class="form-check-label" for="inlineRadio5"></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PSQuestion1" id="inlineRadio6" value="2" required>
                            <label class="form-check-label" for="inlineRadio6"></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PSQuestion1" id="inlineRadio7" value="3" required>
                            <label class="form-check-label" for="inlineRadio7"></label>
                        </div>
                        <div class="form-check form-check-inline align-bottom">
                            relaxed
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
                <div class="row justify-content-start mb-3">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <div class="form-check form-check-inline align-bottom">
                        agitated
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PSQuestion2" id="inlineRadio1" value="-3" required>
                            <label class="form-check-label" for="inlineRadio1"></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PSQuestion2" id="inlineRadio2" value="-2" required>
                            <label class="form-check-label" for="inlineRadio2"></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PSQuestion2" id="inlineRadio3" value="-1" required>
                            <label class="form-check-label" for="inlineRadio3"></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PSQuestion2" id="inlineRadio4" value="0" required>
                            <label class="form-check-label" for="inlineRadio4"></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PSQuestion2" id="inlineRadio5" value="1" required>
                            <label class="form-check-label" for="inlineRadio5"></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PSQuestion2" id="inlineRadio6" value="2" required>
                            <label class="form-check-label" for="inlineRadio6"></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PSQuestion2" id="inlineRadio7" value="3" required>
                            <label class="form-check-label" for="inlineRadio7"></label>
                        </div>
                        <div class="form-check form-check-inline align-bottom">
                        calm
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
                <div class="row justify-content-start mb-3">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <div class="form-check form-check-inline align-bottom">
                        unsafe
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PSQuestion3" id="inlineRadio1" value="-3" required>
                            <label class="form-check-label" for="inlineRadio1"></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PSQuestion3" id="inlineRadio2" value="-2" required>
                            <label class="form-check-label" for="inlineRadio2"></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PSQuestion3" id="inlineRadio3" value="-1" required>
                            <label class="form-check-label" for="inlineRadio3"></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PSQuestion3" id="inlineRadio4" value="0" required>
                            <label class="form-check-label" for="inlineRadio4"></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PSQuestion3" id="inlineRadio5" value="1" required>
                            <label class="form-check-label" for="inlineRadio5"></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PSQuestion3" id="inlineRadio6" value="2" required>
                            <label class="form-check-label" for="inlineRadio6"></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PSQuestion3" id="inlineRadio7" value="3" required>
                            <label class="form-check-label" for="inlineRadio7"></label>
                        </div>
                        <div class="form-check form-check-inline align-bottom">
                        safe
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
                <div class="row justify-content-start mb-3">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <div class="form-check form-check-inline align-bottom">
                        timid
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PSQuestion4" id="inlineRadio1" value="-3" required>
                            <label class="form-check-label" for="inlineRadio1"></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PSQuestion4" id="inlineRadio2" value="-2" required>
                            <label class="form-check-label" for="inlineRadio2"></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PSQuestion4" id="inlineRadio3" value="-1" required>
                            <label class="form-check-label" for="inlineRadio3"></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PSQuestion4" id="inlineRadio4" value="0" required>
                            <label class="form-check-label" for="inlineRadio4"></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PSQuestion4" id="inlineRadio5" value="1" required>
                            <label class="form-check-label" for="inlineRadio5"></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PSQuestion4" id="inlineRadio6" value="2" required>
                            <label class="form-check-label" for="inlineRadio6"></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PSQuestion4" id="inlineRadio7" value="3" required>
                            <label class="form-check-label" for="inlineRadio7"></label>
                        </div>
                        <div class="form-check form-check-inline align-bottom">
                        confident
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
            </div>

            <div class="container text-start">
                <div class="text-center">
                    <h1 class="display">Trust</h1>
                </div>
                <div class="row justify-content-start">
                    <div class="col-1">
                    </div>
                    <div class="col-10">
                        <h4>
                            I trust the highly automated vehicle.
                        </h4>
                    </div>
                    <div class="col-1">
                    </div>
                </div>
                <div class="row justify-content-start mb-3">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="TrustQuestion1" id="inlineRadio1" value="1" required>
                            <label class="form-check-label" for="inlineRadio1">Strongly Disagree - 1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="TrustQuestion1" id="inlineRadio2" value="2" required>
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="TrustQuestion1" id="inlineRadio3" value="3" required>
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="TrustQuestion1" id="inlineRadio4" value="4" required>
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="TrustQuestion1" id="inlineRadio5" value="5" required>
                            <label class="form-check-label" for="inlineRadio5">Strongly Agree - 5</label>
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-1">
                    </div>
                    <div class="col-10">
                        <h4>
                            I can rely on the highly automated vehicle.
                        </h4>
                    </div>
                    <div class="col-1">
                    </div>
                </div>
                <div class="row justify-content-start mb-3">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="TrustQuestion2" id="inlineRadio1" value="1" required>
                            <label class="form-check-label" for="inlineRadio1">Strongly Disagree - 1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="TrustQuestion2" id="inlineRadio2" value="2" required>
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="TrustQuestion2" id="inlineRadio3" value="3" required>
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="TrustQuestion2" id="inlineRadio4" value="4" required>
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="TrustQuestion2" id="inlineRadio5" value="5" required>
                            <label class="form-check-label" for="inlineRadio5">Strongly Agree - 5</label>
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-1">
                    </div>
                    <div class="col-10">
                        <h4>
                            The automated vehicle state was always clear to me.
                        </h4>
                    </div>
                    <div class="col-1">
                    </div>
                </div>
                <div class="row justify-content-start mb-3">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="TrustQuestion3" id="inlineRadio1" value="1" required>
                            <label class="form-check-label" for="inlineRadio1">Strongly Disagree - 1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="TrustQuestion3" id="inlineRadio2" value="2" required>
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="TrustQuestion3" id="inlineRadio3" value="3" required>
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="TrustQuestion3" id="inlineRadio4" value="4" required>
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="TrustQuestion3" id="inlineRadio5" value="5" required>
                            <label class="form-check-label" for="inlineRadio5">Strongly Agree - 5</label>
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-1">
                    </div>
                    <div class="col-10">
                        <h4>
                            The automated vehicle reacts unpredictably.
                        </h4>
                    </div>
                    <div class="col-1">
                    </div>
                </div>
                <div class="row justify-content-start mb-3">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="TrustQuestion4" id="inlineRadio1" value="1" required>
                            <label class="form-check-label" for="inlineRadio1">Strongly Disagree - 1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="TrustQuestion4" id="inlineRadio2" value="2" required>
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="TrustQuestion4" id="inlineRadio3" value="3" required>
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="TrustQuestion4" id="inlineRadio4" value="4" required>
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="TrustQuestion4" id="inlineRadio5" value="5" required>
                            <label class="form-check-label" for="inlineRadio5">Strongly Agree - 5</label>
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-1">
                    </div>
                    <div class="col-10">
                        <h4>
                            I was able to understand why things happened.
                        </h4>
                    </div>
                    <div class="col-1">
                    </div>
                </div>
                <div class="row justify-content-start mb-3">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="TrustQuestion5" id="inlineRadio1" value="1" required>
                            <label class="form-check-label" for="inlineRadio1">Strongly Disagree - 1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="TrustQuestion5" id="inlineRadio2" value="2" required>
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="TrustQuestion5" id="inlineRadio3" value="3" required>
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="TrustQuestion5" id="inlineRadio4" value="4" required>
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="TrustQuestion5" id="inlineRadio5" value="5" required>
                            <label class="form-check-label" for="inlineRadio5">Strongly Agree - 5</label>
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-1">
                    </div>
                    <div class="col-10">
                        <h4>
                            It's difficult to identify what the automated vehicle will do next.
                        </h4>
                    </div>
                    <div class="col-1">
                    </div>
                </div>
                <div class="row justify-content-start mb-3">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="TrustQuestion6" id="inlineRadio1" value="1" required>
                            <label class="form-check-label" for="inlineRadio1">Strongly Disagree - 1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="TrustQuestion6" id="inlineRadio2" value="2" required>
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="TrustQuestion6" id="inlineRadio3" value="3" required>
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="TrustQuestion6" id="inlineRadio4" value="4" required>
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="TrustQuestion6" id="inlineRadio5" value="5" required>
                            <label class="form-check-label" for="inlineRadio5">Strongly Agree - 5</label>
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
            </div>

            <div class="container text-start">
                <div class="text-center">
                    <h1 class="display">Visualizations</h1>
                </div>
                <div class="row justify-content-start">
                    <div class="col-1">
                    </div>
                    <div class="col-10">
                        <h4>
                            I think that I would like to use these visualizations frequently.
                        </h4>
                    </div>
                    <div class="col-1">
                    </div>
                </div>
                <div class="row justify-content-start mb-3">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="CSUSQuestion1" id="inlineRadio1" value="1" required>
                            <label class="form-check-label" for="inlineRadio1">Strongly Disagree - 1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="CSUSQuestion1" id="inlineRadio2" value="2" required>
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="CSUSQuestion1" id="inlineRadio3" value="3" required>
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="CSUSQuestion1" id="inlineRadio4" value="4" required>
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="CSUSQuestion1" id="inlineRadio5" value="5" required>
                            <label class="form-check-label" for="inlineRadio5">Strongly Agree - 5</label>
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-1">
                    </div>
                    <div class="col-10">
                        <h4>
                            I found the visualizations unnecessarily complex.
                        </h4>
                    </div>
                    <div class="col-1">
                    </div>
                </div>
                <div class="row justify-content-start mb-3">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="CSUSQuestion2" id="inlineRadio1" value="1" required>
                            <label class="form-check-label" for="inlineRadio1">Strongly Disagree - 1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="CSUSQuestion2" id="inlineRadio2" value="2" required>
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="CSUSQuestion2" id="inlineRadio3" value="3" required>
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="CSUSQuestion2" id="inlineRadio4" value="4" required>
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="CSUSQuestion2" id="inlineRadio5" value="5" required>
                            <label class="form-check-label" for="inlineRadio5">Strongly Agree - 5</label>
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
            </div>

            <div class="container text-start">
                <div class="text-center">
                    <h1 class="display">Perception</h1>
                </div>
                <div class="row justify-content-start">
                    <div class="col-1">
                    </div>
                    <div class="col-10">
                        <h4>
                        The automated vehicle recognizes all pedestrians in every situation perfectly.
                        </h4>
                    </div>
                    <div class="col-1">
                    </div>
                </div>
                <div class="row justify-content-start mb-3">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion1" id="inlineRadio1" value="1" required>
                            <label class="form-check-label" for="inlineRadio1">Totally Disagree - 1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion1" id="inlineRadio2" value="2" required>
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion1" id="inlineRadio3" value="3" required>
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion1" id="inlineRadio4" value="4" required>
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion1" id="inlineRadio5" value="5" required>
                            <label class="form-check-label" for="inlineRadio4">5</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion1" id="inlineRadio6" value="6" required>
                            <label class="form-check-label" for="inlineRadio4">6</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion1" id="inlineRadio7" value="7" required>
                            <label class="form-check-label" for="inlineRadio5">Totally Agree - 7</label>
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-1">
                    </div>
                    <div class="col-10">
                        <h4>
                        The automated vehicle recognizes all signposts in every situation perfectly.
                        </h4>
                    </div>
                    <div class="col-1">
                    </div>
                </div>
                <div class="row justify-content-start mb-3">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion2" id="inlineRadio1" value="1" required>
                            <label class="form-check-label" for="inlineRadio1">Totally Disagree - 1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion2" id="inlineRadio2" value="2" required>
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion2" id="inlineRadio3" value="3" required>
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion2" id="inlineRadio4" value="4" required>
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion2" id="inlineRadio5" value="5" required>
                            <label class="form-check-label" for="inlineRadio4">5</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion2" id="inlineRadio6" value="6" required>
                            <label class="form-check-label" for="inlineRadio4">6</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion2" id="inlineRadio7" value="7" required>
                            <label class="form-check-label" for="inlineRadio5">Totally Agree - 7</label>
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-1">
                    </div>
                    <div class="col-10">
                        <h4>
                        The automated vehicle predicts all pedestrian intentions in every scene perfectly.
                        </h4>
                    </div>
                    <div class="col-1">
                    </div>
                </div>
                <div class="row justify-content-start mb-3">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion3" id="inlineRadio1" value="1" required>
                            <label class="form-check-label" for="inlineRadio1">Totally Disagree - 1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion3" id="inlineRadio2" value="2" required>
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion3" id="inlineRadio3" value="3" required>
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion3" id="inlineRadio4" value="4" required>
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion3" id="inlineRadio5" value="5" required>
                            <label class="form-check-label" for="inlineRadio4">5</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion3" id="inlineRadio6" value="6" required>
                            <label class="form-check-label" for="inlineRadio4">6</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion3" id="inlineRadio7" value="7" required>
                            <label class="form-check-label" for="inlineRadio5">Totally Agree - 7</label>
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-1">
                    </div>
                    <div class="col-10">
                        <h4>
                        The automated vehicle predicts all vehicle paths in every scene perfectly.
                        </h4>
                    </div>
                    <div class="col-1">
                    </div>
                </div>
                <div class="row justify-content-start mb-3">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion4" id="inlineRadio1" value="1" required>
                            <label class="form-check-label" for="inlineRadio1">Totally Disagree - 1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion4" id="inlineRadio2" value="2" required>
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion4" id="inlineRadio3" value="3" required>
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion4" id="inlineRadio4" value="4" required>
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion4" id="inlineRadio5" value="5" required>
                            <label class="form-check-label" for="inlineRadio4">5</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion4" id="inlineRadio6" value="6" required>
                            <label class="form-check-label" for="inlineRadio4">6</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion4" id="inlineRadio7" value="7" required>
                            <label class="form-check-label" for="inlineRadio5">Totally Agree - 7</label>
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-1">
                    </div>
                    <div class="col-10">
                        <h4>
                        The automated vehicle has perfect longitudinal guidance (braking, acceleration, ...).
                        </h4>
                    </div>
                    <div class="col-1">
                    </div>
                </div>
                <div class="row justify-content-start mb-3">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion5" id="inlineRadio1" value="1" required>
                            <label class="form-check-label" for="inlineRadio1">Totally Disagree - 1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion5" id="inlineRadio2" value="2" required>
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion5" id="inlineRadio3" value="3" required>
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion5" id="inlineRadio4" value="4" required>
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion5" id="inlineRadio5" value="5" required>
                            <label class="form-check-label" for="inlineRadio4">5</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion5" id="inlineRadio6" value="6" required>
                            <label class="form-check-label" for="inlineRadio4">6</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion5" id="inlineRadio7" value="7" required>
                            <label class="form-check-label" for="inlineRadio5">Totally Agree - 7</label>
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-1">
                    </div>
                    <div class="col-10">
                        <h4>
                        Examination of Attention: Please select the first option
                        </h4>
                    </div>
                    <div class="col-1">
                    </div>
                </div>
                <div class="row justify-content-start mb-3">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="DistractorQuestion1" id="inlineRadio1" value="1" required>
                            <label class="form-check-label" for="inlineRadio1">Totally Disagree - 1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="DistractorQuestion1" id="inlineRadio2" value="2" required>
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="DistractorQuestion1" id="inlineRadio3" value="3" required>
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="DistractorQuestion1" id="inlineRadio4" value="4" required>
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="DistractorQuestion1" id="inlineRadio5" value="5" required>
                            <label class="form-check-label" for="inlineRadio4">5</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="DistractorQuestion1" id="inlineRadio6" value="6" required>
                            <label class="form-check-label" for="inlineRadio4">6</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="DistractorQuestion1" id="inlineRadio7" value="7" required>
                            <label class="form-check-label" for="inlineRadio5">Totally Agree - 7</label>
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-1">
                    </div>
                    <div class="col-10">
                        <h4>
                        The automated vehicle has perfect lateral guidance (keeping track, staying on the road).
                        </h4>
                    </div>
                    <div class="col-1">
                    </div>
                </div>
                <div class="row justify-content-start mb-3">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion6" id="inlineRadio1" value="1" required>
                            <label class="form-check-label" for="inlineRadio1">Totally Disagree - 1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion6" id="inlineRadio2" value="2" required>
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion6" id="inlineRadio3" value="3" required>
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion6" id="inlineRadio4" value="4" required>
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion6" id="inlineRadio5" value="5" required>
                            <label class="form-check-label" for="inlineRadio4">5</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion6" id="inlineRadio6" value="6" required>
                            <label class="form-check-label" for="inlineRadio4">6</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion6" id="inlineRadio7" value="7" required>
                            <label class="form-check-label" for="inlineRadio5">Totally Agree - 7</label>
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-1">
                    </div>
                    <div class="col-10">
                        <h4>
                        The automated vehicle made an unsafe judgement in this situation.
                        </h4>
                    </div>
                    <div class="col-1">
                    </div>
                </div>
                <div class="row justify-content-start mb-3">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion7" id="inlineRadio1" value="1" required>
                            <label class="form-check-label" for="inlineRadio1">Totally Disagree - 1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion7" id="inlineRadio2" value="2" required>
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion7" id="inlineRadio3" value="3" required>
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion7" id="inlineRadio4" value="4" required>
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion7" id="inlineRadio5" value="5" required>
                            <label class="form-check-label" for="inlineRadio4">5</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion7" id="inlineRadio6" value="6" required>
                            <label class="form-check-label" for="inlineRadio4">6</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion7" id="inlineRadio7" value="7" required>
                            <label class="form-check-label" for="inlineRadio5">Totally Agree - 7</label>
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-1">
                    </div>
                    <div class="col-10">
                        <h4>
                        The automated vehicle reacted appropriately on the environment.
                        </h4>
                    </div>
                    <div class="col-1">
                    </div>
                </div>
                <div class="row justify-content-start mb-3">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion8" id="inlineRadio1" value="1" required>
                            <label class="form-check-label" for="inlineRadio1">Totally Disagree - 1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion8" id="inlineRadio2" value="2" required>
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion8" id="inlineRadio3" value="3" required>
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion8" id="inlineRadio4" value="4" required>
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion8" id="inlineRadio5" value="5" required>
                            <label class="form-check-label" for="inlineRadio4">5</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion8" id="inlineRadio6" value="6" required>
                            <label class="form-check-label" for="inlineRadio4">6</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion8" id="inlineRadio7" value="7" required>
                            <label class="form-check-label" for="inlineRadio5">Totally Agree - 7</label>
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-1">
                    </div>
                    <div class="col-10">
                        <h4>
                        I would have performed better than the automated vehicle in this situation.
                        </h4>
                    </div>
                    <div class="col-1">
                    </div>
                </div>
                <div class="row justify-content-start mb-3">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion9" id="inlineRadio1" value="1" required>
                            <label class="form-check-label" for="inlineRadio1">Totally Disagree - 1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion9" id="inlineRadio2" value="2" required>
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion9" id="inlineRadio3" value="3" required>
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion9" id="inlineRadio4" value="4" required>
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion9" id="inlineRadio5" value="5" required>
                            <label class="form-check-label" for="inlineRadio4">5</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion9" id="inlineRadio6" value="6" required>
                            <label class="form-check-label" for="inlineRadio4">6</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion9" id="inlineRadio7" value="7" required>
                            <label class="form-check-label" for="inlineRadio5">Totally Agree - 7</label>
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-1">
                    </div>
                    <div class="col-10">
                        <h4>
                        It was always clear what the automated vehicle will do next.
                        </h4>
                    </div>
                    <div class="col-1">
                    </div>
                </div>
                <div class="row justify-content-start mb-3">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion10" id="inlineRadio1" value="1" required>
                            <label class="form-check-label" for="inlineRadio1">Totally Disagree - 1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion10" id="inlineRadio2" value="2" required>
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion10" id="inlineRadio3" value="3" required>
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion10" id="inlineRadio4" value="4" required>
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion10" id="inlineRadio5" value="5" required>
                            <label class="form-check-label" for="inlineRadio4">5</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion10" id="inlineRadio6" value="6" required>
                            <label class="form-check-label" for="inlineRadio4">6</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="PerceptionQuestion10" id="inlineRadio7" value="7" required>
                            <label class="form-check-label" for="inlineRadio5">Totally Agree - 7</label>
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
            </div>

            <div class="container text-start">
                <div class="text-center">
                    <h1 class="display">Other</h1>
                </div>
                <div class="row justify-content-start">
                    <div class="col-1">
                    </div>
                    <div class="col-10">
                        <h4>
                        The automated vehicle drove as I expected.
                        </h4>
                    </div>
                    <div class="col-1">
                    </div>
                </div>
                <div class="row justify-content-start mb-3">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion1" id="inlineRadio1" value="1" required>
                            <label class="form-check-label" for="inlineRadio1">Totally Disagree</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion1" id="inlineRadio2" value="2" required>
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion1" id="inlineRadio3" value="3" required>
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion1" id="inlineRadio4" value="4" required>
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion1" id="inlineRadio5" value="5" required>
                            <label class="form-check-label" for="inlineRadio4">5</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion1" id="inlineRadio6" value="6" required>
                            <label class="form-check-label" for="inlineRadio4">6</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion1" id="inlineRadio7" value="7" required>
                            <label class="form-check-label" for="inlineRadio5">Totally Agree</label>
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-1">
                    </div>
                    <div class="col-10">
                        <h4>
                        The reasons for the automated vehicle's behavior were clear to me at all times.
                        </h4>
                    </div>
                    <div class="col-1">
                    </div>
                </div>
                <div class="row justify-content-start mb-3">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion2" id="inlineRadio1" value="1" required>
                            <label class="form-check-label" for="inlineRadio1">Totally Disagree</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion2" id="inlineRadio2" value="2" required>
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion2" id="inlineRadio3" value="3" required>
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion2" id="inlineRadio4" value="4" required>
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion2" id="inlineRadio5" value="5" required>
                            <label class="form-check-label" for="inlineRadio4">5</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion2" id="inlineRadio6" value="6" required>
                            <label class="form-check-label" for="inlineRadio4">6</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion2" id="inlineRadio7" value="7" required>
                            <label class="form-check-label" for="inlineRadio5">Totally Agree</label>
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-1">
                    </div>
                    <div class="col-10">
                        <h4>
                        I think the visualizations provided were reasonable.
                        </h4>
                    </div>
                    <div class="col-1">
                    </div>
                </div>
                <div class="row justify-content-start mb-3">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion3" id="inlineRadio1" value="1" required>
                            <label class="form-check-label" for="inlineRadio1">Totally Disagree</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion3" id="inlineRadio2" value="2" required>
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion3" id="inlineRadio3" value="3" required>
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion3" id="inlineRadio4" value="4" required>
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion3" id="inlineRadio5" value="5" required>
                            <label class="form-check-label" for="inlineRadio4">5</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion3" id="inlineRadio6" value="6" required>
                            <label class="form-check-label" for="inlineRadio4">6</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion3" id="inlineRadio7" value="7" required>
                            <label class="form-check-label" for="inlineRadio5">Totally Agree</label>
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-1">
                    </div>
                    <div class="col-10">
                        <h4>
                        I think the visualizations provided were necessary.
                        </h4>
                    </div>
                    <div class="col-1">
                    </div>
                </div>
                <div class="row justify-content-start mb-3">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion4" id="inlineRadio1" value="1" required>
                            <label class="form-check-label" for="inlineRadio1">Totally Disagree</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion4" id="inlineRadio2" value="2" required>
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion4" id="inlineRadio3" value="3" required>
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion4" id="inlineRadio4" value="4" required>
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion4" id="inlineRadio5" value="5" required>
                            <label class="form-check-label" for="inlineRadio4">5</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion4" id="inlineRadio6" value="6" required>
                            <label class="form-check-label" for="inlineRadio4">6</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion4" id="inlineRadio7" value="7" required>
                            <label class="form-check-label" for="inlineRadio5">Totally Agree</label>
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-1">
                    </div>
                    <div class="col-10">
                        <h4>
                        I think there were too many visualizations provided.
                        </h4>
                    </div>
                    <div class="col-1">
                    </div>
                </div>
                <div class="row justify-content-start mb-3">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion5" id="inlineRadio1" value="1" required>
                            <label class="form-check-label" for="inlineRadio1">Totally Disagree</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion5" id="inlineRadio2" value="2" required>
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion5" id="inlineRadio3" value="3" required>
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion5" id="inlineRadio4" value="4" required>
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion5" id="inlineRadio5" value="5" required>
                            <label class="form-check-label" for="inlineRadio4">5</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion5" id="inlineRadio6" value="6" required>
                            <label class="form-check-label" for="inlineRadio4">6</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion5" id="inlineRadio7" value="7" required>
                            <label class="form-check-label" for="inlineRadio5">Totally Agree</label>
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-1">
                    </div>
                    <div class="col-10">
                        <h4>
                        I would have liked more information regarding the automated vehicle's perception (what did the automated vehicle "see").
                        </h4>
                    </div>
                    <div class="col-1">
                    </div>
                </div>
                <div class="row justify-content-start mb-3">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion6" id="inlineRadio1" value="1" required>
                            <label class="form-check-label" for="inlineRadio1">Totally Disagree</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion6" id="inlineRadio2" value="2" required>
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion6" id="inlineRadio3" value="3" required>
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion6" id="inlineRadio4" value="4" required>
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion6" id="inlineRadio5" value="5" required>
                            <label class="form-check-label" for="inlineRadio4">5</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion6" id="inlineRadio6" value="6" required>
                            <label class="form-check-label" for="inlineRadio4">6</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion6" id="inlineRadio7" value="7" required>
                            <label class="form-check-label" for="inlineRadio5">Totally Agree</label>
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-1">
                    </div>
                    <div class="col-10">
                        <h4>
                        I would have liked more information regarding the automated vehicle's predictions (how does the automated vehicle think the future will be).
                        </h4>
                    </div>
                    <div class="col-1">
                    </div>
                </div>
                <div class="row justify-content-start mb-3">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion7" id="inlineRadio1" value="1" required>
                            <label class="form-check-label" for="inlineRadio1">Totally Disagree</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion7" id="inlineRadio2" value="2" required>
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion7" id="inlineRadio3" value="3" required>
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion7" id="inlineRadio4" value="4" required>
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion7" id="inlineRadio5" value="5" required>
                            <label class="form-check-label" for="inlineRadio4">5</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion7" id="inlineRadio6" value="6" required>
                            <label class="form-check-label" for="inlineRadio4">6</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion7" id="inlineRadio7" value="7" required>
                            <label class="form-check-label" for="inlineRadio5">Totally Agree</label>
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-1">
                    </div>
                    <div class="col-10">
                        <h4>
                        I would have liked more information regarding the automated vehicle's future path (where will the automated vehicle drive to).
                        </h4>
                    </div>
                    <div class="col-1">
                    </div>
                </div>
                <div class="row justify-content-start mb-3">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion8" id="inlineRadio1" value="1" required>
                            <label class="form-check-label" for="inlineRadio1">Totally Disagree</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion8" id="inlineRadio2" value="2" required>
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion8" id="inlineRadio3" value="3" required>
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion8" id="inlineRadio4" value="4" required>
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion8" id="inlineRadio5" value="5" required>
                            <label class="form-check-label" for="inlineRadio4">5</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion8" id="inlineRadio6" value="6" required>
                            <label class="form-check-label" for="inlineRadio4">6</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="OwnQuestion8" id="inlineRadio7" value="7" required>
                            <label class="form-check-label" for="inlineRadio5">Totally Agree</label>
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
            </div>

            <div class="col-12 justify-content-center d-flex">
                <input class="btn btn-primary" type="submit" name="questionsSubmit" id="questionsSubmit">
            </div>

        </form>
        <div class="progress" style="height: 20px;">
            <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">80%</div>
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
<script type='text/javascript'>
    document.getElementById('video').addEventListener('ended',myHandler,false);
    function myHandler(e) {
        document.getElementById("videoDIV").style.display="none";
        document.getElementById("questionsForm").style.display="block";
    }
</script>
<script>
    function validateForm() {
        let SARTQ1 = document.forms["questionsForm"]["SARTQuestion1"].value;
        let SARTQ2 = document.forms["questionsForm"]["SARTQuestion2"].value;
        let SARTQ3 = document.forms["questionsForm"]["SARTQuestion3"].value;
        let SARTQ4 = document.forms["questionsForm"]["SARTQuestion4"].value;
        let SARTQ5 = document.forms["questionsForm"]["SARTQuestion5"].value;
        let SARTQ6 = document.forms["questionsForm"]["SARTQuestion6"].value;
        let SARTQ7 = document.forms["questionsForm"]["SARTQuestion7"].value;
        let SARTQ8 = document.forms["questionsForm"]["SARTQuestion8"].value;
        let SARTQ9 = document.forms["questionsForm"]["SARTQuestion9"].value;
        let SARTQ10 = document.forms["questionsForm"]["SARTQuestion10"].value;
        let TLXQ1 = document.forms["questionsForm"]["TLXQuestion1"].value;
        let PSQ1 = document.forms["questionsForm"]["PSQuestion1"].value;
        let PSQ2 = document.forms["questionsForm"]["PSQuestion2"].value;
        let PSQ3 = document.forms["questionsForm"]["PSQuestion3"].value;
        let PSQ4 = document.forms["questionsForm"]["PSQuestion4"].value;
        let TQ1 = document.forms["questionsForm"]["TrustQuestion1"].value;
        let TQ2 = document.forms["questionsForm"]["TrustQuestion2"].value;
        let TQ3 = document.forms["questionsForm"]["TrustQuestion3"].value;
        let TQ4 = document.forms["questionsForm"]["TrustQuestion4"].value;
        let TQ5 = document.forms["questionsForm"]["TrustQuestion5"].value;
        let TQ6 = document.forms["questionsForm"]["TrustQuestion6"].value;
        let CSUSQ1 = document.forms["questionsForm"]["CSUSQuestion1"].value;
        let CSUSQ2 = document.forms["questionsForm"]["CSUSQuestion2"].value;
        let PQ1 = document.forms["questionsForm"]["PerceptionQuestion1"].value;
        let PQ2 = document.forms["questionsForm"]["PerceptionQuestion2"].value;
        let PQ3 = document.forms["questionsForm"]["PerceptionQuestion3"].value;
        let PQ4 = document.forms["questionsForm"]["PerceptionQuestion4"].value;
        let PQ5 = document.forms["questionsForm"]["PerceptionQuestion5"].value;
        let PQ6 = document.forms["questionsForm"]["PerceptionQuestion6"].value;
        let PQ7 = document.forms["questionsForm"]["PerceptionQuestion7"].value;
        let PQ8 = document.forms["questionsForm"]["PerceptionQuestion8"].value;
        let PQ9 = document.forms["questionsForm"]["PerceptionQuestion9"].value;
        let PQ10 = document.forms["questionsForm"]["PerceptionQuestion10"].value;
        let OQ1 = document.forms["questionsForm"]["OwnQuestion1"].value;
        let OQ2 = document.forms["questionsForm"]["OwnQuestion2"].value;
        let OQ3 = document.forms["questionsForm"]["OwnQuestion3"].value;
        let OQ4 = document.forms["questionsForm"]["OwnQuestion4"].value;
        let OQ5 = document.forms["questionsForm"]["OwnQuestion5"].value;
        let OQ6 = document.forms["questionsForm"]["OwnQuestion6"].value;
        let OQ7 = document.forms["questionsForm"]["OwnQuestion7"].value;
        let OQ8 = document.forms["questionsForm"]["OwnQuestion8"].value;
        let DQ1 = document.forms["questionsForm"]["DistractorQuestion1"].value;
        let DQ2 = document.forms["questionsForm"]["DistractorQuestion2"].value;
        if (SARTQ1 === "" || SARTQ2 === "" || SARTQ3 === "" || SARTQ4 === "" || SARTQ5 === ""
            || SARTQ6 === "" || SARTQ7 === "" || SARTQ8 === "" || SARTQ9 === "" || SARTQ10 === ""
            || TLXQ1 === "0" || PSQ1 === "" || PSQ2 === "" || PSQ3 === "" || PSQ4 === ""
            || TQ1 === "" || TQ2 === "" || TQ3 === "" || TQ4 === "" || TQ5 === ""
            || TQ6 === "" || CSUSQ1 === "" || CSUSQ2 === "" || PQ1 === "" || PQ2 === ""
            || PQ3 === "" || PQ4 === "" || PQ5 === "" || PQ6 === "" || PQ7 === ""
            || PQ8 === "" || PQ9 === "" || PQ10 === "" || OQ1 === "" || OQ2 === ""
            || OQ3 === "" || OQ4 === "" || OQ5 === "" || OQ6 === "" || OQ7 === ""
            || OQ8 === "" || DQ1 === "" || DQ2 === "") {
            alert("Please answer all the questions!");
            return false;
        }
    }
</script>

<script>
    var vids = document.querySelectorAll("video");

    // for all the videos in the page
    for (var x = 0; x < vids.length; x++) {

        // add an event listening for errors
        vids[x].addEventListener('error', function(e) {

            // if the error is caused by the video not loading
            if (this.networkState > 2) {

                // add an image with the message "video not found"
                this.setAttribute("poster", "http://dummyimage.com/312x175/000/fff.jpg&text=Video+Not+Found");
            }
        }, true);

    }
</script>

</body>
</html>