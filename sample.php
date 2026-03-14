<?php
include('include/connect.php');
$user_id=$_REQUEST['user_id'];
$prod=mysqli_query($con,"select * from register where id='$user_id'");
$usprod=mysqli_fetch_array($prod);

$caste_id = $usprod['religion'];
$caste_query = mysqli_query($con,"select caste from caste where id='$caste_id'");
$caste_data = mysqli_fetch_assoc($caste_query);
$caste_name = $caste_data['caste'] ?? 'N/A';

$subcaste_id = $usprod['caste'];
$subcaste_query = mysqli_query($con,"select subcaste from subcaste where id='$subcaste_id'");
$subcaste_data = mysqli_fetch_assoc($subcaste_query);
$subcaste_name = $subcaste_data['subcaste'] ?? 'N/A';
?>

<div class="profile-details-modal p-3">
    <div class="row mb-4">
        <div class="col-md-6">
            <h4 class="text-success mb-3"><?php echo ucwords($usprod['name']); ?> <small class="text-muted">(<?php echo ucwords($usprod['username']); ?>)</small></h4>
        </div>
        <div class="col-md-6 text-end">
            <span class="badge bg-success py-2 px-3">Age: <?php echo $usprod['age']; ?> Years</span>
            <span class="badge bg-info py-2 px-3"><?php echo ucwords($usprod['gender']); ?></span>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="info-group mb-3">
                <label class="fw-bold text-muted small text-uppercase">Basic Details</label>
                <table class="table table-sm mt-2">
                    <tr><td width="40%">Date of Birth</td><td>: <?php echo $usprod['dob']; ?></td></tr>
                    <tr><td>Time of Birth</td><td>: <?php echo $usprod['tob']; ?></td></tr>
                    <tr><td>Place of Birth</td><td>: <?php echo ucwords($usprod['p_birth']); ?></td></tr>
                    <tr><td>Caste</td><td>: <span class="text-success fw-bold"><?php echo ucwords($caste_name); ?></span></td></tr>
                    <tr><td>Subcaste</td><td>: <?php echo ucwords($subcaste_name); ?></td></tr>
                    <tr><td>Star</td><td>: <?php echo ucwords($usprod['star']); ?></td></tr>
                    <tr><td>Moonsign</td><td>: <?php echo ucwords($usprod['moonsign']); ?></td></tr>
                </table>
            </div>

            <div class="info-group mb-3">
                <label class="fw-bold text-muted small text-uppercase">Education & Career</label>
                <table class="table table-sm mt-2">
                    <tr><td width="40%">Education</td><td>: <?php echo ucwords($usprod['education']); ?></td></tr>
                    <tr><td>Job Details</td><td>: <?php echo ucwords($usprod['job']); ?></td></tr>
                    <tr><td>Salary</td><td>: <span class="text-danger fw-bold"><?php echo ucwords($usprod['salary']); ?></span></td></tr>
                    <tr><td>Job Location</td><td>: <?php echo ucwords($usprod['job_loc']); ?></td></tr>
                </table>
            </div>
        </div>

        <div class="col-md-6">
            <div class="info-group mb-3">
                <label class="fw-bold text-muted small text-uppercase">Family Background</label>
                <table class="table table-sm mt-2">
                    <tr><td width="40%">Father's Name</td><td>: <?php echo ucwords($usprod['fathername']); ?></td></tr>
                    <tr><td>Father's Job</td><td>: <?php echo ucwords($usprod['father_occupation']); ?></td></tr>
                    <tr><td>Mother's Name</td><td>: <?php echo ucwords($usprod['mother_name']); ?></td></tr>
                    <tr><td>Brothers</td><td>: <?php echo $usprod['no_of_brothers']; ?> (<?php echo $usprod['bro_married']; ?> Married)</td></tr>
                    <tr><td>Sisters</td><td>: <?php echo $usprod['no_of_sisters']; ?> (<?php echo $usprod['sis_married']; ?> Married)</td></tr>
                </table>
            </div>

            <div class="info-group mb-3">
                <label class="fw-bold text-muted small text-uppercase">Physical Status</label>
                <table class="table table-sm mt-2">
                    <tr><td width="40%">Height</td><td>: <?php echo ucwords($usprod['height']); ?></td></tr>
                    <tr><td>Skin Color</td><td>: <?php echo ucwords($usprod['skin']); ?></td></tr>
                </table>
            </div>
        </div>
    </div>

    <div class="info-group mt-3">
        <label class="fw-bold text-muted small text-uppercase">Self Description</label>
        <p class="mt-2 p-3 bg-light rounded shadow-sm border-start border-4 border-success">
            <?php echo !empty($usprod['self_desc']) ? ucwords($usprod['self_desc']) : 'No description provided.'; ?>
        </p>
    </div>
</div>

<style>
.profile-details-modal table td { vertical-align: middle; border-bottom: 1px solid #f8f9fa; padding: 8px 0; }
.profile-details-modal label { display: block; border-bottom: 2px solid #689f38; width: fit-content; margin-bottom: 5px; }
</style>