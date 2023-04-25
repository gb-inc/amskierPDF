// let oldData;
// let downloadPDF = document.getElementById('downloadPDF')

// let finalSubmission = document.getElementById('finalSubmission')
// finalSubmission.addEventListener('click', (e)=> {
//     if(downloadPDF.checked === true){
//         generatePDF(oldData)
//     }
// })
// let puts = document.querySelectorAll('input')
async function fetchAndProcessData() {
	try{
		const res = await fetch('./includes/getData.php');
    const response = await res.json();
    // console.log(response);
    // puts.forEach((input, index) => {
    //         let theId = input.id
    //         console.log(theId)
    //     input.value = response[input];
    //     if (input.value !== '') {
    //         // input.disabled = true;
    //     }
    // });

	oldData = response
    generatePDF(oldData)
    
	} catch{
		console.log('error')
	}

}


// fetchAndProcessData();
// 	const data = [
		
// ];

// let printToPDF = document.getElementById('printToPDF').addEventListener('click', (e)=> {
// 	e.preventDefault()
// 	// generatePDF(oldData)
// })
document.addEventListener('DOMContentLoaded', ()=> {
    let oldData;
    fetchAndProcessData();
    console.log(oldData)
    

   
})
// generatePDF(oldData);

async function generatePDF(data) {
	console.log(data)
  // create a new jsPDF instance
  const doc = new jsPDF();

  // set initial page number
  let pageNumber = 1;

  // loop through the data and add it to the PDF document

  for (const item of data) {
	// console.log(item)
    // add a new page if needed
    if (pageNumber > 1) {
      doc.addPage();
    }

    // add the item to the PDF document

	//heading
    doc.text(`AMSkier Worker's Compensation Claim`, 60, 10);
	doc.line(10,12, 200, 12)


	//injured person's information
    doc.text(`Injured Person's Information`, 70, 20);
	doc.line(65,22, 145, 22)

    doc.text(`First Name: ${item.EEFirstName}`, 10, 30);
    doc.text(`Last Name: ${item.EELastName}`, 80, 30);
	if(item.EEMarried === 0){
		doc.text(`Married: No`, 10, 40);
	} else {
		doc.text(`Married: Yes`, 10, 40);
	}

	if(item.EEMale === '0'){
		doc.text(`Sex: Female`, 80, 40)
	} else if (item.EEMale === 1){
		doc.text(`Sex: Male`, 80, 40);
	}
	
	let newMonth = item.EEDOB.slice(5,7)
	let newDay = item.EEDOB.slice(8,10)
	let newYear = item.EEDOB.slice(0,4)
	doc.text(`Date of Birth: ${newMonth}/${newDay}/${newYear}`, 10, 50)
	doc.text(`SSN: ${item.EESocial}`, 80, 50)
	if(item.StaffIntl === '1'){
		doc.text(`International Staff: Yes`, 130, 50)
	} else{
		doc.text(`International Staff: No`, 130, 50)
	}
	if(item.IntStaffAgency === ''){
		doc.text(`International Staffing Agency: N/A`, 10, 60)
	} else {
		doc.text(`International Staffing Agency: ${item.IntStaffAgency}`, 10, 60)
	}

	doc.text(`Address: ${item.EEAddress}`, 10, 70)
	doc.text(`City: ${item.EECity}`, 10, 80)
	doc.text(`State: ${item.EEState}`, 80, 80)
	doc.text(`Zip: ${item.EEZip}`, 130, 80)
	doc.text(`Phone: ${item.EEPhone}`, 10, 90)
	doc.line(10,92, 200, 92)



	//accident information
	doc.text(`Accident Information`, 80, 100);
	doc.line(65,102, 145, 102)
	let accidentMonth = item.InjuryDate.slice(5,7)
	let accidentDay = item.InjuryDate.slice(8,10)
	let accidentYear = item.InjuryDate.slice(0,4)
	doc.text(`Accident Date: ${accidentMonth}/${accidentDay}/${accidentYear}`, 10, 110)

	let injuryHour = item.InjuryTime.slice(0,2)
	let injuryMinute = item.InjuryTime.slice(3,5)
	let checkInjTime = parseInt(injuryHour)
	let dayNight = 'AM'
	if(checkInjTime >= 12){
		checkInjTime = checkInjTime - 12;
		dayNight = 'PM'
		if(checkInjTime === 0){
			checkInjTime = 12
			dayNight = 'AM'
		}
	}
	if (item.InjuryTime === '' ){
	doc.text(`Accident Time: N/A`, 80, 110)
	} else {
		doc.text(`Accident Time: ${checkInjTime}:${injuryMinute} ${dayNight}`, 80, 110)
	}
	let accidentReportedMonth = item.DateRec.slice(5,7)
	let accidentReportedDay = item.DateRec.slice(8,10)
	let accidentReportedYear = item.DateRec.slice(0,4)
	doc.text(`Accident Date: ${accidentReportedMonth}/${accidentReportedDay}/${accidentReportedYear}`, 10, 120)
	let lastDayWorkedDay = item.LastDayWorked.slice(5,7)
	let lastDayWorkedMonth = item.LastDayWorked.slice(8,10)
	let lastDayWorkedYear = item.LastDayWorked.slice(0,4)
	if(lastDayWorkedDay === "00"){
	doc.text(`Date Stopped Working Due to Injury: N/A`, 80, 120)

	}else{
		doc.text(`Date Stopped Working Due to Injury: ${lastDayWorkedDay}/${lastDayWorkedMonth}/${lastDayWorkedYear}`, 80, 120)

	}
	let monthReturnedToWork = item.ReturnDate.slice(5,7)
	let dayReturnedToWork = item.ReturnDate.slice(8,10)
	let YearReturnedToWork = item.ReturnDate.slice(0,4)
	if(monthReturnedToWork === "00"){
	doc.text(`Date Returned To Work: N/A`, 10, 130)

	}else{
		doc.text(`Date Returned To Work: ${monthReturnedToWork}/${dayReturnedToWork}/${YearReturnedToWork}`, 10, 130)

	}

	let workHour = item.TimeBeganWork.slice(0,2)
	let workMinute = item.TimeBeganWork.slice(3,5)
	let checkWorkTime = parseInt(workHour)
	let mornNight = 'AM'
	if(checkWorkTime >= 12){
		checkWorkTime = checkWorkTime - 12;
		mornNight = 'PM'
		if(checkWorkTime === 0){
			checkWorkTime = 12
			mornNight = 'AM'
		}
	}


	if (item.TimeBeganWork === '' ){
	doc.text(`Time Returned To Work: N/A`, 110, 130)
	} else {
		doc.text(`Time Returned To Work: ${checkWorkTime}:${workMinute} ${mornNight}`, 110, 130)
	}

	if (item.InjLocationWhere === '' ){
		doc.text(`Location Where Injury Occurred: N/A`, 10, 140)
	} else {
		doc.text(`Location Where Injury Occurred: ${item.InjLocationWhere}`, 10, 140)
	}
	
	if(item.UnsafeAct == "0"){
		doc.text(`Was Staff Involved in Unsafe Act: No`, 10, 150)
	} else {
		doc.text(`Was Staff Involved in Unsafe Act: Yes`, 10, 150)

	}

	if(item.AccdAtCamp == "0"){
		doc.text(`Accident Occurred at Camp: No`, 10, 160)
	} else {
		doc.text(`Accident Occurred at Camp: Yes`, 10, 160)

	}
	if(item.AccidentAdd !== ""){
		doc.text(`Address Where Accident Occurred: ${item.AccidentAdd}`, 10, 170)
	} else {
		doc.text(`Address Where Accident Occurred: N/A`, 10, 170)
	}


	//First-Aid Information
	doc.text(`First-Aid Qualifications`, 80, 180)
	doc.line(65,182, 145, 182)
	if(item.BA1 === '0'){
	doc.text(`Do you expect more than two medical provider visits: No`, 10, 190)
  } else {
	doc.text(`Do you expect more than two medical provider visits: Yes`, 10, 190)
  }
  if(item.BA2 === '0'){
	doc.text(`Has there been lost time from work, other than the day of the Injury: No`, 10, 200)
  } else {
	doc.text(`Has there been lost time from work, other than the day of the Injury: Yes`, 10, 200)
  }
  if(item.BA3 === '0'){
	doc.text(`Do the total bills exceed $750 for an accident ($1,000 in New York State): No`, 10, 210)
  } else {
	doc.text(`Do the total bills exceed $750 for an accident ($1,000 in New York State): Yes`, 10, 210)
  }
  if(item.BA4 === '0'){
	doc.text(`Do you want to make it a First Aid claim: No`, 10, 220)
  } else {
	doc.text(`Do you want to make it a First Aid claim: Yes`, 10, 220)
  }
  doc.line(10,222, 200, 222)
  doc.text(`Injury Details`, 90, 230)
	doc.line(65,232, 145, 232)
	if(item.InjuryType === null){
	doc.text(`Injury Type: N/A`, 10, 240)
  } else {
	doc.text(`Injury Type: ${item.InjuryType}`, 10, 240)
  }

  if(item.IllnessDes === ''){
	doc.text(`Illness Type: N/A`, 80, 240)
  } else {
	doc.text(`Illness Type: ${item.IllnessDes}`, 80, 240)
  }

  if(item.ActivityDes === ''){
	doc.text(`Activity Type: N/A`, 10, 250)
  } else {
	doc.text(`Activity Type: ${item.ActivityDes}`, 10, 250)
  }

  if(item.CauseDes === ''){
	doc.text(`Injury Cause: N/A`, 80, 250)
  } else {
	doc.text(`Injury Cause: ${item.CauseDes}`, 80, 250)
  }

  if(item.BodyPartDes === ''){
	doc.text(`Affected Body Part: N/A`, 10, 260)
  } else {
	doc.text(`Affected Body Part: ${item.BodyPartDes}`, 10, 260)
  }

  if(item.BodyPartSide === '' || !item.BodyPartSide){
	doc.text(`Body Part Side: N/A`, 80, 260)
  } else {
	doc.text(`Body Part Side: ${item.BodyPartSide}`, 80, 260)
  }

  doc.text(`Severity: ${item.Severity}`, 140, 260)
  doc.text(`What was staff doing when injured: ${item.DoingWhenInjured}`, 10, 270,{maxWidth: 180})
  doc.addPage();
  doc.text(`AMSkier Worker's Compensation Claim`, 60, 10);
	doc.line(10,12, 200, 12)


	//injured person's information
    doc.text(`Injury Details (cont.)`, 80, 20);
	doc.line(65,22, 145, 22)
  doc.text(`How did the accident/exposure occur: ${item.InjuryDesc}`, 10, 30, {maxWidth: 180})
  doc.text(`Object or substance that directly injured staff: ${item.EquipUsed}`, 10, 80, {maxWidth: 180})
  doc.text(`Name of DR, Hospital, or Med. Center where staff was treated: ${item.HospName}`, 10, 100, {maxWidth: 180})
  if(item.FullPayYes === '1'){
	doc.text(`Was staff paid in full for the day of the accident: Yes`, 10, 120)
  } else {
	doc.text(`Was staff paid in full for the day of the accident: No`, 10, 120)

  }
  doc.line(10,122, 200, 122)

  doc.text(`Employment Details`, 80, 130)
	doc.line(65,132, 145, 132)
	doc.text(`Job Title: ${item.EEJob}`, 10, 140)
	let monthHired = item.EEHireDate.slice(5,7)
	let dayHired = item.EEHireDate.slice(8,10)
	let YearHired = item.EEHireDate.slice(0,4)
	if(monthHired === "00"){
	doc.text(`Date of Hire: N/A`, 130, 140)
	}else{
		doc.text(`Date of Hire: ${monthHired}/${dayHired}/${YearHired}`, 130, 140)
	}
	if(item.EmployStatus === ''){
		doc.text(`Employment Status: N/A`, 10, 150)
	} else{
		doc.text(`Employment Status: ${item.EmployStatus}`, 10, 150)
	}
	doc.text(`Average Days Worked/week: ${item.EEWorkPerWeek}`, 100, 150)
	doc.text(`Average weekly earnings: ${item.AvgEarnings}`, 10, 160)
	doc.text(`Number of Dependants: ${item.EEDependents}`, 100, 160)
	
	if(item.Notes === ''){
	doc.text(`Notes: N/A`, 10, 170)
	} else{
	doc.text(`Notes: ${item.Notes}`, 10, 170, {maxWidth: 180})

	}
	if(item.CareProvided === 'Yes'){
	doc.text(`Did camp provide medical care: Yes`, 10, 200)

	} else{
		doc.text(`Did camp provide medical care: No`, 10, 200)
	}
	if(item.HospNameNote === ''){
		doc.text(`Please explain Camp Care provided: N/A`, 10, 210)
	} else {
		doc.text(`Please explain Camp Care provided: ${item.HospNameNote}`, 10, 210, {maxWidth: 180})

	}
	let monthEntered = item.DE.slice(5,7)
	let dayEntered = item.DE.slice(8,10)
	let yearEntered = item.DE.slice(0,4)
	let HourEntered = item.DE.slice(11,13)
	let MinuteEntered = item.DE.slice(14,16)
	let checkTime = parseInt(HourEntered)
	let amPm = 'AM'
	if(checkTime >= 12){
		checkTime = checkTime - 12;
		amPm = 'PM'
		if(checkTime === 0){
			checkTime = 12
			amPm = 'AM'
		}
	}
	doc.text(`This form was filled out by ${item.whoFirstName} ${item.whoLastName}, ${item.whoTitle} at ${checkTime}:${MinuteEntered} ${amPm} on ${monthEntered}/${dayEntered}/${yearEntered}`, 10, 250, {maxWidth: 180})


    // increment page number
    pageNumber++;
  }
  
  // save the PDF document
  doc.save(`AMSkier - ${data[0].CampName} Worker's Comp Claim ${data[0].EEFirstName} ${data[0].EELastName}.pdf`);


}