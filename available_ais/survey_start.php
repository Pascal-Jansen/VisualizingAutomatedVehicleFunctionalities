
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
    <div class="container-md bg-light">
        <div class="text-center">
            <h1 class="display-2">The survey</h1>
        </div>

        <div id="carouselExampleIndicators" class="carousel carousel-dark slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="15000">
                    <img src="/assets/Video.png" class="d-block w-100" alt="pic1">
                </div>
                <div class="carousel-item" data-bs-interval="15000">
                    <img src="/assets/Fragen.png" class="d-block w-100" alt="pic2">
                </div>
                <div class="carousel-item" data-bs-interval="15000">
                    <img src="/assets/Next.png" class="d-block w-100" alt="pic3">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="row g-4 justify-content-center align-items-center">
            <div class="col-md-5 text-center text-md-start pb-3">
                <p>
                    In the slideshow above you can see how the survey is going. You get to see different videos
                    and answer the corresponding questions after watching the clip.
                </p>
            </div>
        </div>


        <form action="survey_page_one.php" method="post" class="row g-3 needs-validation" name="demographicForm" onsubmit="return validateForm()" novalidate>
            <input type="hidden" name="demo_part" id="demo_part" value="1" />
            <input type="hidden" name="study_part" value="1" />
        
            <div class="row justify-content-center my-3">
                <div class="col text-center">
                    <div class="text-center">
                        <h1 class="display">General Information</h1>
                    </div>
                </div>
            </div>

            <!--
            <div class="col-12 d-flex justify-content-center">
                <div class="col-md-3">
                    <label for="prolificIDInput" class="form-label"></label>
                    <input type="text" class="form-control" name="prolificIDInput" id="prolificIDInput" placeholder="Please enter your Prolific ID" required>
                </div>
            </div>
            


            <div class="row justify-content-center">
                <div class="col text-center">
                    <div class="text-center">
                        <h4>
                            How old are you? (in years)
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-12 d-flex justify-content-center">
                <div class="col-md-3">
                    <label for="ageInput" class="form-label"></label>
                    <input type="number" min="18" step="1" class="form-control" name="ageInput" id="ageInput" placeholder="Please enter your age (in years)" required>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col text-center">
                    <div class="text-center">
                        <h4>
                            What gender do you identify yourself with?
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-12 d-flex justify-content-center">
                <div class="col-md-3">
                    <label for="genderSelect" class="form-label"></label>
                    <select class="form-select" name="genderSelect" id="genderSelect" aria-label="Default select example" required>
                        <option value="0" selected>Please choose...</option>
                        <option value="1">Female</option>
                        <option value="2">Male</option>
                        <option value="3">Non-binary</option>
                        <option value="4">Prefer not to tell</option>
                    </select>
                </div>
            </div>
            -->

            

            <div class="container text-start">
                <div class="row justify-content-start">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <h4>
                            How old are you? (in years)
                        </h4>
                    </div>
                    <div class="col-3">
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-3">
                    </div>
                    <div class="col-4">
                        <label for="ageInput" class="form-label"></label>
                        <input type="number" min="18" step="1" class="form-control" name="ageInput" id="ageInput" placeholder="Please enter your age (in years)" required>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
            </div>

            <div class="container text-start">
                <div class="row justify-content-start">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <h4>
                            What gender do you identify yourself with?
                        </h4>
                    </div>
                    <div class="col-3">
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-3">
                    </div>
                    <div class="col-4">
                        <label for="genderSelect" class="form-label"></label>
                        <select class="form-select" name="genderSelect" id="genderSelect" aria-label="Default select example" required>
                            <option value="0" selected>Please choose...</option>
                            <option value="Female">Female</option>
                            <option value="Male">Male</option>
                            <option value="Non-binary">Non-binary</option>
                            <option value="Prefer not to tell">Prefer not to tell</option>
                        </select>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
            </div>

            <div class="container text-start">
                <div class="row justify-content-start">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <h4>
                            What is your highest educational level?
                        </h4>
                    </div>
                    <div class="col-3">
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-3">
                    </div>
                    <div class="col-4">
                        <label for="eduSelect" class="form-label"></label>
                        <select class="form-select" name="eduSelect" id="eduSelect" aria-label="Default select example" required>
                            <option value="0" selected>Please choose...</option>
                            <option value="Secondary school">Secondary school</option>
                            <option value="Middle school">Middle school</option>
                            <option value="High school">High school</option>
                            <option value="College">College</option>
                            <option value="Vocational Training">Vocational training</option>
                        </select>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
            </div>

            <div class="container text-start">
                <div class="row justify-content-start">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <h4>
                            What is the best way to describe your professional status?
                        </h4>
                    </div>
                    <div class="col-3">
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-3">
                    </div>
                    <div class="col-4">
                        <label for="proStatusSelect" class="form-label"></label>
                        <select class="form-select" name="proStatusSelect" id="proStatusSelect" aria-label="Default select example" required>
                            <option value="0" selected>Please choose...</option>
                            <option value="Student (school)">Student (school)</option>
                            <option value="Student (college)">Student (college)</option>
                            <option value="Employee">Employee</option>
                            <option value="Self-employed">Self-employed</option>
                            <option value="Jobseeker">Jobseeker</option>
                            <option value="other">other</option>
                        </select>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
            </div>

            <div class="container text-start">
                <div class="row justify-content-start">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <h4>
                            How long do you have a driving license? (in years)
                        </h4>
                    </div>
                    <div class="col-3">
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-3">
                    </div>
                    <div class="col-4">
                        <label for="drivingLicenseInput" class="form-label"></label>
                        <input type="number" min="0" step="1" class="form-control" name="drivingLicenseInput" id="drivingLicenseInput" placeholder="Please enter..." required>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
            </div>

            <div class="container text-start">
                <div class="row justify-content-start">
                    <div class="col-3">
                    </div>
                    <div class="col-9">
                        <h4>
                            How often do you drive a car/motorcycle/scooter or similar?
                        </h4>
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-3">
                    </div>
                    <div class="col-4">
                        <label for="drivingFreqSelect" class="form-label"></label>
                        <select class="form-select" name="drivingFreqSelect" id="drivingFreqSelect" aria-label="Default select example" required>
                            <option value="0" selected>Please choose...</option>
                            <option value="Daily">Daily</option>
                            <option value="on working days">on working days</option>
                            <option value="3-4 times a week">3-4 times a week</option>
                            <option value="1 time a week">1 time a week</option>
                            <option value="1-3 times a month">1-3 times a month</option>
                            <option value="less than 1 time a month">less than 1 time a month</option>
                        </select>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
            </div>

            <div class="container text-start">
                <div class="row justify-content-start">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <h4>
                            How many kilometers did you drive by car last year?
                        </h4>
                    </div>
                    <div class="col-3">
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-3">
                    </div>
                    <div class="col-4">
                        <label for="drivingDistSelect" class="form-label"></label>
                        <select class="form-select" name="drivingDistSelect" id="drivingDistSelect" aria-label="Default select example" required>
                            <option value="0" selected>Please choose...</option>
                            <option value="less than 7.000 km">less than 7.000 km</option>
                            <option value="7.000 - 14.999 km">7.000 - 14.999 km</option>
                            <option value="15.000 - 24.999 km">15.000 - 24.999 km</option>
                            <option value="25.000 - 32.999 km">25.000 - 32.999 km</option>
                            <option value="33.000 km or more">33.000 km or more</option>
                        </select>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
            </div>

            <div class="row justify-content-center mt-3">
                <div class="col text-center">
                    <div class="text-center">
                        <h1 class="display">Interest in autonomous driving</h1>
                    </div>
                </div>
            </div>
            <div class="container text-start">
                <div class="row justify-content-start">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <h4>
                            I am interested in autonomous driving.
                        </h4>
                    </div>
                    <div class="col-3">
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-3">
                    </div>
                    <div class="col-4">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="IntAutoDriveQuestion1" id="inlineRadio1" value="1" required>
                            <label class="form-check-label" for="inlineRadio1">Not at all</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="IntAutoDriveQuestion1" id="inlineRadio2" value="2" required>
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="IntAutoDriveQuestion1" id="inlineRadio3" value="3" required>
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="IntAutoDriveQuestion1" id="inlineRadio4" value="4" required>
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="IntAutoDriveQuestion1" id="inlineRadio5" value="5" required>
                            <label class="form-check-label" for="inlineRadio5">Definitely</label>
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
            </div>

            <div class="container text-start">
                <div class="row justify-content-start">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <h4>
                            I think that autonomous driving will make life easier.
                        </h4>
                    </div>
                    <div class="col-3">
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-3">
                    </div>
                    <div class="col-4">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="IntAutoDriveQuestion2" id="inlineRadio1" value="1" required>
                            <label class="form-check-label" for="inlineRadio1">Not at all</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="IntAutoDriveQuestion2" id="inlineRadio2" value="2" required>
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="IntAutoDriveQuestion2" id="inlineRadio3" value="3" required>
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="IntAutoDriveQuestion2" id="inlineRadio4" value="4" required>
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="IntAutoDriveQuestion2" id="inlineRadio5" value="5" required>
                            <label class="form-check-label" for="inlineRadio5">Definitely</label>
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
            </div>

            <div class="container text-start">
                <div class="row justify-content-start">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <h4>
                            I think that autonomous driving will become reality in the next 10 years (until 2032).
                        </h4>
                    </div>
                    <div class="col-3">
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col-3">
                    </div>
                    <div class="col-4">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="IntAutoDriveQuestion3" id="inlineRadio1" value="1" required>
                            <label class="form-check-label" for="inlineRadio1">Not at all</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="IntAutoDriveQuestion3" id="inlineRadio2" value="2" required>
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="IntAutoDriveQuestion3" id="inlineRadio3" value="3" required>
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="IntAutoDriveQuestion3" id="inlineRadio4" value="4" required>
                            <label class="form-check-label" for="inlineRadio4">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="IntAutoDriveQuestion3" id="inlineRadio5" value="5" required>
                            <label class="form-check-label" for="inlineRadio5">Definitely</label>
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
            </div>

            <div class="col-12 justify-content-center d-flex">
                <input class="btn btn-primary" type="submit" name="demographicSubmit" id="demographicSubmit">
            </div>
        </form>


