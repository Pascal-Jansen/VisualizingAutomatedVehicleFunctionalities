<?php
header("Location: /your_videos_index.php");
exit();

if(!isset($_COOKIE['prolific_id'])){
  $cookie_name = "prolific_id";
  $cookie_value = substr(md5(time()), 0, 24);
  $cookie_value_new = "";
  if(isset($_GET['PROLIFIC_PID'])){
    $prolific_pid = $_GET['PROLIFIC_PID'];
    preg_match("/[a-zA-Z0-9]{24}/", $prolific_pid, $matches);
    if($matches[0]){
      $cookie_value_new = $matches[0];
    }
  }
  if($cookie_value_new != ""){
    unset($_COOKIE['prolific_id']); 
    setcookie($cookie_name, $cookie_value_new, time() + 30 * 86400, "/"); // 86400 = 1 day
  } else {
    unset($_COOKIE['prolific_id']);
    setcookie($cookie_name, $cookie_value, time() + 30 * 86400, "/"); // 86400 = 1 day
  }
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



  <!-- main image & intro text -->
  <section id="intro">
    <div class="container-lg bg-light my-3 py-3">
      <div class="row g-4 justify-content-center align-items-center">
        <div class="col-md-5 text-center text-md-start">
          <h1>
            <div class="display-2">Assessing Automated Vehicle Capabilities</div>
            <div class="display-5 text-muted">An Online Survey</div>
          </h1>
        </div>
        <div class="col-md-5 text-center d-none d-md-block py-3">
          <!-- tooltip -->
          <span class="tt" data-bs-placement="bottom" title="AI car">
              <img src="/assets/ai_car.jpg" class="img-fluid" alt="aicar">
          </span>
        </div>
      </div>
    </div>
  </section>

  <section id="topics">
    <div class="container-md bg-light my-3 py-3">
      <div class="text-center">
        <h1 class="display-2 mb-5">The survey</h1>
      </div>
      <div class="row g-4 justify-content-center align-items-center">
        <div class="col-md-5 text-center text-md-start pb-3">
           <span class="tt" data-bs-placement="bottom" title="Semantic Segmentation">
             <img src="/assets/segmentation.jpg" class="img-fluid" alt="semsec">
           </span>
        </div>
        <div class="col-md-5 text-center d-none d-md-block">
          <p>
          You will see a video of a driving session in a highly automated vehicle. The vehicle takes over lateral and longitudinal control (braking, accelerating, steering).
          The vehicle attempts to assess the scene and determine the intent of nearby pedestrians and cars. It will then colorize them depending on the condition.
          Please try to observe the scene in a concentrated way, paying special attention to the visualizations and especially to how relevant you think they are,
          whether they are appropriate, whether you think they are helpful for you or whether there are too many visualizations for you. You will need this knowledge
          later on in the feedback part. While watching the video, you are supposed to imagine sitting in such an automated vehicle, follow the entire journey attentively,
          and then assess it. Make sure your speakers are turned on.
          </p>
        </div>
      </div>
      <div class="text-center my-3">
        <a class="btn btn-primary btn-lg" href="/survey_start.php" role="button">Start the survey</a>
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