<?php
$prolificID = isset($_COOKIE['prolific_id']) ? $_COOKIE['prolific_id'] : '';
echo $prolificID;
?>
<!DOCTYYPE html>
<html>
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

    <title>Chunking Upload Demo</title>
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
            multi_selection: false
            //mime_types: [{title: "Video", extensions: "mp4"}]
          },
          init: {
            PostInit: function () {
              document.getElementById('filelist').innerHTML = '';
            },
            FilesAdded: function (up, files) {
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
              var response = err.response;
              var responseJSON = JSON.parse(response);
              var info = responseJSON.info;
              info = info.join(" ");
              alert(info);
              console.log(err);
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
    <div id="container">
      <span id="pickfiles">[Upload files]</span>
      <button class="btn btn-primary" name="uploadSubmit" id="uploadSubmit">
        Upload
        </button>
    </div>
    
    <div id="filelist">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
    <div class="loader" id="loader" style="display: none"></div>
    <div id="errors"></div>
  </body>
</html>