<?php
// require_once("init.php");

$conn = mysqli_connect('localhost', 'root', '', 'amskier');
if(!$conn){
	die("Connection failed!");
}
//mysql_connect('localhost','websql','hawley1');
//mysql_select_db('Pais');
// $mysql = new mysqli("localhost","websql","hawley1","Pais");

// $show_debug = 0;
// if ($_SERVER["REMOTE_ADDR"] == "207.237.37.190") {
// 	$show_debug = 1;
// }

$formdata = array();
$isUpdate = false;
$formdata['bandaid1'] = -1;
$formdata['bandaid2'] = -1;
$formdata['bandaid3'] = -1;
$formdata['bandaid4'] = -1;


$bodyPartSide = array('Left','Right','N/A');

// if (isset($_GET['update']) && !empty($_GET['update'])) {
	// mysql_connect('localhost','websql','hawley1');
	// mysql_select_db('Pais');
	$conn = mysqli_connect('localhost', 'root', '', 'amskier');
	// $update = addslashes($_GET['update']);
	// $query = "SELECT * FROM dbo_ClaimsWC WHERE ClaimsWCID='$update'";
	$query = "SELECT * FROM dbo_ClaimsWC";
	$result = $conn->query($query);
	if ($result->num_rows > 0) {
		$row = $result->fetch_object();
		// if ($row->AccID == $_SESSION['AMSKIER']['authAccId']) {
			$isUpdate = true;
			$updateRow = $row;
			$formdata['campName'] = $row->CampName;
			// if (empty($row->CampName)) {
			// 	$formdata['campName'] = $_SESSION['AMSKIER']['campName'];
			// }
			// $formdata['campLocation'] = $row->CampLocationID;
			// if (empty($row->CampLocationID)) {
			// 	$lid = $_SESSION['AMSKIER']['campLocationID'];
			// 	$formdata['campLocation'] = $_SESSION['AMSKIER']['locations'][$lid];
			// }
			$formdata['firstName'] = $row->EEFirstName;
			$formdata['lastName'] = $row->EELastName;
			$formdata['jobTitle'] = $row->EEJob;
			$formdata['numDependents'] = $row->EEDependents;
			$formdata['address'] = $row->EEAddress;
			$formdata['city'] = $row->EECity;
			$formdata['state'] = $row->EEState;
			$formdata['zip'] = $row->EEZip;
			$formdata['phone'] = $row->EEPhone;
			if ($row->EEHireDate == '0000-00-00 00:00:00') {
				$formdata['dateOfHire'] = '';
			}
			else {
				$formdata['dateOfHire'] = date('Y-m-d', strtotime($row->EEHireDate));
			}
			if ($row->EEMale == 1) { $formdata['gender'] = 'Male'; }
			else if ($row->EEFemale == 1) { $formdata['gender'] = 'Female'; }
			if ($row->EEDOB == '0000-00-00 00:00:00' || empty($row->EEDOB)) { $formdata['dobMonth'] = ''; $formdata['dobDay'] = ''; $formdata['dobYear'] = ''; }
			else {
				$formdata['dobMonth'] = date('n', strtotime($row->EEDOB));
				$formdata['dobDay'] = date('j', strtotime($row->EEDOB));
				$formdata['dobYear'] = date('Y', strtotime($row->EEDOB));
			}
			$formdata['ssn'] = $row->EESocial;
			$formdata['workDaysPerWeek'] = $row->EEWorkPerWeek;
			$formdata['avgEarningsPerWeek'] = $row->AvgEarnings;
			if ($row->EEMarried == 1) { $formdata['maritalStatus'] = 'Married'; }
			else if ($row->EESingle == 1) { $formdata['maritalStatus'] = 'Single'; }
			if ($row->StaffUS == 1) { $formdata['international'] = 'No'; }
			else if ($row->StaffIntl == 1) { $formdata['international'] = 'Yes'; }
			$formdata['agency'] = $row->IntStaffAgency;
			$formdata['employed'] = $row->EmployStatus;
			$formdata['injuryLocation'] = $row->InjLocationWhere;
			$formdata['injuryCause'] = $row->CauseDes;
			$formdata['injuryBodyPart'] = $row->BodyPartDes;
			$formdata['injuryBodyPartSide'] = $row->BodyPartSide;
			$formdata['injuryType'] = $row->InjuryDes;
			$formdata['illnessType'] = $row->IllnessDes;
			$formdata['activityType'] = $row->ActivityDes;
			$formdata['accidentDate'] = date('Y-m-d', strtotime($row->InjuryDate));
			$formdata['accidentTime'] = $row->InjuryTime;
			if ($row->DateRec == '0000-00-00' || $row->DateRec == '0000-00-00 00:00:00' || empty($row->DateRec)) { $formdata['accidentReportDate'] = ''; }
			else { $formdata['accidentReportDate'] = date('Y-m-d', strtotime($row->DateRec)); }
			if ($row->LastDayWorked == '0000-00-00' || $row->LastDayWorked == '0000-00-00 00:00:00' || empty($row->LastDayWorked)) { $formdata['dateStoppedWork'] = ''; }
			else { $formdata['dateStoppedWork'] = date('Y-m-d', strtotime($row->LastDayWorked)); }
			if ($row->ReturnDate == '0000-00-00' || $row->ReturnDate == '0000-00-00 00:00:00' || empty($row->ReturnDate)) { $formdata['dateReturned'] = ''; }
			else { $formdata['dateReturned'] = date('Y-m-d', strtotime($row->ReturnDate)); }
			$formdata['timeReturned'] = $row->TimeBeganWork;
			$formdata['unsafeAct'] = $row->UnsafeAct;
			$formdata['accidentAtCamp'] = $row->AccdAtCamp;
			$formdata['doingWhenInjured'] = $row->DoingWhenInjured;
			$formdata['outsideAddress'] = $row->AccidentAdd;
			$formdata['injuryObject'] = $row->EquipUsed;
			if ($row->FullPayYes == 1) { $formdata['staffPaid'] = 'Yes'; }
			else if ($row->FullPayNo == 1) { $formdata['staffPaid'] = 'No'; }
			$formdata['howOccured'] = $row->InjuryDesc;
			if ($row->CareProvidedYes == 1) { $formdata['campMedicalCare'] = 'Yes'; }
			else if ($row->CareProvidedNo == 1) { $formdata['campMedicalCare'] = 'No'; }
			$formdata['whereTreated'] = $row->HospName;
			$formdata['campMedicalCareDetail'] = $row->HospNameNote;
			$formdata['notes'] = $row->Notes;
			$formdata['bandaid1'] = $row->BA1;
			$formdata['bandaid2'] = $row->BA2;
			$formdata['bandaid3'] = $row->BA3;
			$formdata['bandaid4'] = $row->BA4;
			$formdata['sb_firstName'] = $row->whoFirstName;
			$formdata['sb_lastName'] = $row->whoLastName;
			$formdata['sb_title'] = $row->whoTitle;
			
			$formdata['FirstAid'] = $row->FirstAid;
			$formdata['severity'] = $row->Severity;
			$formdata['Featured'] = $row->Featured;
			$formdata['ReportOnly'] = $row->ReportOnly;
		// }
	}
