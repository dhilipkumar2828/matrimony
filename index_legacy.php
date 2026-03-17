<?php
include("include/connect.php");
?>
<?php
if (isset($_POST['submit'])) {
    $command = $_POST['command'];
    $gender = $_POST['gender'];
    $from_age = $_POST['age1'];
    $to_age = $_POST['age2'];
    $caste = $_POST['caste'];
    $education = $_POST['education'];
    $photo = $_POST['photo'];
    session_start();
    $_SESSION['gender'] = $gender;
    $_SESSION['from_age'] = $from_age;
    $_SESSION['to_age'] = $to_age;
    $_SESSION['caste'] = $caste;
    $_SESSION['education'] = $education;
    $_SESSION['command'] = $command;
    $_SESSION['photo'] = $photo;
    echo "<script language='javascript'>window.location='search_result.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Adidravidar Matrimony in Chennai | Adidravidar Matrimony</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href="icons8-home-24.png">
    <link rel="stylesheet" href="css/modern-design.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <script type="text/javascript">
        if (screen.width <= 699) {
            document.location = "indexmob.php";
        }
    </script>
    <script type="text/javascript">
        function getXMLHTTP() {
            var xmlhttp = false;
            try { xmlhttp = new XMLHttpRequest(); }
            catch (e) {
                try { xmlhttp = new ActiveXObject("Microsoft.XMLHTTP"); }
                catch (e) {
                    try { xmlhttp = new ActiveXObject("Msxml2.XMLHTTP"); }
                    catch (e1) { xmlhttp = false; }
                }
            }
            return xmlhttp;
        }
        function valid() {
            var strURL = "valid_exp.php";
            var req = getXMLHTTP();
            if (req) {
                req.onreadystatechange = function () {
                    if (req.readyState == 4) {
                        if (req.status == 200) {
                            // Handle potential response if needed
                        }
                    }
                }
                req.open("GET", strURL, true);
                req.send(null);
            }
        }
        function validlogin() {
            var x = document.getElementById("username").value;
            if (x == "null" || x == "") { alert("Please Enter Username"); return false; }
            var y = document.getElementById("password").value;
            if (y == "null" || y == "") { alert("Please Enter Password"); return false; }
            return true;
        }
        function agelimit(gender) {
            var minAge = (gender == 'male') ? 21 : 18;
            var age1 = document.getElementById('age1');
            var age2 = document.getElementById('age2');
            var currentAge1 = age1.value;

            age1.innerHTML = '<option value="">Min Age</option>';
            for (var i = minAge; i <= 60; i++) {
                var opt = document.createElement('option');
                opt.value = i;
                opt.innerHTML = i;
                if (i == currentAge1) opt.selected = true;
                age1.appendChild(opt);
            }
            updateMaxAge();
        }

        function updateMaxAge() {
            var age1 = document.getElementById('age1');
            var age2 = document.getElementById('age2');
            var selectedAge1 = parseInt(age1.value);

            if (!isNaN(selectedAge1)) {
                var currentAge2 = age2.value;
                age2.innerHTML = '<option value="">Max Age</option>';
                for (var i = selectedAge1 + 1; i <= 60; i++) {
                    var opt = document.createElement('option');
                    opt.value = i;
                    opt.innerHTML = i;
                    if (i == currentAge2) opt.selected = true;
                    age2.appendChild(opt);
                }
            } else {
                age2.innerHTML = '<option value="">Max Age</option>';
                for (var i = 18; i <= 60; i++) {
                    var opt = document.createElement('option');
                    opt.value = i;
                    opt.innerHTML = i;
                    age2.appendChild(opt);
                }
            }
        }
    </script>
</head>

<body onload="valid()">
    <!-- nav bar section -->
    <?php include("include/header.php"); ?>

    <!-- banner from section -->
    <div class="hero-section">
        <div class="backgroundimg"
            style="background-image: url('image/WhatsApp Image 2026-03-03 at 10.45.50 PM.jpeg');"></div>
        <div class="hero-overlay"></div>

        <div class="hero-text-container">
            <h1>Find Your Perfect<br><span>Life Partner</span></h1>
            <p>Trusted matrimony service helping families find meaningful connections.</p>
        </div>

        <form class="register-form" name="topsearch" id="topsearch" method="post" action="index.php">
            <input type="hidden" name="command" id="command" value="searchby">
            <h2 class="mb-3">Find <span>Your Match</span></h2>

            <!-- Row 1: Gender -->
            <div class="form-row">
                <label class="form-label-custom">Looking for</label>
                <select name="gender" onchange="agelimit(this.value);">
                    <option value="female" selected>Bride</option>
                    <option value="male">Groom</option>
                </select>
            </div>

            <!-- Row 2: Age Range -->
            <div class="form-row">
                <label class="form-label-custom">Age Range</label>
                <div class="d-flex gap-2">
                    <select name="age1" id="age1" class="flex-fill" onchange="updateMaxAge()">
                        <option value="">Min Age</option>
                        <?php for ($i = 18; $i <= 60; $i++) {
                            echo "<option value='$i'>$i</option>";
                        } ?>
                    </select>
                    <select name="age2" id="age2" class="flex-fill">
                        <option value="">Max Age</option>
                        <?php for ($i = 18; $i <= 60; $i++) {
                            echo "<option value='$i'>$i</option>";
                        } ?>
                    </select>
                </div>
            </div>

            <!-- Row 3: Caste & Education -->
            <div class="form-row">
                <label class="form-label-custom">Caste & Education</label>
                <div class="d-flex gap-2">
                    <select name="caste" id="caste" onchange="getcity(this.value);" class="flex-fill">
                        <option value="">Select Caste</option>
                        <?php
                        $man = mysqli_query($con, "select * from caste where temp_id=1 order by caste asc");
                        while ($man1 = mysqli_fetch_array($man)) {
                            echo "<option value='" . $man1['id'] . "'>" . ucwords($man1['caste']) . "</option>";
                        }
                        ?>
                    </select>

                    <select name="education" id="education" class="flex-fill">
                        <option value="">Select Education</option>
                        <?php
                        $kal = mysqli_query($con, "select * from education where temp_id=1 order by id desc");
                        while ($kal11 = mysqli_fetch_array($kal)) {
                            echo "<option value='" . $kal11['education'] . "'>" . $kal11['education'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <!-- Row 4: Photo Status -->
            <div class="form-row">
                <label class="form-label-custom">Photo Status</label>
                <div class="photo-status-group">
                    <label class="m-0 cursor-pointer"><input type="radio" name="photo" value="1" class="vam me-1"> With
                        Photo</label>
                    <label class="m-0 cursor-pointer"><input type="radio" name="photo" value="0" class="vam me-1">
                        Without</label>
                    <label class="m-0 cursor-pointer"><input type="radio" name="photo" value="2" checked
                            class="vam me-1"> All</label>
                </div>
            </div>

            <button type="submit" name="submit" class="btn btn-success w-100 py-2 fw-bold mt-2">
                <i class="bi bi-search me-2"></i>Find Matches
            </button>
            <div class="text-center mt-1">
                <a href="govt_search.php"
                    style="color: #689f38; text-decoration: none; font-size: 13px; font-weight: 600;">Government
                    Search</a>
            </div>
        </form>
    </div>

    <!-- Feature Section -->
    <section class="feature-section">
        <div class="container">
            <div class="feature-card-tittle">
                <p class="text-center">MORE THAN 25 YEARS OF</p>
                <h2 class="text-center">
                    Bringing People <span>Together</span>
                </h2>
            </div>

            <div class="row justify-content-center mt-5">
                <!-- CARD 1 -->
                <div class="col-lg-4 col-md-6 col-sm-12 mb-5">
                    <div class="feature-card">
                        <div class="icon-box">
                            <img src="image/Screened Profiles.png" alt="Screened Profiles">
                        </div>
                        <h4>100% Screened Profiles</h4>
                        <p>Search by location, community, profession & more from lakhs of active profiles</p>
                    </div>
                </div>

                <!-- CARD 2 -->
                <div class="col-lg-4 col-md-6 col-sm-12 mb-5">
                    <div class="feature-card">
                        <div class="icon-box icon-2">
                            <img src="image/Verifications by Personal Visit.png" alt="Verification">
                        </div>
                        <h4>Verifications by Personal Visit</h4>
                        <p>Special listing for profiles verified by our agents through personal visits</p>
                    </div>
                </div>

                <!-- CARD 3 -->
                <div class="col-lg-4 col-md-6 col-sm-12 mb-5">
                    <div class="feature-card">
                        <div class="icon-box icon-3">
                            <img src="image/Control over Privacy.png" alt="Privacy">
                        </div>
                        <h4>Control over Privacy</h4>
                        <p>Restrict unwanted access to contact details & photos/videos</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Membership Plan Card -->
    <section class="plans-section">
        <h2 class="plan-heading">Choose Your <span>Membership Plan</span></h2>
        <div class="plan-container">
            <!-- Silver -->
            <div class="plan-card silver">
                <h3>Silver Plan</h3>
                <p class="price">₹3,000</p>
                <ul>
                    <li><i class="bi bi-check-circle-fill"></i> 6 Months Validity</li>
                    <li><i class="bi bi-check-circle-fill"></i> Verified Profiles</li>
                    <li><i class="bi bi-check-circle-fill"></i> Multiple Contact Views</li>
                </ul>
                <button onclick="location.href='paynow.php?plan_id=1'">Choose Plan</button>
            </div>

            <!-- Platinum -->
            <div class="plan-card platinum">
                <h3>Platinum Plan</h3>
                <p class="price">₹7,000</p>
                <ul>
                    <li><i class="bi bi-check-circle-fill"></i> Upto Marriage</li>
                    <li><i class="bi bi-check-circle-fill"></i> Unlimited Views</li>
                    <li><i class="bi bi-check-circle-fill"></i> Dedicated Manager</li>
                </ul>
                <button onclick="location.href='paynow.php?plan_id=3'">Choose Plan</button>
            </div>

            <!-- Gold -->
            <div class="plan-card gold">
                <h3>Gold Plan</h3>
                <p class="price">₹4,000</p>
                <ul>
                    <li><i class="bi bi-check-circle-fill"></i> 1 Year Validity</li>
                    <li><i class="bi bi-check-circle-fill"></i> Enhanced Matches</li>
                    <li><i class="bi bi-check-circle-fill"></i> Priority Support</li>
                </ul>
                <button onclick="location.href='paynow.php?plan_id=2'">Choose Plan</button>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 video-box">
                    <iframe src="https://www.youtube.com/embed/t2mlL7K1hbs" frameborder="0" allowfullscreen></iframe>
                </div>
                <div class="col-lg-6 content-box">
                    <div class="video-heading">
                        <h2>About Our <span>Matrimony Service</span></h2>
                    </div>
                    <p>Aadithiravidar Matrimony is a trusted platform helping families find the perfect life partner
                        within the community.</p>
                    <div class="features-list">
                        <ul>
                            <li><i class="bi bi-check-circle-fill"></i> Verified Profiles</li>
                            <li><i class="bi bi-check-circle-fill"></i> Community Based Matches</li>
                            <li><i class="bi bi-check-circle-fill"></i> Easy Registration</li>
                            <li><i class="bi bi-check-circle-fill"></i> Secure Communication</li>
                        </ul>
                    </div>
                    <a href="register_user.php" class="btn btn-success">Register Now</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Mobile App Section -->
    <section class="mobile-app-section">
        <div class="app-inner container">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-12">
                    <div class="mobile-section-heading">
                        <p class="small-title">Mobile App</p>
                        <h2 class="main-title">Find Your Perfect Match<br><span>Anytime, Anywhere</span></h2>
                        <p class="app-description">Browse verified profiles, send interests, and connect with your ideal
                            partner easily through our mobile app.</p>
                    </div>

                    <div class="stats-row">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="bi bi-download"></i>
                            </div>
                            <div class="stat-info">
                                <h3>5000+</h3>
                                <p>Downloads</p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon" style="background: #fff8e1; color: #fbbc04;">
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <div class="stat-info">
                                <h3>4.8</h3>
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="store-buttons">
                        <a href="#" class="store-btn">
                            <div class="store-icon google">
                                <i class="bi bi-google-play"></i>
                            </div>
                            <div class="btn-text">
                                <small>Get it on</small>
                                <strong>Google Play</strong>
                            </div>
                        </a>
                        <a href="#" class="store-btn">
                            <div class="store-icon apple">
                                <i class="bi bi-apple"></i>
                            </div>
                            <div class="btn-text">
                                <small>Download on the</small>
                                <strong>App Store</strong>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-5 col-md-12 d-none d-lg-flex justify-content-center">
                    <img src="image/app screen.svg" style="width: 100%; height: 55%; object-fit: cover;"
                        alt="App Interface">

                </div>
            </div>
        </div>
        </div>
    </section>

    <!-- Footer Section -->
    <?php include("include/footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="js/main.js"></script>
    <script>
        AOS.init({ duration: 1000, once: true });
    </script>
</body>

</html>