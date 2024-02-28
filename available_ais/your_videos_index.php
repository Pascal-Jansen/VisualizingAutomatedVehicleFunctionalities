<?php
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
          <!--
          <p>
          You will see a video of a driving session in a highly automated vehicle. The vehicle takes over lateral and longitudinal control (braking, accelerating, steering).
          The vehicle attempts to assess the scene and determine the intent of nearby pedestrians and cars. It will then colorize them depending on the condition.
          Please try to observe the scene in a concentrated way, paying special attention to the visualizations and especially to how relevant you think they are,
          whether they are appropriate, whether you think they are helpful for you or whether there are too many visualizations for you. You will need this knowledge
          later on in the feedback part. While watching the video, you are supposed to imagine sitting in such an automated vehicle, follow the entire journey attentively,
          and then assess it. Make sure your speakers are turned on.
          </p>
          <p>
          <b>
            Make sure that the video you upload is of a situation involving cars or pedestrians. For example filming the situation on the street, while sitting on the
            passenger seat or standing at an intersection and filming the cars driving by.
            If not your submissions may be disqualified.
          </b>
          </p>
          -->
          <p class="text-start">
              In this study, you will first provide demographic data. Then, you should take a <b>short video</b> (between 1 min and up to 5 min) of a <b>scenario</b> you believe an <b>automated vehicle</b> could have <b>problems managing/dealing with</b>.
              This could be, for example, at a busy intersection or a narrow driveway, on private ground, etc. Your video can include other vehicles and pedestrians.
              This video can be either taken from the <b>passenger's seat of a vehicle</b> or as a <b>pedestrian</b>. (Do NOT take a video while you are driving) You have to upload this video.
              After uploading the video you have to <b>wait for 48 hours</b>, due to the limited computing power of the server. <b>After 48 hours</b> you can <b>come back to this website</b> with the link you originally got.
              You have to <b>enter you unique ID from the first part again</b> and get transferred to the videos and questions. Then, you will see the video twice.
              One time with a visualization showing what an automated vehicle would perceive in this situation, one time without this visualization. Then, you will be asked to assess the video.
              We will check the video, if no traffic scene is shot, you are not eligible for payment. If you want, you will then receive a 5€ voucher.
          </p>
        </div>
      </div>

      <div class="container text-center">
          <div class="row justify-content-center">
              <div class="col-2">
              </div>
              <div class="col-8">
                  <h4>
                      What is your unique id?
                  </h4>
                  <p>
                      You generate your unique id like this: <br>
                      First letter of first name, Day of birth, First letter of last name, Month of birth, First letter of gender, Last two digits of year of birth
                  </p>
                  <p>
                    Here are a few examples:
                  </p>
                  <p>
                    Name: <b>J</b>ohn <b>S</b>mith, Date of birth: <b>20</b>.<b>05</b>.19<b>80</b>, Gender: <b>M</b>ale
                  </p>
                  <p>
                      Unique ID: J20S05M80
                  </p>
                  <p>
                    Name: <b>M</b>aria <b>B</b>raun, Date of birth: <b>10</b>.<b>12</b>.20<b>00</b>, Gender: <b>F</b>emale
                  </p>
                  <p>
                      Unique ID: M10B12F00
                  </p>
                  <p>
                    Name: <b>H</b>ans <b>G</b>eiger, Date of birth: <b>01</b>.<b>02</b>.19<b>99</b>, Gender: <b>N</b>on-<b>B</b>inary
                  </p>
                  <p>
                      Unique ID: H01G02NB99
                  </p>
                  <p>
                    Name: <b>H</b>enry <b>M</b>iller, Date of birth: <b>30</b>.<b>07</b>.19<b>75</b>, Gender: <b>O</b>ther
                  </p>
                  <p>
                      Unique ID: H30M07O75
                  </p>
              </div>
              <div class="col-2">
              </div>
          </div>
          <form action="your_videos.php" method="post" class="row g-3 needs-validation" name="uniqueIDForm" onsubmit="return checkUniqueID()" novalidate>
            <div class="row justify-content-center">
                <div class="col-3">
                </div>
                <div class="col-4">
                    <label for="uniqueIDInput" class="form-label"></label>
                    <input class="form-control" name="uniqueIDInput" id="uniqueIDInput" placeholder="Please enter your unique id..." required>
                </div>
                <div class="col-3">
                </div>
            </div>
              <div class="col-12 justify-content-center d-flex">
                  <input class="btn btn-primary btn-lg" type="submit" name="uniqueIDSubmit" id="uniqueIDSubmit">
              </div>
          </form>
      </div>
<!--
      <div class="text-center my-3">
        <a class="btn btn-primary btn-lg" href="/your_videos.php" role="button" onclick="return checkUniqueID()">Start the survey</a>
      </div>
-->
    </div>
  </section>

  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
  <script>
    const tooltips = document.querySelectorAll('.tt')
    tooltips.forEach(t => {
      new bootstrap.Tooltip(t)
    })
  </script>
  <script>
    function checkUniqueID(){
      let uniqueID = document.forms["uniqueIDForm"]["uniqueIDInput"].value;
      let pattern = "[a-zA-Z]([0][1-9]|[12][0-9]|[3][0-1])[a-zA-Z]([0][1-9]|[1][0-2])([fmoFMO]|([nN][bB]))[0-9]{2}";
      let result = uniqueID.match(pattern);
      if(uniqueID === '' || result === null){
        alert("Please enter a valid unique ID.");
        return false;
      } else {
          if(uniqueID !== result[0]){
              alert("Please enter a valid unique ID.");
              return false;
          }
      }
    }
  </script>
</body>
</html>