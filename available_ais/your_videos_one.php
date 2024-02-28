<?php
include 'save_data.php';

$prolificID = isset($_COOKIE['prolific_id']) ? $_COOKIE['prolific_id'] : '';


$video = "uploads/" . $prolificID . "/" . $prolificID . ".mp4";
$video1 = "uploads/" . $prolificID . "/" . $prolificID . "_720p_25_fps.mp4";
$video2 = "uploads/" . $prolificID . "/" . $prolificID . "_720p_25_fps_result_pi_ps_converted.mp4";
$done = "uploads/" . $prolificID . "/" . $prolificID . "_done.txt";

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

$filepath = realpath(__DIR__) . "/results/demographic_part2.csv";
$entryFound = false;
if(file_exists($filepath)){
    $fp = fopen($filepath, 'r') or die("Unable to open file!");
    while(false !== ($csv = fgetcsv($fp))) {
        if($csv[0] == $prolificID){
            $entryFound = true;
            break;
        }
    }
}

if(file_exists($video) && file_exists($video1) && file_exists($video2) && file_exists($done)){ //} file_exists($video3) && file_exists($video4) && file_exists($video5) && file_exists($video6)){
    if($entryFoundCounter == 1){
        header("Location: /your_videos_three.php");
        exit();
    } elseif($entryFoundCounter == 2){
        header("Location: /your_videos_four.php");
        exit();
    } elseif($entryFoundCounter == 0){
        header("Location: /your_videos_two.php");
        exit();
    }
}

if($entryFound){
    if(file_exists($video)){
        header("Location: /your_videos_two.php");
        exit();
    }
} else {
    header("Location: /your_videos.php");
    exit();
}
/**
checkForContinue($prolificID);

if ( $_SERVER['REQUEST_METHOD'] == 'POST' && empty($_POST) &&
     empty($_FILES) && $_SERVER['CONTENT_LENGTH'] > 0 )
{
    echo '<script type="text/javascript">alert("The file is too big to be uploaded.")</script>';
}

// Check if we've uploaded a file
if (!empty($_FILES['files'])) {
    // Be sure we're dealing with an upload
    $filepath = implode("','", $_FILES['files']['tmp_name']);
    if (is_uploaded_file($filepath)) {
        //throw new \UnexpectedValueException('Error on upload: Invalid file definition');
        $errors = [];
        $path = "uploads/";

        exec("ffprobe -v error -select_streams v:0 -show_entries stream=width,height -of default=nw=1:nk=1 " . $filepath, $videoDimensions);
        
        exec("ffprobe -v error -select_streams v:0 -show_entries stream=duration -of default=noprint_wrappers=1:nokey=1 " . $filepath, $videoLength);
*/
        //exec('ffmpeg -i ' . $filepath . ' 2>&1 | sed -n "s/.*, \(.*\) fp.*/\1/p"' , $videoFPS);
