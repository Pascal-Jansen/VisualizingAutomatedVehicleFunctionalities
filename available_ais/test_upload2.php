<?php
// RESPONSE FUNCTION
$prolificID = isset($_COOKIE['prolific_id']) ? $_COOKIE['prolific_id'] : '';

function verbose($ok=1,$info=""){
  // THROW A 400 ERROR ON FAILURE
  if ($ok==0) { http_response_code(400); }
  die(json_encode(["ok"=>$ok, "info"=>$info]));
}
// INVALID UPLOAD
if (empty($_FILES) || $_FILES['file']['error']) {
  verbose(0, "Failed to move uploaded file.");
}
// THE UPLOAD DESITINATION - CHANGE THIS TO YOUR OWN
$filePath = __DIR__ . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . $prolificID;
$dirPath = $filePath;
if (!file_exists($filePath)) { 
    $oldmask = umask(0);
  if (!mkdir($filePath, 0777, true)) {
    umask($oldmask);
    verbose(0, "Failed to create $filePath");
  }
  umask($oldmask);
}
$fileName = $prolificID . ".mp4"; //isset($_REQUEST["name"]) ? $_REQUEST["name"] : $_FILES["file"]["name"];
$filePath = $filePath . DIRECTORY_SEPARATOR . $fileName;
// DEAL WITH CHUNKS
$chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
$chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;
$out = @fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
if ($out) {
  $in = @fopen($_FILES['file']['tmp_name'], "rb");
  if ($in) {
    while ($buff = fread($in, 4096)) { fwrite($out, $buff); }
  } else {
    verbose(0, "Failed to open input stream");
  }
  @fclose($in);
  @fclose($out);
  @unlink($_FILES['file']['tmp_name']);
} else {
  verbose(0, "Failed to open output stream");
}
// CHECK IF FILE HAS BEEN UPLOADED
if (!$chunks || $chunk == $chunks - 1) {
  rename("{$filePath}.part", $filePath);
}
//verbose(1, "Upload OK");

//File handling danach...
if(file_exists($filePath)){
    $minFileSize = 1024 * 1024 * 1; //1 MB
    $minVideoDuration = 30;
    $maxVideoDuration = 300;
    $maxVideoFPS = 60;
    $minVideoFPS = 10;
    $fileSize = filesize($filePath);
    exec("ffprobe -v error -select_streams v:0 -show_entries stream=width,height -of default=nw=1:nk=1 " . $filePath, $videoDimensions);
    exec("ffprobe -v error -select_streams v:0 -show_entries stream=duration -of default=noprint_wrappers=1:nokey=1 " . $filePath, $videoLength);
    exec('ffmpeg -i ' . $filePath . ' 2>&1 | sed -n "s/.*, \(.*\) fp.*/\1/p"' , $videoFPS);
    
    if ($fileSize < $minFileSize) {
        $errors[] = 'The file is smaller than 1 MB. Please upload a bigger video.';
    }
    
    if(intval($videoDimensions[1]) > 1080) {
        $errors[] = 'The uploaded file is bigger than 1080p. Please convert it or upload another video.';
    }

    if(intval($videoDimensions[1]) < 720) {
        $errors[] = 'The uploaded file is smaller than 720p. Please convert it or upload another video.';
    }
    
    if(intval($videoFPS[0]) > $maxVideoFPS) {
        $errors[] = 'The uploaded video has more than 60 FPS. Please upload a video with a lesser framerate.';
    }

    if(intval($videoFPS[0]) < $minVideoFPS) {
        $errors[] = 'The uploaded video has less than 10 FPS. Please upload a video with a bigger framerate.';
    }
    
    if(intval($videoLength[0]) < $minVideoDuration){
        $errors[] = "The uploaded video is shorter than 30 seconds. Please upload a longer video.";
    } elseif (intval($videoLength[0] > $maxVideoDuration)){
        $errors[] = "The uploaded video is longer than 5 minutes. Please upload a shorter video.";
    }
    if(empty($errors)){
        $errors[] = "The file has been succesfully uploaded.";
        saveToTimeCSV($prolificID);
        verbose(0, $errors);
    } else {
        unlink($filePath);
        rmdir($dirPath);
        verbose(0, $errors);
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
?>