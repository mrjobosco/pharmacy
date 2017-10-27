<?php 
if($u->isAdmin())
{
?>
<div id="accordion">
  <h3>Register Users</h3>
  <div>
 <p><a class="btn btn-info btn-block" href="signup.php"> <i class= "fa fa-plus fa-fw"></i> New Patient</a></p>
    <p><a class="btn btn-warning btn-block" href="doctor.php"> <i class= "fa fa-plus fa-fw"></i> New Doctor</a></p>
  <p><a class="btn btn-success btn-block" href="lab_tech.php"> <i class= "fa fa-plus fa-fw"></i> New Scientist</a></p>
  </div>
  <h3>Manage Users</h3>
  <div>
 <p><a class="btn btn-success btn-block modalpage" href="#"> <i class= "fa fa-user fa-fw"></i> Old Doctor</a></p>
 <p><a class="btn btn-info btn-block modalpage" href="#"> <i class= "fa fa-user fa-fw"></i> Old Patient</a></p>
 <p><a class="btn btn-warning btn-block modalpage" href="#"> <i class= "fa fa-users fa-fw"></i> Manage Doctors</a></p>
  </div>
  <h3>My Account</h3>
  <div>
 <p><a class="btn btn-warning btn-block" href="profile.php"> <i class= "fa fa-edit fa-fw"></i> Update Profile</a></p>
 <p><a class="btn btn-warning btn-block" href="changepassword.php"> <i class= "fa fa-user fa-fw"></i> Change Password</a></p>
  </div>
 </div>
 <?php
}
?>


<?php 
if($u->isPatient())
{
?>
<div id="accordion">
  <h3><i class="fa fa-folder-open-o fa-fw"></i> Records</h3>
  <div>
 <p><a class="btn btn-info btn-block" href="record.php?patientId=<?= $u->getPatient()->patientId;?>"> <i class= "fa fa-files-o fa-fw"></i> View Scientist's Report</a></p>
 <p><a class="btn btn-info btn-block" href="record.php?patientId=<?= $u->getPatient()->patientId;?>"> <i class= "fa fa-files-o fa-fw"></i> View Doctor Report</a></p>
  </div>
  <h3><i class="fa fa-gears fa-fw"></i> Settings</h3>
  <div>
<p><a class="btn btn-warning btn-block" href="profile.php"> <i class= "fa fa-edit fa-fw"></i> Update Profile</a></p>
 <p><a class="btn btn-warning btn-block" href="changepassword.php"> <i class= "fa fa-user fa-fw"></i> Change Password</a></p>
  </div>
 </div>
 <?php
}
?>

<?php 
if($u->isDoctor())
{
?>
<div id="accordion">
  <h3>Records</h3>
  <div>
 <p><a class="btn btn-info btn-block modalpage" href="#"> <i class= "fa fa-plus fa-fw"></i> View Patient's Record</a></p>
 <p><a class="btn btn-info btn-block modalpage" href="#"> <i class= "fa fa-user fa-fw"></i> Make Diagnosis</a></p>
  </div>
  <h3>Settings</h3>
  <div>
    <p><a class="btn btn-warning btn-block" href="profile.php"> <i class= "fa fa-plus fa-fw"></i> Update Profile</a></p>
 <p><a class="btn btn-warning btn-block" href="changepassword.php"> <i class= "fa fa-user fa-fw"></i> Change Password</a></p>
  </div>
 </div>
 <?php
}
?>

<?php 
if($u->isLabTech())
{
?>
<div id="accordion">
  <h3>Records</h3>
  <div>
  <p><a class="btn btn-warning btn-block modalpage" href="#"> <i class= "fa fa-plus fa-fw"></i> View Patient's Record</a></p>
  <p><a class="btn btn-warning btn-block modalpage" href="#"> <i class= "fa fa-plus fa-fw"></i> Update Patient's Record</a></p> 
   </div>
  <h3>Settings</h3>
  <div>
  <p><a class="btn btn-warning btn-block" href="profile.php"> <i class= "fa fa-plus fa-fw"></i> Update Profile</a></p>
 <p><a class="btn btn-warning btn-block" href="changepassword.php"> <i class= "fa fa-user fa-fw"></i> Change Password</a></p>
  </div>
 </div>



 <?php
}
?>