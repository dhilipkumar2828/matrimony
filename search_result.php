<?php
include("include/connect.php");
session_start();
// Helper function to fetch results
function fetchProfiles($con, $filters, $page, $limit) {
    $gender    = isset($filters['gender']) ? $filters['gender'] : 'female';
    $from_age  = isset($filters['age1']) ? $filters['age1'] : 18;
    $to_age    = isset($filters['age2']) ? $filters['age2'] : 60;
    $caste     = isset($filters['caste']) ? $filters['caste'] : '';
    $education = isset($filters['education']) ? $filters['education'] : '';
    $photo     = isset($filters['photo']) ? $filters['photo'] : 2;
    $where = "WHERE gender='$gender' AND age BETWEEN '$from_age' AND '$to_age' AND status='1'";
    if ($caste) $where .= " AND religion='$caste'";
    if ($education) $where .= " AND education LIKE '%$education%'";
    if ($photo == 0) $where .= " AND uploadedfile=''";
    if ($photo == 1) $where .= " AND uploadedfile!=''";
    $total = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS cnt FROM register $where"));
    $total_pages = ceil($total['cnt'] / $limit);
    $start = ($page - 1) * $limit;
    $result = mysqli_query($con, "SELECT * FROM register $where ORDER BY id DESC LIMIT $start, $limit");
    ob_start();
    if (mysqli_num_rows($result) > 0) {
        echo "<div class='pagination'>";
// Previous button
if ($page > 1) {
    echo "<a href='#' data-page='".($page - 1)."' class='prev'>&laquo; Previous</a>";
} else {
    echo "<span class='disabled'>&laquo; Previous</span>";
}
// Determine start and end page numbers
$start = max(1, $page - 2);  // show 2 before current
$end   = min($total_pages, $start + 3); // show 4 pages max
// Adjust start if we're near the end
if ($end - $start < 3) {
    $start = max(1, $end - 3);
}
// Render page numbers
for ($i = $start; $i <= $end; $i++) {
    $active = ($i == $page) ? "class='active-page'" : "";
    echo "<a href='#' data-page='$i' $active>$i</a>";
}
// Next button
if ($page < $total_pages) {
    echo "<a href='#' data-page='".($page + 1)."' class='next'>Next &raquo;</a>";
} else {
    echo "<span class='disabled'>Next &raquo;</span>";
}
echo "</div>";
        while ($row = mysqli_fetch_assoc($result)) {
            $caste1 = $row['religion'];
            $man = mysqli_query($con, "SELECT * FROM caste WHERE id='$caste1'");
            $man11 = mysqli_fetch_array($man);
            $subcaste11 = $row['caste'];
            $man112 = mysqli_query($con, "SELECT * FROM subcaste WHERE id='$subcaste11'");
            $man111 = mysqli_fetch_array($man112);
            echo "
            <table width='100%' style='border:#006699 solid 1px; margin-top:10px; background:#fafafa; border-radius:6px;'>
              <tr>
                <td width='20%' align='right'><strong style='color:#0033FF;'>Name</strong></td>
                <td width='1%'>:</td>
                <td width='28%'><span style='color:#FF0000;'>".ucwords($row['name'] ?? '')."</span></td>
                <td width='22%' align='right'><strong style='color:#0033FF;'>UserId</strong></td>
                <td width='1%'>:</td>
                <td width='28%'><span style='color:#FF0000;'>".ucwords($row['username'] ?? '')."</span></td>
              </tr>
              <tr>
                <td align='right'><strong style='color:#0033FF;'>Date of Birth - Age</strong></td>
                <td>:</td>
                <td><span style='color:#FF0000;'>{$row['dob']} --- {$row['age']}</span></td>
                <td align='right'><strong style='color:#0033FF;'>Time of Birth</strong></td>
                <td>:</td>
                <td><span style='color:#FF0000;'>{$row['tob']}</span></td>
              </tr>
              <tr>
                <td align='right'><strong style='color:#0033FF;'>Caste</strong></td>
                <td>:</td>
                <td><span style='color:#FF0000;'>".ucwords($man11['caste'] ?? '')."</span></td>
                <td align='right'><strong style='color:#0033FF;'>Sub Caste</strong></td>
                <td>:</td>
                <td><span style='color:#FF0000;'>".ucwords($man111['subcaste'] ?? '')."</span></td>
              </tr>
              <tr>
                <td align='right'><strong style='color:#0033FF;'>Star</strong></td>
                <td>:</td>
                <td><span style='color:#FF0000;'>".ucwords($row['star'] ?? '')."</span></td>
                <td align='right'><strong style='color:#0033FF;'>Moonsign</strong></td>
                <td>:</td>
                <td><span style='color:#FF0000;'>".ucwords($row['moonsign'] ?? '')."</span></td>
              </tr>
              <tr>
                <td align='right'><strong style='color:#0033FF;'>Job Details</strong></td>
                <td>:</td>
                <td><span style='color:#FF0000;'>".ucwords($row['job'] ?? '')."</span></td>
                <td align='right'><strong style='color:#0033FF;'>Salary</strong></td>
                <td>:</td>
                <td><span style='color:#FF0000;'>".ucwords($row['salary'] ?? '')."</span></td>
              </tr>
              <tr>
                <td colspan='6' align='center'>
                  <button class='showDialog' data-id='{$row['id']}' style='margin-top:10px; background:#006699; color:white; padding:5px 10px; border:none; border-radius:4px; cursor:pointer;'>View More</button>
                </td>
              </tr>
            </table>";
        }
        echo "<div class='pagination'>";
// Previous button
if ($page > 1) {
    echo "<a href='#' data-page='".($page - 1)."' class='prev'>&laquo; Previous</a>";
} else {
    echo "<span class='disabled'>&laquo; Previous</span>";
}
// Determine start and end page numbers
$start = max(1, $page - 2);  // show 2 before current
$end   = min($total_pages, $start + 3); // show 4 pages max
// Adjust start if we're near the end
if ($end - $start < 3) {
    $start = max(1, $end - 3);
}
// Render page numbers
for ($i = $start; $i <= $end; $i++) {
    $active = ($i == $page) ? "class='active-page'" : "";
    echo "<a href='#' data-page='$i' $active>$i</a>";
}
// Next button
if ($page < $total_pages) {
    echo "<a href='#' data-page='".($page + 1)."' class='next'>Next &raquo;</a>";
} else {
    echo "<span class='disabled'>Next &raquo;</span>";
}
echo "</div>";
    } else {
        echo "<p>No profiles found.</p>";
    }
    return ob_get_clean();
}
// AJAX handler (if request is coming via JS)
if (isset($_GET['ajax']) && $_GET['ajax'] == 1) {
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    echo fetchProfiles($con, $_POST, $page, 5);
    exit;
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
body { font-family: Arial, sans-serif; background:#f4f4f4; margin:0; padding:0; }
.container { max-width: 1000px; margin: 20px auto; background:#fff; padding:20px; border-radius:10px; box-shadow:0 0 6px rgba(0,0,0,0.2); }
h1 { text-align:center; margin-bottom:15px; }
label { font-weight:bold; margin-right:8px; }
select, input[type=radio] { margin:5px 5px 5px 0; }
button, input[type=submit] { background:#006699; color:white; border:none; padding:6px 12px; border-radius:4px; cursor:pointer; }
button:hover, input[type=submit]:hover { background:#004466; }
.profile-card { border:1px solid #ccc; background:#fafafa; border-radius:6px; padding:10px; margin:10px 0; }
.pagination { margin-top: 15px; text-align: center; }
.pagination a { padding: 6px 10px; border: 1px solid #ccc; margin: 2px; text-decoration: none; color: #006699; border-radius: 4px; }
.pagination a.active-page { background: #006699; color: white; font-weight: bold; }
.custom-dialog .ui-dialog-titlebar { background:#006699; color:white; font-weight:bold; }
</style>
</head>
<body>
<div class="container">
    <?php include("include/header.php"); ?>
    <?php include("include/menu.php"); ?>
<!--<h1>Advance Search</h1>-->
<form id="searchForm">
    <input type="hidden" name="command" value="search_profile" />
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr valign="top">
            <td class="p5px10px" width="28%">
                <p class="mb5px">Looking for</p>
                <select class="input w75" name="gender" id="gender" onchange="agelimit(this.value);">
                    <option value="female">Bride</option>
                    <option value="male">Groom</option>
                </select>
            </td>
            <td width="28%" class="p5px10px">
                <p class="mb5px">Age</p>
                <select class="input vam w33" name="age1" id="age1"></select>
                to
                <select class="input vam w33" name="age2" id="age2"></select>
            </td>
            <td class="p5px10px">
                <p class="mb5px">Education</p>
                <select class="input w66" name="education" id="education">
                    <option value="">Select</option>
                    <?php 
                    $eduRes = mysqli_query($con,"SELECT * FROM education WHERE temp_id=1 ORDER BY id DESC");
                    while($row=mysqli_fetch_assoc($eduRes)){
                        echo "<option value='{$row['education']}'>{$row['education']}</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr valign="top">
            <td class="p5px10px">
                <p class="mb5px">Caste</p>
                <select class="input w66" name="caste" id="caste">
                    <option value="">Select</option>
                    <?php
                    $casteRes = mysqli_query($con,"SELECT * FROM caste WHERE temp_id=1 ORDER BY caste ASC");
                    while($row=mysqli_fetch_assoc($casteRes)){
                        echo "<option value='{$row['id']}'>".ucwords($row['caste'])."</option>";
                    }
                    ?>
                </select>
            </td>
            <td class="p5px10px" width="28%">
                <p class="mb5px">Photo</p>
                <input name="photo" type="radio" value="0"/> Without photo 
                <input class="vam" name="photo" type="radio" value="1"> With photo
                <input class="vam" name="photo" type="radio" value="2" checked="checked"> All
            </td>
            <td class="p5px10px">
                <p class="mb5px">&nbsp;</p>
                <input type="submit" class="bt" value="Search Profiles" style='background: url("images/bg.png") no-repeat scroll 0 -960px transparent;
                    border: 0 none; cursor:pointer; color: #FFFFFF; font-weight: bold; height: 25px; margin-bottom: 8px; outline: none; width: 120px;' />
            </td>
        </tr>
    </table>
</form>

<hr>
<div id="profile-results">
    <!-- Results will load here dynamically -->
</div>
</div>
<script>
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
</body>
</html>