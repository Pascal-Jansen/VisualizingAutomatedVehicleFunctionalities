<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//$command = escapeshellcmd('/usr/custom/test2.py');
//$output = shell_exec($command);
//echo $output;

    //$cmd = "python test2.py";
    //exec($cmd . " &", $output, $return_var);
    //print_r($output);
    //echo $return_var;
    $test = "hello world";
    //$msg = exec("/var/www/available_ais/test2.py " . $test);
    //print_r($test);
    echo $_COOKIE["prolific_id"] . "<br>";
    $videoPath = "/uploads/test.mp4";
    echo ini_get("upload_max_filesize");
    echo ini_get("post_max_size");
    $errors = ["The file is smaller than 1 MB. Please upload a bigger video.","The uploaded video is shorter than 30 seconds. Please upload a longer video."];
    echo json_encode($errors);

?>
<!DOCTYPE html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

<meta charset="UTF-8">
<style>
.progress-wrapper {
    width:100%;
}
.progress-wrapper .progress {
    background-color:green;
    width:0%;
    height: 30px;
    padding:5px 0px 5px 0px;
}
.loader {
  border: 10px solid #f3f3f3;
  border-radius: 50%;
  border-top: 10px solid #3498db;
  width: 40px;
  height: 40px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
<!--
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
-->
<script>
function postFile1() {
    /**
    var formdata = new FormData();

    formdata.append('file1', $('#file1')[0].files[0]);

    var request = new XMLHttpRequest();

    request.upload.addEventListener('progress', function (e) {
        var file1Size = $('#file1')[0].files[0].size;

        if (e.loaded <= file1Size) {
            var percent = Math.round(e.loaded / file1Size * 100);
            $('#progress-bar-file1').width(percent + '%').html(percent + '%');
        } 

        if(e.loaded == e.total){
            $('#progress-bar-file1').width(100 + '%').html(100 + '%');
        }
    });   

    request.open('post', '/');
    request.timeout = 45000;
    request.send(formdata);
     */
    document.getElementById("loader1").style.diplay = "none";
}
</script>
</head>


<form id="form1">
    <input id="file1" type="file" />
    <div class="progress-wrapper">
        <div id="progress-bar-file1" class="progress"></div>
    </div>
    
</form>



<script>
function postFile() {
    
    document.getElementById("loader1").style.diplay = "none";
}
</script>

<button type="button" onclick="postFile()">Upload File</button>
<div class="loader" id="loader1" style="display: block"></div>












<button onclick="myFunction()">Try it</button>

<div id="myDIV">
This is my DIV element.
</div>






<form action="/" id="uploadform" method="post" enctype="multipart/form-data">
    <div class="input-group mb-3">
        <label class="input-group-text" for="inputGroupFile01">Upload</label>
        <!--<input type="hidden" name="MAX_FILE_SIZE" value="21000000" />-->
        <input type="file" class="form-control" id="inputGroupFile01" name="files[]" accept=".mp4">
        <div class="progress-wrapper">
            <div id="progress-bar-file1" class="progress"></div>
        </div>
    </div>
    
    <button type="submit" class="btn btn-primary" name="uploadSubmit" id="uploadSubmit">
        Upload
    </button>
</form>

<div class="loader" id="loader" style="display: none"></div>

<form action="test.php" method="post" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload Image" name="submit">
</form>


<script>
function myFunction() {
  let x = document.getElementById("myDIV");
  if (x.style.display == "block") {
  	x.style.display = "none";
  } else if (x.style.display == "none") {
  	x.style.display = "block";
  }
}
document.getElementById('uploadSubmit').onclick = function () {
    let x = document.getElementById("loader");
    if (x.style.display == "block") {
        x.style.display = "none";
    } else if (x.style.display == "none") {
        x.style.display = "block";
    }
}
</script>

</html>

<?php

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
/**

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
*/
    //echo($path);
    //<div class="ratio ratio-16x9">
    //<video width="1280" height="720" controls preload="auto">
    //if(!file_exists($_SERVER['DOCUMENT_ROOT'] . $path_video)){
    //    echo "No Video found. Please upload a video or enter your ProlificID again.";
        //die();
    //} elseif (!file_exists($_SERVER['DOCUMENT_ROOT'] . $path_video_result)){
    //    echo "Your Video is currently being processed. Please wait a few minutes.";
    //} elseif (!file_exists($_SERVER['DOCUMENT_ROOT'] . $path_video_result_converted)){
    //    echo "Your Video is converted to be displayed on the website. Please refresh the website in a few seconds.";
    //} else {
    //    echo "<video width='1280' height='720' controls preload='auto'>";
    //    echo "<source type='video/mp4' src='" . $path_video_result_converted . "'>";
    //    echo "Your Browser doesnt support videos.";
    //    echo "</video>";
    //}
    //echo "<video width='1280' height='720' controls preload='auto'>";
    //echo "<source type='video/mp4' src='" . $path_video_result_converted . "'>";
    //echo "Your Browser doesnt support videos.";
    //echo "</video>";

    //if(file_exists($_SERVER['DOCUMENT_ROOT'] . $path_video)){
    //    echo "existiert";
    //} else {
    //    echo "existiert nicht";
    //}
?>