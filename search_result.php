<?php
include("include/connect.php");
session_start();
// Helper function to fetch results
function fetchProfiles($con, $filters, $page, $limit)
{
    $gender = isset($filters['gender']) ? $filters['gender'] : 'female';
    $from_age = isset($filters['age1']) ? $filters['age1'] : 18;
    $to_age = isset($filters['age2']) ? $filters['age2'] : 60;
    $caste = isset($filters['caste']) ? $filters['caste'] : '';
    $education = isset($filters['education']) ? $filters['education'] : '';
    $photo = isset($filters['photo']) ? $filters['photo'] : 2;

    $where = "WHERE gender='$gender' AND age BETWEEN '$from_age' AND '$to_age' AND status='1'";
    if ($caste)
        $where .= " AND religion='$caste'";
    if ($education)
        $where .= " AND education LIKE '%$education%'";
    if ($photo == 0)
        $where .= " AND uploadedfile=''";
    if ($photo == 1)
        $where .= " AND uploadedfile!=''";

    $total_res = mysqli_query($con, "SELECT COUNT(*) AS cnt FROM register $where");
    $total = mysqli_fetch_assoc($total_res);
    $total_pages = ceil($total['cnt'] / $limit);
    $start = ($page - 1) * $limit;
    $result = mysqli_query($con, "SELECT * FROM register $where ORDER BY id DESC LIMIT $start, $limit");

    ob_start();
    if (mysqli_num_rows($result) > 0) {
        // Pagination top
        renderPagination($page, $total_pages);

        while ($row = mysqli_fetch_assoc($result)) {
            $caste_id = $row['religion'];
            $caste_query = mysqli_query($con, "SELECT caste FROM caste WHERE id='$caste_id'");
            $caste_data = mysqli_fetch_assoc($caste_query);
            $caste_name = $caste_data['caste'] ?? 'N/A';

            $subcaste_id = $row['caste'];
            $subcaste_query = mysqli_query($con, "SELECT subcaste FROM subcaste WHERE id='$subcaste_id'");
            $subcaste_data = mysqli_fetch_assoc($subcaste_query);
            $subcaste_name = $subcaste_data['subcaste'] ?? 'N/A';

            $profile_img = !empty($row['uploadedfile']) ? "profile/images/" . $row['uploadedfile'] : "images/no-photo.png";

            echo "
            <div class='profile-result-card mb-4'>
                <div class='row g-0 align-items-center'>
                    <div class='col-md-3 text-center p-3'>
                        <img src='{$profile_img}' class='img-fluid rounded shadow-sm' style='max-height: 180px; width: auto;' alt='Profile'>
                    </div>
                    <div class='col-md-7 p-3'>
                        <div class='row'>
                            <div class='col-sm-6'>
                                <p class='mb-1'><strong>Name:</strong> <span class='text-success'>" . ucwords($row['name'] ?? '') . "</span></p>
                                <p class='mb-1'><strong>Age:</strong> {$row['age']} Years</p>
                                <p class='mb-1'><strong>Caste:</strong> " . ucwords($caste_name) . "</p>
                                <p class='mb-1'><strong>Star:</strong> " . ucwords($row['star'] ?? '') . "</p>
                                <p class='mb-1'><strong>Job:</strong> " . ucwords($row['job'] ?? '') . "</p>
                            </div>
                            <div class='col-sm-6'>
                                <p class='mb-1'><strong>User ID:</strong> <span class='text-danger'>" . ucwords($row['username'] ?? '') . "</span></p>
                                <p class='mb-1'><strong>Time:</strong> {$row['tob']}</p>
                                <p class='mb-1'><strong>Subcaste:</strong> " . ucwords($subcaste_name) . "</p>
                                <p class='mb-1'><strong>Moon:</strong> " . ucwords($row['moonsign'] ?? '') . "</p>
                                <p class='mb-1'><strong>Salary:</strong> {$row['salary']}</p>
                            </div>
                        </div>
                    </div>
                    <div class='col-md-2 p-3 text-center'>
                        <button class='btn btn-success w-100 showDialog' data-id='{$row['id']}'>View More</button>
                    </div>
                </div>
            </div>";
        }

        // Pagination bottom
        renderPagination($page, $total_pages);
    }
    else {
        echo "<div class='alert alert-info text-center'>No profiles found matching your criteria.</div>";
    }
    return ob_get_clean();
}