// }
// else {
// 	$formdata['campName'] = $_SESSION['AMSKIER']['campName'];
// 	$lid = $_SESSION['AMSKIER']['campLocationID'];
// 	$formdata['campLocation'] = $_SESSION['AMSKIER']['locations'][$lid];
// }

// include("workers_comp_data.php");
//print "<!-- \n";
//print_r($formdata);
//print "\n -->\n";
?>
<!DOCTYPE html>
<html>
<head>
<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>
<!-- <link rel="stylesheet" href="../includes/css/Aristo/Aristo.css" type="text/css" charset="utf-8" /> -->
<link rel="stylesheet" href="../includes/fonts/Aller/stylesheet.css" type="text/css" />
<!-- <link rel="stylesheet" href="../includes/bootstrap/css/bootstrap.min.css" type="text/css" /> -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<link rel="stylesheet" href="../includes/fonts/BebasNeue/stylesheet.css" type="text/css" />
<link rel="stylesheet" href="../includes/fonts/Roboto/roboto_boldcondensed_macroman/stylesheet.css" type="text/css" />
<link rel="stylesheet" href="../includes/css/amskier.css" type="text/css" />
<meta name="viewport" content = "width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
<title>AMSkier - Members Only - Workers Compensation Report</title>
<style type="text/css">
#debug {
	position: fixed;
	top: 0;
	left: 0;
	background: #000;
	color: #0F0;
	padding: 8px;
	font-family: Menlo, Monaco, monospace;
	border: 1px solid #090;
	z-index: 90;
}
.page-warning {
	color: #900;
	text-align: center;
	width: 85%;
	max-width: 800px;
	margin: 0 auto;
	font-weight: bold;
}
.wc-subheader {
	margin: 0 0 10px 20px;
	font-family: 'AllerBoldItalic', sans-serif;
	font-size: 1.4em;
	color: #1423ff;
}
#content_wrapper {
	margin: 0 auto;
}      
</style>

<!-- <script type="text/javascript" src="../includes/jquery.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js" integrity="sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- <script type="text/javascript" src="../includes/jquery-ui.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script type="text/javascript" src="../includes/amskier.js"></script>
<script type="text/javascript">
var show_debug = <?= $show_debug ?>;
var isUpdate = <?php if ($isUpdate == true) { echo(1); } else { echo(0); } ?>;
<?php
if ($isUpdate == true) {
	print "var updateIdx = ".$_GET['update'].";\n";
}
?>

$(document).ready(function() {
	if (show_debug == 1) {
		$("#debug").html( $(window).width() + "px" );
		$(window).resize(function() {
			$("#debug").html( $(window).width() + "px" );
		});
	}
	else {
		$("#debug").hide();
	}
});