<!--        <div class="text-center my-3">-->
<!--            <a class="btn btn-primary btn-lg" href="survey_page_one.php" role="button">Start the survey</a>-->
<!--        </div>-->
        <div class="progress" style="height: 20px;">
            <div class="progress-bar" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">20%</div>
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

<script>
    function validateForm() {
        //let prolID = document.forms["demographicForm"]["prolificIDInput"].value;
        let ageInput = document.forms["demographicForm"]["ageInput"].value;
        let genderSelect = document.forms["demographicForm"]["genderSelect"].value;
        let eduSelect = document.forms["demographicForm"]["eduSelect"].value;
        let proStatusSelect = document.forms["demographicForm"]["proStatusSelect"].value;
        let drivingLicenseInput = document.forms["demographicForm"]["drivingLicenseInput"].value;
        let drivingFreqSelect = document.forms["demographicForm"]["drivingFreqSelect"].value;
        let drivingDistSelect = document.forms["demographicForm"]["drivingDistSelect"].value;
        let IADQ1 = document.forms["demographicForm"]["IntAutoDriveQuestion1"].value;
        let IADQ2 = document.forms["demographicForm"]["IntAutoDriveQuestion2"].value;
        let IADQ3 = document.forms["demographicForm"]["IntAutoDriveQuestion3"].value;
        let re = new RegExp("^([a-zA-Z0-9]{24,})$")
        if (//prolID === "" ||
            ageInput === "" || genderSelect === "0" || eduSelect === "0" || proStatusSelect === "0"
            || drivingLicenseInput === "" || drivingFreqSelect === "0" || drivingDistSelect === "0"
            || IADQ1 === "" || IADQ2 === "" || IADQ3 === "") {
            alert("Please answer all the questions.");
            return false;
        //} else if(!re.demographicForm(prolID)){
        //    alert("Please enter a correct, 24 character long Prolific ID");
        //    return false;
        }
    }
</script>
</body>
</html>