function renderPagination($page, $total_pages)
{
    echo "<div class='pagination d-flex justify-content-center gap-2 my-4'>";
    // Previous
    if ($page > 1) {
        echo "<a href='#' data-page='" . ($page - 1) . "' class='pagination-link'>&laquo; Previous</a>";
    }

    $start_p = max(1, $page - 2);
    $end_p = min($total_pages, $start_p + 4);
    if ($end_p - $start_p < 4)
        $start_p = max(1, $end_p - 4);

    for ($i = $start_p; $i <= $end_p; $i++) {
        $active = ($i == $page) ? "active-page" : "";
        echo "<a href='#' data-page='$i' class='pagination-link $active'>$i</a>";
    }

    // Next
    if ($page < $total_pages) {
        echo "<a href='#' data-page='" . ($page + 1) . "' class='pagination-link'>Next &raquo;</a>";
    }
    echo "</div>";
}

// AJAX handler
if (isset($_GET['ajax']) && $_GET['ajax'] == 1) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        echo fetchProfiles($con, $_POST, $page, 10);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Advance Search</title>
<link type="text/css" rel="stylesheet" href="css/header-footer.css" />
<link type="text/css" rel="stylesheet" href="css/common.css" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" />
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<style>
body { font-family: 'Inter', sans-serif; background:#f4f7f6; margin:0; padding:0; }
.main-container { max-width: 1100px; margin: 40px auto; background:#fff; padding:30px; border-radius:15px; box-shadow:0 10px 30px rgba(0,0,0,0.05); }
.search-form-card { background: #f8fcf5; padding: 25px; border-radius: 12px; border: 1px solid #e1eed9; margin-bottom: 30px; }
.section-title { font-family: 'Playfair Display', serif; color: #333; font-weight: 700; margin-bottom: 25px; border-bottom: 2px solid #689f38; display: inline-block; padding-bottom: 5px; }

/* Grid tweaks */
.form-label { font-weight: 600; font-size: 14px; color: #555; margin-bottom: 8px; }
.form-select, .form-control { border-radius: 8px; padding: 10px 15px; border: 1px solid #ddd; }

/* Profile Cards */
.profile-result-card { background: #fff; border: 1px solid #eee; border-radius: 12px; transition: 0.3s; overflow: hidden; }
.profile-result-card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.1); border-color: #689f38; }
.profile-result-card p { font-size: 14px; color: #666; }
.profile-result-card strong { color: #333; }

/* Pagination */
.pagination-link { padding: 8px 16px; background: #fff; border: 1px solid #ddd; color: #689f38; text-decoration: none !important; border-radius: 8px; transition: 0.3s; font-weight: 600; }
.pagination-link:hover { background: #689f38; color: #fff; border-color: #689f38; }
.pagination-link.active-page { background: #689f38; color: #fff; border-color: #689f38; }

.custom-dialog .ui-dialog-titlebar { background:#689f38; color:white; font-weight:bold; border: none; border-radius: 8px 8px 0 0; }
</style>
</head>
<body>
<?php include("include/header.php"); ?>
<div class="main-container">
    <div class="search-tabs-container">
        <div class="search-nav-tabs">
            <a href="#" class="search-nav-link active" onclick="switchSearchTab(event, 'advanced')">Advanced Search</a>
            <a href="#" class="search-nav-link" onclick="switchSearchTab(event, 'userid')">User ID Search</a>
        </div>
        
        <div class="search-tab-content">
            <!-- Advanced Search Tab -->
            <div id="advanced-search-tab" class="search-tab-pane">
                <h2 class="search-result-title">Advanced Member Search</h2>
                <form id="searchForm">
                    <input type="hidden" name="command" value="search_profile" />
                    <div class="row g-4">
                        <div class="col-md-4">
                            <label class="form-label">Looking for</label>
                            <select class="form-select" name="gender" id="gender" onchange="agelimit(this.value);">
                                <option value="female">Bride</option>
                                <option value="male">Groom</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Age Range</label>
                            <div class="d-flex align-items-center gap-2">
                                <select class="form-select flex-fill" name="age1" id="age1"></select>
                                <span class="text-muted">to</span>
                                <select class="form-select flex-fill" name="age2" id="age2"></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Education</label>
                            <select class="form-select" name="education" id="education">
                                <option value="">Any Education</option>
                                <?php
$eduRes = mysqli_query($con, "SELECT * FROM education WHERE temp_id=1 ORDER BY id DESC");
while ($row = mysqli_fetch_assoc($eduRes)) {
    echo "<option value='{$row['education']}'>{$row['education']}</option>";
}
?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Caste</label>
                            <select class="form-select" name="caste" id="caste">
                                <option value="">Any Caste</option>
                                <?php
$casteRes = mysqli_query($con, "SELECT * FROM caste WHERE temp_id=1 ORDER BY caste ASC");
while ($row = mysqli_fetch_assoc($casteRes)) {
    echo "<option value='{$row['id']}'>" . ucwords($row['caste']) . "</option>";
}
?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Photo Status</label>
                            <div class="d-flex gap-4 pt-2">
                                <div class="form-check">
                                    <input class="form-check-input" name="photo" type="radio" value="0" id="photoNo">
                                    <label class="form-check-label" for="photoNo">Without</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="photo" type="radio" value="1" id="photoYes">
                                    <label class="form-check-label" for="photoYes">With</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="photo" type="radio" value="2" id="photoAll" checked>
                                    <label class="form-check-label" for="photoAll">All Profiles</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-success w-100 py-2 fw-bold rounded-pill">
                                <i class="bi bi-search me-2"></i>Search Profiles
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- User ID Search Tab -->
            <div id="userid-search-tab" class="search-tab-pane d-none">
                <h2 class="search-result-title">Search by Member ID</h2>
                <form action="userid_search.php" method="post">
                    <input type="hidden" name="command" value="search_profile" />
                    <div class="row align-items-end g-4">
                        <div class="col-md-8">
                            <label class="form-label">Member User ID</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="bi bi-person-badge text-success"></i></span>
                                <input type="text" name="user_id" class="form-control border-start-0" placeholder="e.g. HM123456" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" name="submit" class="btn btn-success w-100 py-2 fw-bold rounded-pill">
                                <i class="bi bi-search me-2"></i>Find Profile
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="profile-results">
        <!-- Results will load here dynamically -->
    </div>
</div>
<script>
// Switch between search tabs
function switchSearchTab(e, tabId) {
    e.preventDefault();
    
    // Update active link
    $('.search-nav-link').removeClass('active');
    $(e.target).addClass('active');
    
    // Show/hide panes
    $('.search-tab-pane').addClass('d-none');
    $('#' + tabId + '-search-tab').removeClass('d-none');
    
    // Clear results if switching to userid
    if(tabId === 'userid') {
        $('#profile-results').empty();
    }
}

// Populate age dropdowns dynamically
function agelimit(gender) {
    let minAge = (gender === 'male') ? 21 : 18;
    let maxAge = 60;
    let age1 = document.getElementById('age1');
    let age2 = document.getElementById('age2');
    age1.innerHTML = ''; age2.innerHTML = '';
    for (let i = minAge; i <= maxAge; i++) {
        let opt1 = new Option(i, i);
        let opt2 = new Option(i, i);
        if (i === 40) opt2.selected = true;
        age1.add(opt1);
        age2.add(opt2);
    }
}
// Load profiles via AJAX
function loadProfiles(page = 1) {
    $.ajax({
        url: "?ajax=1&page=" + page,
        method: "POST",
        data: $("#searchForm").serialize(),
        success: function(data) {
            $("#profile-results").html(data);
            bindActions();
        }
    });
}
// Re-bind events for dynamically loaded content
function bindActions() {
    $(".showDialog").click(function(){
        let userId = $(this).data("id");
        $("<div></div>").dialog({
            modal: true,
            width: 900,
            height: 500,
            title: "Profile Details",
            classes: { "ui-dialog": "custom-dialog" },
            open: function(){
                $(this).html("<p style='text-align:center;'>Loading...</p>");
                // Load full profile details (can be customized)
                $.get("sample.php?user_id=" + userId, function(data){
                    $(".ui-dialog-content").html(data);
                });
            },
            close: function(){
                $(this).dialog("destroy").remove();
            }
        });
    });
    $(".pagination a").click(function(e){
        e.preventDefault();
        let page = $(this).data("page");
        loadProfiles(page);
    });
}
// Handle form submit
$("#searchForm").submit(function(e){
    e.preventDefault();
    loadProfiles(1);
});
// Init on page load
$(document).ready(function(){
    agelimit('female');
    loadProfiles(1);
});
</script>
<?php include("include/footer.php"); ?>
</body>
</html>