function submitForm() {
	var opts = { op: 'submitWorkersComp' };
	$(":radio:checked").each(function(a) {
		var name = $(this).attr('name');
		var val = $(this).val();
		opts[name] = val;
	});
	$("select, input:text, input[type='date'], input[type='time'], textarea").each(function(a) {
		var id = $(this).attr('id');
		var val = $(this).val();
		opts[id] = val;
	});
	opts.isUpdate = isUpdate;
	if (isUpdate == 1) { opts.updateIdx = updateIdx; }
	$.post('ajax.php', opts, function(data) {
		var json = $.parseJSON(data);
		if (json.isError == true) {
			var err = json.errorMessage + "\n\n";
			for (var i in json.data.missing) {
				err += json.data.missing[i]+"\n";
			}
			alert(err);
		}
		else {
			console.log(json.data.query);
			$('#wc_main').hide('fade', 500, function() {
				$('#wc_thanks').show('fade', 500);
			});
		}
	});
}
function myTest() {
	var zip = document.getElementById("zip").value;
	var xTest = '';
	var opts = { op: 'getZipDetail', zip: zip};
	
	$.post('ajax.php', opts, function(data) {
		var json = $.parseJSON(data);
		if (json.isError == true) {
		} else {
			//$('#ri_tbody').html(json.data.html);
			//xTest = json.data.city;
			$('#city').val(json.data.city);
			$('#state').val(json.data.state);
		}
	});
}
function goDashboard() {
	window.location.href = 'index.php';
}
</script>
</head>
<body>