/**        

        $fileSize = filesize($filepath);
        $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
        $filetype = finfo_file($fileinfo, $filepath);
        $uploadName = implode("','", $_FILES['files']['name']);
        if ($fileSize === 0) {
            $errors[] = 'The file is empty.';
        }

        if ($fileSize > 2000 * 1024 * 1024) { // 2000 MB
            $errors[] = 'The file is bigger than 2000 MB. Please upload a smaller video.';
        }

        if ($fileSize < 1 * 1024 * 1024) { // 1 MB
            $errors[] = 'The file is smaller than 1 MB. Please upload a bigger video.';
        }

        if(intval($videoDimensions[1]) > 1080) {
            $errors[] = 'The uploaded file is bigger than 1080p. Please convert it or upload another video.';
        }

        if(intval($videoFPS[0]) > 60) {
            $errors[] = 'The uploaded video has more than 60 FPS. Please upload a video with a lesser framerate.';
        }

        if(intval($videoLength[0]) < 30){
            $errors[] = "The uploaded video is shorter than 30 seconds. Please upload a longer video.";
        } elseif (intval($videoLength[0] > 300)){
            $errors[] = "The uploaded video is longer than 5 minutes. Please upload a shorter video.";
        }

        $allowedTypes = [
            'video/mp4' => 'mp4',
            'application/octet-stream' => 'mp4'
        ];

        if (!in_array($filetype, array_keys($allowedTypes))) {
            $errors[] = 'The filetype: ' . $filetype . ' is not allowed.';
        }

        function phpAlert($msg)
        {
            echo '<script type="text/javascript">alert("' . $msg . '")</script>';
        }

        if (empty($errors)) {
            // Rename the uploaded file
            $ext = strtolower(substr($uploadName, strripos($uploadName, '.') + 1));
            $newFilename = $_COOKIE['prolific_id'] . '.' . $ext;
            //Create new directory for each user
            if (!is_dir($path . $_COOKIE['prolific_id'] . '/')) {
                $oldmask = umask(0);
                if (!mkdir($path . $_COOKIE['prolific_id'] . '/', 0777, true)) {
                    $errors[] = "Can't create directory for user with ProlificID: " . $_COOKIE['prolific_id'];
                }
                umask($oldmask);
            }
            //Check if file with that name already exists
            if (!is_file($path . $_COOKIE['prolific_id'] . '/' . $newFilename)) {
                // Upload the file
                if (move_uploaded_file($filepath, $path . $_COOKIE['prolific_id'] . '/' . $newFilename)) {
                    $errors[] = "The file has been successfully uploaded.";
                    saveToTimeCSV($_COOKIE["prolific_id"]);
                } else {
                    $errors[] = "The file couldn't be uploaded.";
                    rmdir($path . $_COOKIE['prolific_id'] . '/');
                }
            } else {
                $errors[] = "The file already exists";
            }


        }
        foreach ($errors as $error) {
            phpAlert($error);
        }

    } else {
        echo '<script type="text/javascript">alert("Please choose a file.")</script>';
    }

}

function checkForContinue($prolID){
    $video = "uploads/" . $prolID . "/" . $prolID . ".mp4";
    $video1 = "uploads/" . $prolID . "/" . $prolID . "_result_is.mp4";
    $video2 = "uploads/" . $prolID . "/" . $prolID . "_result_is_converted.mp4";
    $video3 = "uploads/" . $prolID . "/" . $prolID . "_result_ps.mp4";
    $video4 = "uploads/" . $prolID . "/" . $prolID . "_result_ps_converted.mp4";
    $video5 = "uploads/" . $prolID . "/" . $prolID . "_result_od.mp4";
    $video6 = "uploads/" . $prolID . "/" . $prolID . "_result_od_converted.mp4";
    $video7 = "uploads/" . $prolID . "/" . $prolID . "_result_pi.mp4";
    //if(file_exists($video) && file_exists($video3) && file_exists($video4)){
    //    header("Location: /your_videos_two.php");
    //        exit();
    //}

    if(file_exists($video) && file_exists($video1) && file_exists($video2) && file_exists($video7)){ //} file_exists($video3) && file_exists($video4) && file_exists($video5) && file_exists($video6)){
        header("Location: /your_videos_two.php");
        exit();
    }
}

function saveToTimeCSV($prolID) {
    $csvPath = "uploads/uploadTime.csv";
    date_default_timezone_set("Europe/Berlin");
    $timeNow = date("Y-m-d H:i:s");
    $csvHeader = "ProlificID,UploadTime\n";
    $csvData = "$prolID,$timeNow\n";
    if(file_exists($csvPath)){
        file_put_contents($csvPath, $csvData, FILE_APPEND);
    } else {
        file_put_contents($csvPath, $csvHeader . $csvData);
    }
}
*/
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
    <script src="plupload/js/plupload.full.min.js"></script>
    <script>
      window.addEventListener("load", function () {
        var path = "plupload/js/`";
        var uploader = new plupload.Uploader({
          browse_button: 'uploadSubmit',
          container: document.getElementById('container'),
          url: 'test_upload2.php',
          chunk_size: '50mb',
          max_file_count: 1,
          filters: {
            max_file_size: '2000mb',
            min_file_size: '5000kb',
            multi_selection: false,
            mime_types: [{title: "Video", extensions: "mp4"}]
          },
          init: {
            PostInit: function () {
              document.getElementById('filelist').innerHTML = '';
            },
            FilesAdded: function (up, files) {
                //if (UrlExists()){
                //    alert("You have already uploaded a video. Please wait until the AI has finished rendering your result and come back later.")
                //    return
                //}
                //if (!UrlExists()){
                //    alert("aaaaaaaaa.")
                    
                //}
              plupload.each(files, function (file) {
                document.getElementById('filelist').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
              });
              let x = document.getElementById("loader");
              x.style.display = "block";
              uploader.start();
            },
            UploadProgress: function (up, file) {
              document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
            },
            Error: function (up, err) {
              // DO YOUR ERROR HANDLING!
              console.log(err);
              var response = err.response;
              if(err.message == "File extension error."){
                alert("Please upload a .mp4 file.");
                return;
              }
              if(err.message == "File size error."){
                alert("Please upload a .mp4 file that is smaller than 2000 MB.");
                return;
              }
              if(response.includes("504 Gateway Time-out")){
                alert("Unfortunately your upload timed out. Please try it again.");
                return;
              }
              var responseJSON = JSON.parse(response);
              var info = responseJSON.info;
              if(Array.isArray(info)){
                info = info.join(" ");
              }
              if(info == "The file has been succesfully uploaded."){
                let btn = document.getElementById("startSurveyButton");
                let btn2 = document.getElementById("uploadSubmit");
                let btn3 = document.getElementById("convBtn");
                let btn4 = document.getElementById("cutBtn");
                
                btn.style.display = "inline";
                btn2.style.display = "none";
                btn3.style.display = "none";
                btn4.style.display = "none";
              }
              alert(info);
              let x = document.getElementById("loader");
              x.style.display = "none";
              document.getElementById('filelist').innerHTML = '';

            }
          }
        });
        uploader.init();
      });
      
    </script>
