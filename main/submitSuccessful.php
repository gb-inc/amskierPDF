<?php

$host = "localhost";
$db = "fauxdata";
$username = "root";
$password = "";



$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$married = $_POST['maritalStatus'];
$male = $_POST['gender'];
$female = $_POST['gender'];
$DOB = $_POST['dobYear'] . '-'. $_POST['dobMonth'] . '-' . $_POST['dobDay']. ' 00:00:00';
$SSN = $_POST['ssn'];
$domesticStaff = $_POST['international'];
$internationalStaff = $_POST['international'];
$internationalAgency = $_POST['agency'];
$address = $_POST['address'];
$zip = $_POST['zip'];
$city = $_POST['city'];
$state = $_POST['state'];
$phoneNumber = $_POST['phone'];
$injuryDate= $_POST['accidentDate'];
$injuryTime = $_POST['accidentTime'];
$dateRec = $_POST['accidentReportDate'];
$lastDayWorked = $_POST['dateStoppedWork'];
$returnDate = $_POST['dateReturnedToWork'];
$timeBeganWork = $_POST['timeReturnedToWork'];
$injuryLocation = $_POST['injuryLocation'];
$unsafeAct = $_POST['unsafeAct'];
$occurredAtCamp = $_POST['accidentAtCamp'];
$outsideAddress = $_POST['outsideAddress'];
$firstAid = $_POST['firstAid'];
$ba1 = $_POST['bandaid1'];
$ba2 = $_POST['bandaid2'];
$ba3 = $_POST['bandaid3'];
$ba4 = $_POST['bandaid4'];
$injuryType = $_POST['injuryType'];
$illnessType = $_POST['illnessType']; 
$activityType = $_POST['activityType'];
$causeOfInjury = $_POST['injuryCause'];
$bodyPart = $_POST['injuryBodyPart'];
$severity = $_POST['severity'];
$doingWhenInjured = $_POST['doingWhenInjured'];
$hospitalInfo = $_POST['whereTreated'];
$paidForDayYes = $_POST['staffPaid'];
$paidForDayNo = $_POST['staffPaid'];
$jobTitle = $_POST['jobTitle'];
$hireDate = $_POST['dateOfHire'];
$employmentStatus = $_POST['employed'];
$daysPerWeek = $_POST['workDaysPerWeek'];
$earningsPerWeek = $_POST['avgEarningsPerWeek'];
$dependants = $_POST['numDependents'];
$additionalNotes = $_POST['notes'];
$campCareNo = $_POST['campMedicalCare'];
$campCareYes = $_POST['campMedicalCare'];
$campCareDetails = $_POST['campMedicalCareDetail'];
$submittedByFirstName = $_POST['sb_firstName'];
$submittedByLastName = $_POST['sb_lastName'];
$submittedByTitle = $_POST['sb_title'];

$data = array(
    $firstName,
    $lastName,
    $married,
    $male,
    $female,
    $DOB,
    $SSN,
    $domesticStaff,
    $internationalStaff,
    $internationalAgency,
    $address,
    $zip,
    $city,
    $state,
    $phoneNumber,
    $injuryDate,
    $injuryTime,
    $dateRec,
    $lastDayWorked,
    $returnDate,
    $timeBeganWork,
    $injuryLocation,
    $unsafeAct,
    $occurredAtCamp,
    $outsideAddress,
    $firstAid,
    $ba1,
    $ba2,
    $ba3,
    $ba4,
    $injuryType,
    $illnessType,
    $activityType,
    $causeOfInjury,
    $bodyPart,
    $severity,
    $doingWhenInjured,
    $hospitalInfo,
    $paidForDayYes,
    $paidForDayNo,
    $jobTitle,
    $hireDate,
    $employmentStatus,
    $daysPerWeek,
    $earningsPerWeek,
    $dependants,
    $additionalNotes,
    $campCareNo,
    $campCareYes,
    $campCareDetails,
    $submittedByFirstName,
    $submittedByLastName,
    $submittedByTitle
  );
  

if (isset($_POST['submitFinal'])){
    $conn = mysqli_connect($host, $username, $password, $db);

    if($conn){
        echo "connected!";
    }
if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO `campdata` (`firstName`,`lastName`,`married`,`male`,`female`,`DOB`,`SSN`,`domesticStaff`,`internationalStaff`,`internationalAgency`,`address`,`zip`,`city`,`state`,`phoneNumber`,`injuryDate`,`injuryTime`,`dateRec`,`lastDayWorked`,`returnDate`,`timeBeganWork`,`injLocationWhere`,`unsafeAct`,`occuredAtCamp`,`outsideAddress`,`firstAid`,`ba1`,`ba2`,`ba3`,`ba4`,`injuryType`,`illnessType`,`activityType`,`causeOfInjury`,`bodyPart`,`severity``doingWhenInjured`,`hospitalInfo`,`paidForDayYes`,`paidForDayNo`,`jobTitle`,`hireDate`,`employmentStatus`,`daysPerWeek`,`earningsPerWeek`,`dependants`,`additionalNotes`,`campCareNo`,`campCareYes`,`campCareDetails`,`submittedByFirstName``submittedByLastName`,`submittedByTitle`) VALUES ($firstName, $lastName, $married, $male, $female, $DOB, $SSN, $domesticStaff, $internationalStaff, $internationalAgency, $address, $zip, $city, $state, $phoneNumber, $injuryDate, $injuryTime, $dateRec, $lastDayWorked, $returnDate, $timeBeganWork, $injuryLocation, $unsafeAct, $occurredAtCamp, $outsideAddress, $firstAid, $ba1, $ba2, $ba3, $ba4, $injuryType, $illnessType, $activityType, $causeOfInjury, $bodyPart, $severity, $doingWhenInjured, $hospitalInfo, $paidForDayYes, $paidForDayNo, $jobTitle, $hireDate, $employmentStatus, $daysPerWeek, $earningsPerWeek, $dependants, $additionalNotes, $campCareYes, $campCareNo, $campCareDetails, $submittedByFirstName, $submittedByLastName, $submittedByTitle);";
}

if(mysqli_query($conn, $sql)){
    echo "Nailed it!";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
</head>
<body>
    <h1>Thank you for submitting the claim!</h1>
 
        <ul>
         <?php foreach ($data as $da) {
            echo "<li>$da". gettype($da) ."</li>";
         }
         ?>
        </ul>
         <?php echo count($data); ?>
</body>
</html>

