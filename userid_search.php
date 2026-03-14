<?php 
include("include/connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User ID Search - Adidravidar Matrimony</title>
    <link rel="stylesheet" href="css/modern-design.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style>
        body { background: #fdfdfd; font-family: 'Inter', sans-serif; }
        .main-container { padding-top: 50px; padding-bottom: 80px; max-width: 1000px; margin: 0 auto; }
        .section-title { font-family: 'Playfair Display', serif; font-size: 32px; font-weight: 700; color: #1b2e1b; text-align: center; margin-bottom: 40px; position: relative; }
        .section-title::after { content: ''; display: block; width: 60px; height: 3px; background: #689f38; margin: 15px auto 0; border-radius: 2px; }
        
        .search-form-card { background: #fff; border-radius: 20px; padding: 35px; box-shadow: 0 15px 45px rgba(0,0,0,0.06); border: 1px solid #f0f0f0; margin-bottom: 40px; }
        .form-label { font-size: 14px; font-weight: 600; color: #444; margin-bottom: 8px; }
        .form-control { padding: 12px 18px; border-radius: 10px; border: 1px solid #e0e0e0; font-size: 15px; transition: 0.3s; }
        .form-control:focus { border-color: #689f38; box-shadow: 0 0 0 4px rgba(104, 159, 56, 0.1); }
        
        .result-profile-card { background: #fff; border-radius: 24px; overflow: hidden; box-shadow: 0 20px 50px rgba(0,0,0,0.08); border: 1px solid #f0f0f0; margin-top: 40px; }
        .profile-banner { background: linear-gradient(135deg, #689f38, #5aab2a); padding: 25px 40px; color: white; display: flex; justify-content: space-between; align-items: center; }
        .profile-banner h3 { font-family: 'Playfair Display', serif; font-size: 24px; margin: 0; }
        .profile-id-tag { background: rgba(255,255,255,0.2); backdrop-filter: blur(5px); padding: 6px 15px; border-radius: 30px; font-size: 14px; font-weight: 600; border: 1px solid rgba(255,255,255,0.3); }
        
        .detail-item { display: flex; align-items: flex-start; margin-bottom: 12px; }
        .detail-icon { width: 32px; height: 32px; background: #f1f8e9; color: #689f38; border-radius: 8px; display: flex; align-items: center; justify-content: center; margin-right: 12px; flex-shrink: 0; }
        .detail-label { font-size: 12px; color: #888; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 2px; }
        .detail-value { font-size: 15px; color: #333; font-weight: 600; }
        
        .profile-img-wrapper { position: relative; border-radius: 18px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1); border: 1px solid #eee; }
        .profile-img-wrapper img { width: 100%; height: auto; display: block; transition: 0.5s; }
        
        .desc-box { background: #f9fbf8; padding: 25px; border-radius: 15px; border-left: 4px solid #689f38; margin-top: 30px; }
        .desc-title { font-size: 14px; font-weight: 700; color: #689f38; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px; display: block; }
    </style>
</head>
<body>

<?php include("include/header.php"); ?>

<div class="container main-container">
    <h1 class="section-title">User ID Search</h1>
    
    <div class="search-form-card">
        <form action="userid_search.php" method="post" onsubmit="return validateSearch();">
            <input type="hidden" name="command" value="search_profile" />
            <div class="row align-items-end g-4">
                <div class="col-md-8">
                    <label class="form-label">Search by User ID</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-person-badge text-success"></i></span>
                        <input type="text" name="user_id" id="user_id" class="form-control border-start-0" placeholder="Enter Member ID (e.g. ADM12345)" value="<?php echo isset($_POST['user_id']) ? htmlspecialchars($_POST['user_id']) : ''; ?>" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <button type="submit" name="submit" class="btn btn-success w-100 py-3 fw-bold rounded-pill">
                        <i class="bi bi-search me-2"></i>Search Profile
                    </button>
                </div>
            </div>
        </form>
    </div>

    <?php
    if(isset($_POST['submit'])) {
        $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
        $result = mysqli_query($con, "SELECT * FROM register WHERE username='$user_id' AND status='1'");
        
        if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_array($result)) {
                $caste_id = $row['religion'];
                $c_q = mysqli_query($con,"SELECT caste FROM caste WHERE id='$caste_id'");
                $c_row = mysqli_fetch_array($c_q);
                $c_name = $c_row['caste'] ?? 'N/A';

                $sub_id = $row['caste'];
                $s_q = mysqli_query($con,"SELECT subcaste FROM subcaste WHERE id='$sub_id'");
                $s_row = mysqli_fetch_array($s_q);
                $s_name = $s_row['subcaste'] ?? 'N/A';
                
                $profile_img = !empty($row['uploadedfile']) ? "profile/".$row['uploadedfile'] : "images/no-photo.png";
                ?>
                <div class="result-profile-card">
                    <div class="profile-banner">
                        <h3><?php echo ucwords($row['name']); ?></h3>
                        <span class="profile-id-tag">Member ID: <?php echo $row['username']; ?></span>
                    </div>
                    <div class="p-5">
                        <div class="row g-5">
                            <div class="col-lg-4">
                                <div class="profile-img-wrapper mb-4">
                                    <img src="<?php echo $profile_img; ?>" alt="Profile">
                                </div>
                                <?php if(!empty($row['horo'])) { ?>
                                    <a href="admin/horo/<?php echo $row['horo']; ?>" class="btn btn-outline-success w-100 py-2 rounded-pill fw-bold" target="_blank">
                                        <i class="bi bi-file-earmark-pdf me-2"></i>View Horoscope
                                    </a>
                                <?php } ?>
                                <button class="btn btn-success w-100 mt-3 py-2 rounded-pill fw-bold" onclick="location.href='paynow.php'">
                                    <i class="bi bi-telephone me-2"></i>Contact Member
                                </button>
                            </div>
                            <div class="col-lg-8">
                                <div class="row">
                                    <div class="col-md-6 border-end">
                                        <div class="detail-item">
                                            <div class="detail-icon"><i class="bi bi-person"></i></div>
                                            <div><p class="detail-label">Gender</p><p class="detail-value"><?php echo ucwords($row['gender']); ?></p></div>
                                        </div>
                                        <div class="detail-item">
                                            <div class="detail-icon"><i class="bi bi-calendar-check"></i></div>
                                            <div><p class="detail-label">Age / DOB</p><p class="detail-value"><?php echo $row['age']; ?> Yrs, <?php echo $row['dob']; ?></p></div>
                                        </div>
                                        <div class="detail-item">
                                            <div class="detail-icon"><i class="bi bi-layers"></i></div>
                                            <div><p class="detail-label">Caste</p><p class="detail-value"><?php echo ucwords($c_name); ?></p></div>
                                        </div>
                                        <div class="detail-item">
                                            <div class="detail-icon"><i class="bi bi-star"></i></div>
                                            <div><p class="detail-label">Star</p><p class="detail-value"><?php echo ucwords($row['star']); ?></p></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 ps-md-4">
                                        <div class="detail-item">
                                            <div class="detail-icon"><i class="bi bi-book"></i></div>
                                            <div><p class="detail-label">Education</p><p class="detail-value"><?php echo ucwords($row['education']); ?></p></div>
                                        </div>
                                        <div class="detail-item">
                                            <div class="detail-icon"><i class="bi bi-briefcase"></i></div>
                                            <div><p class="detail-label">Job & Salary</p><p class="detail-value"><?php echo ucwords($row['job']); ?> (<?php echo $row['salary']; ?>)</p></div>
                                        </div>
                                        <div class="detail-item">
                                            <div class="detail-icon"><i class="bi bi-geo-alt"></i></div>
                                            <div><p class="detail-label">Location</p><p class="detail-value"><?php echo ucwords($row['job_loc']); ?></p></div>
                                        </div>
                                        <div class="detail-item">
                                            <div class="detail-icon"><i class="bi bi-arrows-expand"></i></div>
                                            <div><p class="detail-label">Height</p><p class="detail-value"><?php echo $row['height']; ?></p></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="desc-box">
                                    <span class="desc-title">About Member</span>
                                    <p class="mb-0 text-muted"><?php echo !empty($row['self_desc']) ? nl2br(htmlspecialchars($row['self_desc'])) : 'No additional information shared by this member.'; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo '<div class="alert alert-info mt-5 p-4 rounded-3 border-0 shadow-sm"><i class="bi bi-info-circle me-3"></i>No active profiles found with the Member ID: <strong>'.htmlspecialchars($user_id).'</strong></div>';
        }
    }
    ?>
</div>

<script>
function validateSearch() {
    var id = document.getElementById("user_id").value;
    if(!id.trim()) {
        alert("Please enter a User ID to search");
        return false;
    }
    return true;
}
</script>

<?php include("include/footer.php"); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>