</head>
<body>



<section id="topics">

    <div class="container-md bg-light my-3 py-3">
        <div class="text-center my-3 py-3">
            <h2>Upload your videos</h2>
            <p class="lead">Upload your own videos to see what an AI sees</p>
        </div>
        <div class="row justify-content-center my-3">
            <div class="col-md-8 text-center">
                <div id="container">
                    <button class="btn btn-primary btn-lg" name="uploadSubmit" id="uploadSubmit">
                        Upload
                    </button>
                </div>
                <div id="filelist">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
                
            </div>
        </div>
        
        <div class="row g-4 justify-content-center align-items-center">
            <div class="col-md-8 text-center text-md-start pb-3">
                <!--
                <p>
                    Here you can upload your own videos. Please upload a 720p mp4 video clip with a length of 1 minute.
                    If you don't have a mp4 file or the resolution is too high, you can click on the "Video Converter" button below to convert your video
                    or the "Video-Cutter" button to cut your video. If your video is too long, you can cut it into segments.
                </p>
                -->
                <p>
                In this study, you should take a <b>short video</b> (between 1 min and up to 5 min) of a <b>scenario</b> you believe an <b>automated vehicle</b> could <b>have problems managing/dealing with</b>. This could be, for example, at a busy intersection or a narrow driveway, on private ground, etc. Your video can include other vehicles and pedestrians.
                This video can be either taken from the <b>passenger's seat of a vehicle</b> or as a <b>pedestrian</b>. You have to upload this video.
                Then, you will see the video twice. One time with a visualization showing what an automated vehicle would perceive in this situation, one time without this visualization. Then, you will be asked to assess the video.
                We will check the video, if no traffic scene is shot, you are not eligible for payment.
                </p>
                <p>
                    After hitting the "Upload" button please wait until an alert box pops up, informing you if the upload was successfull.
                    If your file was succesfully uploaded you can start the survey.
                </p>    
            </div>
        </div>
        <div class="text-center my-3">
            <a class="btn btn-primary btn-lg" href="https://video-converter.com/" role="button" target="_blank" id="convBtn">Video Converter</a>
        </div>
        <div class="text-center my-3">
            <a class="btn btn-primary btn-lg" href="https://online-video-cutter.com/" role="button" target="_blank" id="cutBtn">Video Cutter</a>
        </div>
        <div class="text-center my-3">
            <a class="btn btn-primary btn-lg" href="your_videos_two.php" role="button" onclick="return UrlExists()" id="startSurveyButton" style="display: none">Start the survey</a>
        </div>
        <div class="progress" style="height: 20px;">
            <div class="progress-bar" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">40%</div>
        </div>
    </div>
</section>

<div class="loader" id="loader" style="display: none"></div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script>
    const tooltips = document.querySelectorAll('.tt')
    tooltips.forEach(t => {
        new bootstrap.Tooltip(t)
    })
</script>
<script type="text/javascript">
    function UrlExists()
    {
        var prolificID = getCookie("prolific_id");
        var url = "https://aiscepticism.loca.lt/uploads/" + prolificID + "/" + prolificID + ".mp4"
        var http = new XMLHttpRequest();
        http.open('HEAD', url, false);
        http.send();
        var returnStatus = http.status;
        if(returnStatus == 404){
            alert("Please upload a file before starting.")
            return false;
        } else if(returnStatus == 200) {
            return true;
        }
    }
    function getCookie(cname) {
        let name = cname + "=";
        let decodedCookie = decodeURIComponent(document.cookie);
        let ca = decodedCookie.split(';');
        for(let i = 0; i <ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') {
            c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
            }
        }
        return "";
    }
</script>

</body>
</html>