<div id="content_wrapper">
	<!--
	<div class="new-header">
        <div class="header-left">
		    <a href="http://www.amskier.com"><img border="0" src="/graphics/amskier-logo-2014.png" style="padding-left: 50px" width="199" height="70"/></a>"
	    </div>	
	</div>
	-->
	<!-- <?php include("../includes/amskier-header-2.php"); ?> -->
	
	<ol class="breadcrumb" style="margin: 0px">
		<li><a href="index.php">HOME</a></li>
		<li class="active">WORKERS COMPENSATION REPORT</li>
	</ol>
	<div id="main_content">
		<div id="wc_main">
			<div class="page-title">Workers Compensation Incident Report</div>
			<div class="page-warning">Please call 1.866.SKIERWC (1.866.754.3792) if you have any questions or need assistance with this form.</div>
			<form role="form" style="text-align: left;">
				<div class="col-lg-12">
					<div class="form-group col-lg-6">
						<label for="campName" class="skier-label">Camp Name</label>
						<input type="text" name="campName" id="campName" class="input-lg form-control skier-input-two" placeholder="Camp Name" autocomplete="off" value="<?= $formdata['campName'] ?>" />
					</div>
					<div class="form-group col-lg-6">
						<label for="campLocation" class="skier-label">Location</label>
						<select name="campLocation" id="campLocation" class="input-lg form-control skier-select">
							<option value="">-- Select --</option>
							<?php
							foreach ($_SESSION['AMSKIER']['locations'] as $id=>$loc) {
								print "<option value=\"$id\"";
								if ($id == $formdata['campLocation']) { print " selected=\"selected\""; }
								print ">$loc</option>\n";
							}
							?>
						</select>
					</div>
					<div style="clear:both"></div>
				</div>
				<div class="col-lg-12">
					<div class="form-group col-lg-12">
						<div class="col-lg-12 page-title" style="text-align: center; margin-top: 50px; color: #7089a4">INJURED PERSON'S INFORMATION</div>
						<button class="hideMeButton">Expand</button>
					</div>
				</div>
				
				<div class="col-lg-12">
					<div class="form-group col-lg-6">
						<label for="firstName" class="skier-label">First Name</label>
						<input type="text" name="firstName" id="firstName" class="input-lg form-control skier-input-two" placeholder="First Name" autocomplete="off" value="<?= $formdata['firstName'] ?>" />
					</div>
					<div class="form-group col-lg-6">
						<label for="lastName" class="skier-label">Last Name</label>
						<input type="text" name="lastName" id="lastName" class="input-lg form-control skier-input-two" placeholder="Last Name" autocomplete="off" value="<?= $formdata['lastName'] ?>" />
					</div>
					<div style="clear:both"></div>
				</div>
				<div class="col-lg-12">
					<div class="form-group col-lg-12">
						<label for="address" class="skier-label">Address</label>
						<input type="text" name="address" id="address" class="input-lg form-control skier-input-two" placeholder="Address" autocomplete="off" value="<?= $formdata['address'] ?>" />
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group col-lg-4">
						<label for="zip" class="skier-label">Zip</label>
						<input type="text" name="zip" id="zip" class="input-lg form-control skier-input-two" placeholder="Zip/Postal Code" onblur="myTest()" autocomplete="off" value="<?= $formdata['zip'] ?>" />
					</div>
					<div class="form-group col-lg-4">
						<label for="city" class="skier-label">City</label>
						<input type="text" name="city" id="city" class="input-lg form-control skier-input-two" placeholder="City" autocomplete="off" value="<?= $formdata['city'] ?>" />
					</div>
					<div class="form-group col-lg-4">
						<label for="state" class="skier-label">State</label>
						<input type="text" name="state" id="state" class="input-lg form-control skier-input-two" placeholder="State" autocomplete="off" value="<?= $formdata['state'] ?>" />
					</div>

				</div>
				<div class="col-lg-12">
					<div class="form-group col-lg-6">
						<label for="phone" class="skier-label">Phone # of injured staff</label>
						<input type="text" name="phone" id="phone" class="input-lg form-control skier-input-two" placeholder="Phone # of injured staff" autocomplete="off" value="<?= $formdata['phone'] ?>" />
					</div>
					<div class="form-group col-lg-6">
						<label for="jobTitle" class="skier-label">Job Title</label>
						<input type="text" name="jobTitle" id="jobTitle" class="input-lg form-control skier-input-two" placeholder="Job Title" autocomplete="off" value="<?= $formdata['jobTitle'] ?>" />
					</div>
					<div style="clear:both"></div>
				</div>
				
				<div class="col-lg-12 skier-label">
					<div class="form-group col-lg-6">
						<label for="maritalStatus" class="skier-label">Marital Status</label>
						<div><input type="radio" name="maritalStatus" id="maritalStatus_married" value="Married"<?php if ($formdata['maritalStatus'] == 'Married') { print ' checked="checked"'; } ?> /> Married &nbsp;
							<input type="radio" name="maritalStatus" id="maritalStatus_single" value="Single"<?php if ($formdata['maritalStatus'] == 'Single') { print ' checked="checked"'; } ?> /> Single
						</div>
					</div>
					<div class="form-group col-lg-6 skier-label">
						<label for="gender" class="skier-label">Gender</label>
						<div><input type="radio" name="gender" id="gender_male" value="Male"<?php if ($formdata['gender'] == 'Male') { print ' checked="checked"'; } ?> /> Male &nbsp;
							<input type="radio" name="gender" id="gender_female" value="Female"<?php if ($formdata['gender'] == 'Female') { print ' checked="checked"'; } ?> /> Female
						</div>
					</div>
					<div style="clear:both"></div>
				</div>
				<div class="col-lg-12 skier-label">
					<div class="form-group col-lg-6">
						<label for="international" class="skier-label">International staff</label>
						<div><input type="radio" name="international" id="international_yes" value="Yes"<?php if ($formdata['international'] == 'Yes') { print ' checked="checked"'; } ?> /> Yes &nbsp;
							<input type="radio" name="international" id="international_no" value="No"<?php if ($formdata['international'] == 'No') { print ' checked="checked"'; } ?> /> No
						</div>
					</div>
					<div class="form-group col-lg-6">
						<label for="agency" class="skier-label">If yes, name of international staffing agency:</label>
						<input type="text" name="agency" id="agency" class="input-lg form-control skier-input-two" placeholder="Name of Agency (int'l)" autocomplete="off" value="<?= $formdata['agency'] ?>" />
					</div>
					<div style="clear:both"></div>
				</div>
				<div class="col-lg-12">
					<div class="form-group col-lg-3">
						<label for="dobMonth" class="skier-label">Date of Birth</label>
						<select name="dobMonth" id="dobMonth" class="input-lg form-control skier-select">
							<option value="">Month</option>
							<?php
							foreach ($months as $num=>$name) {
								print "<option value=\"$num\"";
								if ($num == $formdata["dobMonth"]) { print " selected=\"selected\""; }
								print ">$name</option>";
							}
							?>
						</select>
					</div>
					<div class="form-group col-lg-2">
						<label for="dobDay" class="skier-label">&nbsp;</label>
						<select name="dobDay" id="dobDay" class="input-lg form-control skier-select">
							<option value="">Day</option>
							<?php
							for ($i=1; $i<=31; $i++) {
								print "<option value=\"$i\"";
								if ($i == $formdata["dobDay"]) { print " selected=\"selected\""; }
								print ">$i</option>";
							}
							?>
						</select>
					</div>
					<div class="form-group col-lg-3">
						<label for="dobYear" class="skier-label">&nbsp;</label>
						<select name="dobYear" id="dobYear" class="input-lg form-control skier-select">
							<option value="">Year</option>
							<?php
							$startYear = date('Y')-15;
							$endYear = date('Y')-90;
							for ($i=$startYear; $i>=$endYear; $i--) {
								print "<option value=\"$i\"";
								if ($i == $formdata['dobYear']) { print ' selected="selected"'; }
								print ">$i</option>\n";
							}
							?>
						</select>
					</div>
					<div class="form-group col-lg-4">
						<label for="ssn" class="skier-label">Social Security #</label>
						<input type="text" name="ssn" id="ssn" class="input-lg form-control skier-label-two" placeholder="SSN" autocomplete="off" value="<?= $formdata['ssn'] ?>" />
					</div>
					<div style="clear:both"></div>
				</div>
				<div class="col-lg-12 skier-label">
					<div class="form-group col-lg-12">
						<label for="employed" class="skier-label">Staff Employed</label>
						<div>
							<input type="radio" name="employed" id="employed_fulltime" value="Full-Time"<?php if ($formdata['employed'] == 'Full-Time') { print ' checked="checked"'; } ?> /> Full-Time &nbsp;&nbsp;&nbsp; 
							<input type="radio" name="employed" id="employed_parttime" value="Part-Time"<?php if ($formdata['employed'] == 'Part-Time') { print ' checked="checked"'; } ?> /> Part-Time &nbsp;&nbsp;&nbsp;
							<input type="radio" name="employed" id="employed_seasonal" value="Seasonal"<?php if ($formdata['employed'] == 'Seasonal') { print ' checked="checked"'; } ?> /> Seasonal &nbsp;&nbsp;&nbsp;
							<input type="radio" name="employed" id="employed_volunteer" value="Volunteer"<?php if ($formdata['employed'] == 'Volunteer') { print ' checked="checked"'; } ?> /> Volunteer
						</div>
					</div>
					<div style="clear:both"></div>
				</div>
				<div class="col-lg-12">
					<div class="form-group col-lg-6">
						<label for="numDependents" class="skier-label">Num. of Dependents</label>
						<input type="text" name="numDependents" id="numDependents" class="input-lg form-control skier-input-two" placeholder="Number of dependents" autocomplete="off" value="<?= $formdata['numDependents'] ?>" />
					</div>
					<div class="form-group col-lg-6">
						<label for="dateOfHire" class="skier-label">Date of Hire</label>
						<input type="date" name="dateOfHire" id="dateOfHire" class="input-lg form-control skier-input-two" placeholder="Date of Hire" autocomplete="off" value="<?= $formdata['dateOfHire'] ?>" />
					</div>
					<div style="clear:both"></div>
				</div>
				<div class="col-lg-12">
					<div class="form-group col-lg-6">
						<label for="workDaysPerWeek" class="skier-label">Days staff works per week</label>
						<input type="text" name="workDaysPerWeek" id="workDaysPerWeek" class="input-lg form-control skier-input-two" placeholder="Days staff works per week" autocomplete="off" value="<?= $formdata['workDaysPerWeek'] ?>" />
					</div>
					<div class="form-group col-lg-6">
						<label for="avgEarningsPerWeek" class="skier-label">Staff average earnings per week</label>
						<input type="text" name="avgEarningsPerWeek" id="avgEarningsPerWeek" class="input-lg form-control skier-input-two" placeholder="Staff average earnings per week" autocomplete="off" value="<?= $formdata['avgEarningsPerWeek'] ?>" />
					</div>
					<div style="clear:both"></div>
				</div>
				<div class="col-lg-12">
					<div class="form-group col-lg-12">				
						<div class="col-lg-12 page-title" style="text-align: center; margin-top: 50px; color: #7089a4">Accident Information</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group col-lg-4">
						<label for="severity" class="skier-label">Severity</label>
						<select name="severity" id="severity" class="input-lg form-control skier-select">
							<option value="">-- Choose --</option>
							<option value="Low"<?php if ($formdata['Severity'] == 'Low') { print ' selected="selected"'; } ?>>Low</option>
							<option value="Medium"<?php if ($formdata['Severity'] == 'Medium') { print ' selected="selected"'; } ?>>Medium</option>
							<option value="High"<?php if ($formdata['Severity'] == 'High') { print ' selected="selected"'; } ?>>High</option>
						</select>
					</div>					
					<div style="clear:both"></div>	
				</div>	

				<div class="col-lg-12">
					<div class="form-group col-lg-6">
						<label for="accidentDate" class="skier-label">Accident Date</label>
						<input type="date" name="accidentDate" id="accidentDate" class="input-lg form-control skier-input-two" placeholder="Accident Date" autocomplete="off" value="<?= $formdata['accidentDate'] ?>" />
					</div>
					<div class="form-group col-lg-6">
						<label for="accidentTime" class="skier-label">Accident Time</label>
						<input type="time" name="accidentTime" id="accidentTime" class="input-lg form-control skier-input-two" placeholder="Accident Time" autocomplete="off" value="<?= $formdata['accidentTime'] ?>" />
					</div>
					<div style="clear:both"></div>
				</div>
												
				<div class="col-lg-12">
					<div class="form-group col-lg-6">
						<label for="injuryLocation" class="skier-label">Location where injury occured</label>
						<select name="injuryLocation" id="injuryLocation" class="input-lg form-control skier-select">
							<option value="">-- Choose --</option>
							<?php
							foreach ($incidentLocations as $loc) {
								print "<option value=\"$loc\"";
								if ($loc == $formdata['injuryLocation']) { print ' selected="selected"'; }
								print ">$loc</option>\n";
							}
							?>
						</select>
					</div>
					<div class="form-group col-lg-6">
						<label for="injuryCause" class="skier-label">Cause of injury</label>
						<select name="injuryCause" id="injuryCause" class="input-lg form-control skier-select">
							<option value="">-- Choose --</option>
							<?php
							foreach ($incidentCauses as $cause) {
								print "<option value=\"$cause\"";
								if ($cause == $formdata['injuryCause']) { print ' selected="selected"'; }
								print ">$cause</option>\n";
							}
							?>
						</select>
					</div>
					<div style="clear:both"></div>
				</div>
				<div class="col-lg-12">
					<div class="form-group col-lg-6">
						<label for="injuryBodyPart" class="skier-label">Body part affected by injury</label>
						<select name="injuryBodyPart" id="injuryBodyPart" class="input-lg form-control skier-select">
							<option value="">-- Choose --</option>
							<?php
							foreach ($bodyParts as $part) {
								print "<option value=\"$part\"";
								if ($part == $formdata['injuryBodyPart']) { print ' selected="selected"'; }
								print ">$part</option>\n";
							}
							?>
						</select>
					</div>
					<div class="form-group col-lg-6">
						<label for="injuryBodyPartSide" class="skier-label">Body part side</label>
						<select name="injuryBodyPartSide" id="injuryBodyPartSide" class="input-lg form-control skier-select">
							<option value="">-- Choose --</option>
							<?php
							foreach ($bodyPartSide as $part) {
								print "<option value=\"$part\"";
								if ($part == $formdata['injuryBodyPartSide']) { print ' selected="selected"'; }
								print ">$part</option>\n";
							}
							?>
						</select>
					</div>
					<div style="clear:both"></div>
				</div>
				
				<div class="col-lg-12">
					<div class="form-group col-lg-6">
						<label for="injuryType" class="skier-label">What type of injury occured</label>
						<select name="injuryType" id="injuryType" class="input-lg form-control skier-select">
							<option value="">-- Choose --</option>
							<?php
							foreach ($injuryTypes as $type) {
								print "<option value=\"$type\"";
								if ($type == $formdata['injuryType']) { print ' selected="selected"'; }
								print ">$type</option>\n";
							}
							?>
						</select>
					</div>					
				</div>
				
				<div class="col-lg-12">
					<div class="form-group col-lg-6">
						<label for="illnessType" class="skier-label">What type of illness occured</label>
						<select name="illnessType" id="illnessType" class="input-lg form-control skier-select">
							<option value="">-- Choose --</option>
							<?php
							foreach ($illnessTypes as $ill) {
								print "<option value=\"$ill\"";
								if ($ill == $formdata['illnessType']) { print ' selected="selected"'; }
								print ">$ill</option>\n";
							}
							?>
						</select>
					</div>
					<div class="form-group col-lg-6">
						<label for="activityType" class="skier-label">Type of activity</label>
						<select name="activityType" id="activityType" class="input-lg form-control skier-select">
							<option value="">-- Choose --</option>
							<?php
							foreach ($activityTypes as $act) {
								print "<option value=\"$act\"";
								if ($act == $formdata['activityType']) { print ' selected="selected"'; }
								print ">$act</option>\n";
							}
							?>
						</select>
					</div>
					<div style="clear:both"></div>
				</div>

				<div class="col-lg-12">
					<div class="form-group col-lg-6">
						<label for="accidentReportDate" class="skier-label">Date accident was reported</label>
						<input type="date" name="accidentReportDate" id="accidentReportDate" class="input-lg form-control skier-input-two" placeholder="Accident report date" autocomplete="off" value="<?= $formdata['accidentReportDate'] ?>" />
					</div>
					<div class="form-group col-lg-6">
						<label for="dateStoppedWork" class="skier-label">Date stopped work due to injury</label>
						<input type="date" name="dateStoppedWork" id="dateStoppedWork" class="input-lg form-control skier-input-two" placeholder="Date stopped work" autocomplete="off" value="<?= $formdata['dateStoppedWork'] ?>" />
					</div>
					<div style="clear:both"></div>
				</div>
				<div class="col-lg-12">
					<div class="form-group col-lg-6">
						<label for="dateReturnedToWork" class="skier-label">Date returned to work</label>
						<input type="date" name="dateReturnedToWork" id="dateReturnedToWork" class="input-lg form-control skier-input-two" placeholder="Date returned to work" autocomplete="off" value="<?= $formdata['dateReturned'] ?>" />
					</div>
					<div class="form-group col-lg-6">
						<label for="timeReturnedToWork" class="skier-label">Time returned to work</label>
						<input type="time" name="timeReturnedToWork" id="timeReturnedToWork" class="input-lg form-control skier-input-two" placeholder="Time returned to work" autocomplete="off" value="<?= $formdata['timeReturned'] ?>" />
					</div>
					<div style="clear:both"></div>
				</div>
				

				
		
				<div class="col-lg-12">
					<div class="form-group col-lg-6">
						<label for="unsafeAct" class="skier-label">Was staff involved in an unsafe act?</label>
						<div><input type="radio" name="unsafeAct" id="unsafeAct_yes" value="Yes"<?php if ($formdata['unsafeAct'] == '1') { print ' checked="checked"'; } ?> /> Yes &nbsp;
							<input type="radio" name="unsafeAct" id="unsafeAct_no" value="No"<?php if ($formdata['unsafeAct'] == '0') { print ' checked="checked"'; } ?> /> No
						</div>
					</div>
					<div class="form-group col-lg-6">
						<label for="accidentAtCamp" class="skier-label">Accident occured at camp?</label>
						<div><input type="radio" name="accidentAtCamp" id="accidentAtCamp_yes" value="Yes"<?php if ($formdata['accidentAtCamp'] == '1') { print ' checked="checked"'; } ?> /> Yes &nbsp;
							<input type="radio" name="accidentAtCamp" id="accidentAtCamp_no" value="No"<?php if ($formdata['accidentAtCamp'] == '0') { print ' checked="checked"'; } ?> /> No
						</div>
					</div>
					<div style="clear:both"></div>
				</div>
				<div class="col-lg-12">
					<div class="form-group col-lg-12">
						<label for="outsideAddress" class="skier-label">Address, if injury was outside of camp:</label>
						<textarea name="outsideAddress" id="outsideAddress" class="input-lg form-control skier-input-two" placeholder="Address if other than camp" rows="3"><?= $formdata['outsideAddress'] ?></textarea>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group col-lg-12">
						<label for="doingWhenInjured" class="skier-label">What was staff doing when injured?</label>
						<textarea name="doingWhenInjured" id="doingWhenInjured" class="input-lg form-control skier-input-two" placeholder="What was staff doing when injured?" rows="3"><?= $formdata['doingWhenInjured'] ?></textarea>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group col-lg-12">
						<label for="injuryObject" class="skier-label">Object or substance that directly injured staff:</label>
						<textarea name="injuryObject" id="injuryObject" class="input-lg form-control skier-input-two" placeholder="Object or substance that directly injured staff" rows="3"><?= $formdata['injuryObject'] ?></textarea>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group col-lg-12">
						<label for="howOccured" class="skier-label">How did the accident or exposure occur?</label>
						<textarea name="howOccured" id="howOccured" class="input-lg form-control skier-input-two" placeholder="How did the accident or exposure occur?" rows="3"><?= $formdata['howOccured'] ?></textarea>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group col-lg-12">
						<label for="whereTreated" class="skier-label">Name of Doctor, Hospital, or Medical Center where staff was treated:</label>
						<textarea name="whereTreated" id="whereTreated" class="input-lg form-control skier-input-two" placeholder="Name of Doctor, Hospital, or Medical Center where staff was treated" rows="3"><?= $formdata['whereTreated'] ?></textarea>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group col-lg-6">
						<label for="staffPaid" class="skier-label">Was injured staff paid in full for the day of the accident?</label>
						<div><input type="radio" name="staffPaid" id="staffPaid_yes" value="Yes"<?php if ($formdata['staffPaid'] == 'Yes') { print ' checked="checked"'; } ?> /> Yes &nbsp;
							<input type="radio" name="staffPaid" id="staffPaid_no" value="No"<?php if ($formdata['staffPaid'] == 'No') { print ' checked="checked"'; } ?> /> No
						</div>
					</div>
					<div class="form-group col-lg-6">
						<label for="campMedicalCare" class="skier-label">Did camp provide medical care?</label>
						<div><input type="radio" name="campMedicalCare" id="campMedicalCare_yes" value="Yes"<?php if ($formdata['campMedicalCare'] == 'Yes') { print ' checked="checked"'; } ?> /> Yes &nbsp;
							<input type="radio" name="campMedicalCare" id="campMedicalCare_no" value="No"<?php if ($formdata['campMedicalCare'] == 'No') { print ' checked="checked"'; } ?> /> No
						</div>
					</div>
					<div style="clear:both"></div>
				</div>
				<div class="col-lg-12">
					<div class="form-group col-lg-12">
						<label for="campMedicalCareDetail" class="skier-label">If camp provided medical care, please explain and provide date of care:</label>
						<textarea name="campMedicalCareDetail" id="campMedicalCareDetail" class="input-lg form-control skier-input-two" placeholder="If camp provided medical care, please explain and provide date of care" rows="3"><?= $formdata['campMedicalCareDetail'] ?></textarea>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group col-lg-12">
						<label for="notes" class="skier-label">Additional Notes or Comments:</label>
						<textarea name="notes" id="notes" class="input-lg form-control skier-input-two" placeholder="Additional Notes or Comments" rows="3"><?= $formdata['notes'] ?></textarea>
					</div>
				</div>
				<div class="col-lg-12">
					<!--<div class="skier-label" style="text-align: center; margin-bottom: 20px;">------ AMSkier Internal Use Only ------</div>-->
					<div class="form-group col-lg-4">
						<label for="firstAid" class="skier-label" style="color: green">First-Aid </label>
						<div><input type="radio" name="firstAid" id="firstAid_yes" value="Yes"<?php if ($formdata['FirstAid'] == 'Yes') { print ' checked="checked"'; } ?> /> Yes &nbsp;
							<input type="radio" name="firstAid" id="firstAid_no" value="No"<?php if ($formdata['FirstAid'] == 'No') { print ' checked="checked"'; } ?> /> No
						</div>
					</div>
					<div class="form-group col-lg-4">
						<label for="firstAid" class="skier-label">Report Only &nbsp; &nbsp; ( Non NY State camps Only )</label>
						<div><input type="radio" name="reportOnly" id="reportOnly_yes" value="Yes"<?php if ($formdata['ReportOnly'] == 'Yes') { print ' checked="checked"'; } ?> /> Yes &nbsp;
							<input type="radio" name="reportOnly" id="reportOnly_no" value="No"<?php if ($formdata['ReportOnly'] == 'No') { print ' checked="checked"'; } ?> /> No
						</div>
					</div>
					<!--
					<div class="form-group col-lg-4">
						<label for="featured" class="skier-label">Featured</label>
						<div><input type="radio" name="featured" id="featured_yes" value="Yes"<?php if ($formdata['Featured'] == 'Yes') { print ' checked="checked"'; } ?> /> Yes &nbsp;
							<input type="radio" name="featured" id="featured_no" value="No"<?php if ($formdata['Featured'] == 'No') { print ' checked="checked"'; } ?> /> No
						</div>
					</div>
					-->
				</div>
								
				<div class="col-lg-12 skier-label" style="padding-left: 30px; color: green">First-Aid Qualifications</div>
				<div class="col-lg-12 skier-text">
					<div class="form-group col-lg-9">
						1. Do you expect more than two medical provider visits?
					</div>
					<div class="form-group col-lg-3">
						<input type="radio" name="bandaid1" id="bandaid1_yes" value="Yes"<?php if ($formdata['bandaid1'] == 1) { print ' checked="checked"'; } ?> /> Yes &nbsp;
						<input type="radio" name="bandaid1" id="bandaid1_no" value="No"<?php if ($formdata['bandaid1'] == 0) { print ' checked="checked"'; } ?> /> No
					</div>
					<div style="clear:both"></div>
				</div>
				<div class="col-lg-12 skier-text">
					<div class="form-group col-lg-9">
						2. Has there been lost time from work, other than the day of the Injury?
					</div>
					<div class="form-group col-lg-3">
						<input type="radio" name="bandaid2" id="bandaid2_yes" value="Yes"<?php if ($formdata['bandaid2'] == 1) { print ' checked="checked"'; } ?> /> Yes &nbsp;
						<input type="radio" name="bandaid2" id="bandaid2_no" value="No"<?php if ($formdata['bandaid2'] == 0) { print ' checked="checked"'; } ?> /> No
					</div>
					<div style="clear:both"></div>
				</div> 
				<div class="col-lg-12 skier-text">
					<div class="form-group col-lg-9">
						3. Do the total bills exceed $750 for an accident ($1,000 in New York State)?
					</div>
					<div class="form-group col-lg-3">
						<input type="radio" name="bandaid3" id="bandaid3_yes" value="Yes"<?php if ($formdata['bandaid3'] == 1) { print ' checked="checked"'; } ?> /> Yes &nbsp;
						<input type="radio" name="bandaid3" id="bandaid3_no" value="No"<?php if ($formdata['bandaid3'] == 0) { print ' checked="checked"'; } ?> /> No
					</div>
					<div style="clear:both"></div>
				</div>
				<div class="col-lg-12 skier-text">
					<div class="form-group col-lg-9">
						<strong>If all three answers are NO, this may qualify to be a First Aid claim. Do you want to make it a First Aid claim?</strong>
					</div>
					<div class="form-group col-lg-3">
						<input type="radio" name="bandaid4" id="bandaid4_yes" value="Yes"<?php if ($formdata['bandaid4'] == 1) { print ' checked="checked"'; } ?> /> Yes &nbsp;
						<input type="radio" name="bandaid4" id="bandaid4_no" value="No"<?php if ($formdata['bandaid4'] == 0) { print ' checked="checked"'; } ?> /> No
					</div>
					<div style="clear:both"></div>
				</div>
				
				
				<div class="col-lg-12">
					<div class="form-group col-lg-12">
						<div class="col-lg-12 page-title" style="text-align: center; margin-top: 50px; color: #7089a4">This form was filled out by</div>
					</div>
				</div>
				
				<div class="col-lg-12">
					<div class="form-group col-lg-5 col-lg-offset-1">
						<label for="sb_firstName" class="skier-label">First Name</label>
						<input type="text" name="sb_firstName" id="sb_firstName" class="input-lg form-control skier-input-two" placeholder="First Name" autocomplete="off" value="<?= $formdata['sb_firstName'] ?>" />
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group col-lg-5 col-lg-offset-1">
						<label for="sb_lastName" class="skier-label">Last Name</label>
						<input type="text" name="sb_lastName" id="sb_lastName" class="input-lg form-control skier-input-two" placeholder="Last Name" autocomplete="off" value="<?= $formdata['sb_lastName'] ?>" />
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group col-lg-5 col-lg-offset-1">
						<label for="sb_title" class="skier-label">Title</label>
						<input type="text" name="sb_title" id="sb_title" class="input-lg form-control skier-input-two" placeholder="Title" autocomplete="off" value="<?= $formdata['sb_title'] ?>" />
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group col-lg-5 col-lg-offset-1">
						<button type="button" class="btn btn-primary skier-button" onclick="submitForm()">Submit</button>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group col-lg-12">
						<div class="skier-label" style="font-size: 1.5em; text-align: center; margin-bottom: 30px; margin-top: 10px">PLEASE REMEMBER WORKERS COMP INCIDENTS ARE <br> <span style="color: red">REQUIRED TO BE SUBMITTED WITHIN 72 HOURS</span></div>
						<!--<div class="skier-text" style="color: red">Reporting all workers' compensation claims within 72 hours of the workplace injury or illness is essential, most states have timely reporting requirements and will fine a business that reports a claim late or fails to report a claim at all.</div>-->
					</div>
				</div>
								
				<div style="clear:both"></div>
			</form>
		</div>
		<div id="wc_thanks" style="display: none;">
			<div style="text-align:center" class="main-heading">Thank You</div>
	        <div style="margin-top:40px; text-align:center; width:600px; margin-left:auto; margin-right:auto;">
	            We are processing your Workers Comp Report. A representative will be in touch with you shortly.
	        </div>
	        <div style="text-align:center; margin-top:40px;">
	            <button type="button" class="btn btn-primary skier-button" onclick="goDashboard()"><span>Return to Dashboard</span></button>
	        </div>
		</div>
	</div>
</div>
<!-- <div id="debug"></div> -->

<!-- <?php include("../includes/amskier-footer.php"); ?> -->

</body>
</html>