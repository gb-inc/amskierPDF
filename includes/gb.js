
let counter = 0;
let counterA =0;
let counterB =0;
let counterC =0;
let counterD =0;
let injuredPerson = document.getElementById('injuredPerson')
let accident = document.getElementById('accident')
let injury = document.getElementById('injury')
let employment = document.getElementById('employment')
let personalButton = document.getElementById('personalButton')
let accidentButton = document.getElementById('accidentButton')
let injuryButton = document.getElementById('injuryButton')
let employmentButton = document.getElementById('employmentButton')
let finalSubmitButton = document.getElementById('finalSubmitButton')


personalButton.addEventListener('click', ()=> {
     injuredPerson.classList.toggle('injuredPerson')
    if (counter %2 === 1){
        hideInjuredPerson.textContent = '(Click to Show Details)'
        counter ++;
    } else {
        hideInjuredPerson.textContent = '(Click to Hide Details)'
        counter ++;
    }
})


let hideInjuredPerson = document.getElementById('hideInjured')
hideInjuredPerson.addEventListener('click', ()=> {
    injuredPerson.classList.toggle('injuredPerson')
    if (counter %2 === 1){
        hideInjuredPerson.textContent = '(Click to Show Details)'
        counter ++;
    } else {
        hideInjuredPerson.textContent = '(Click to Hide Details)'
        counter ++;
    }
}
)
accidentButton.addEventListener('click', () => {
        accident.classList.toggle('accident')
    if (counterA %2 === 1){
        hideAccidentInfo.textContent = '(Click to Show Details)'
        counterA ++;
    } else {
        hideAccidentInfo.textContent = '(Click to Hide Details)'
        counterA ++;
    }
})
let hideAccidentInfo = document.getElementById('hideAccident')
hideAccidentInfo.addEventListener('click', (e)=> {

    e.preventDefault();
    accident.classList.toggle('accident')
    if (counterA %2 === 1){
        hideAccidentInfo.textContent = '(Click to Show Details)'
        counterA ++;
    } else {
        hideAccidentInfo.textContent = '(Click to Hide Details)'
        counterA ++;
    }
}
)

injuryButton.addEventListener('click', () => {
     injury.classList.toggle('injury')
    if (counterB %2 === 1){
        hideInjuryInfo.textContent = '(Click to Show Details)'
        counterB ++;
    } else {
        hideInjuryInfo.textContent = '(Click to Hide Details)'
        counterB ++;
    }
})
let hideInjuryInfo = document.getElementById('hideInjury')
hideInjuryInfo.addEventListener('click', (e)=> {

    e.preventDefault();
    injury.classList.toggle('injury')
    if (counterB %2 === 1){
        hideInjuryInfo.textContent = '(Click to Show Details)'
        counterB ++;
    } else {
        hideInjuryInfo.textContent = '(Click to Hide Details)'
        counterB ++;
    }
}
)

employmentButton.addEventListener('click', () => {
    employment.classList.toggle('employment')
    if (counterC %2 === 1){
        hideEmploymentInfo.textContent = '(Click to Show Details)'
        counterC ++;
    } else {
        hideEmploymentInfo.textContent = '(Click to Hide Details)'
        counterC ++;
    }
})
let hideEmploymentInfo = document.getElementById('hideEmployment')
hideEmploymentInfo.addEventListener('click', (e)=> {

    e.preventDefault();
    employment.classList.toggle('employment')
    if (counterC %2 === 1){
        hideEmploymentInfo.textContent = '(Click to Show Details)'
        counterC ++;
    } else {
        hideEmploymentInfo.textContent = '(Click to Hide Details)'
        counterC ++;
    }
}
)

function checkId(section){
    console.log(section.id)
}

function closeButton(section, sectionTrigger, theCount, nextSection, nextSectionTrigger, nextCount){
 
    section.classList.toggle(section.id)
    
    if(theCount %2 === 1){
        sectionTrigger.textContent = '(Click to Show Details)'
        theCount ++;
    } else {
        sectionTrigger.textConent = '(Click to Hide Detials)'
        theCount++;
    }
    nextSection.classList.toggle(nextSection.id)
    if(nextCount %2 ===1){
        nextSectionTrigger.textContent = '(Click to Show Details)'
        nextCount ++;
    } else {
        nextSectionTrigger.textContent = '(Click to Hide Details)'
        nextCount++;
    }

    window.location.href ='#' + nextSection.id
}
let closeToNextInjured = document.getElementById('closeToNextInjured')
closeToNextInjured.addEventListener('click', ()=> {
    closeButton(injuredPerson, hideInjuredPerson, counter, accident, hideAccidentInfo, counterA)
})

let closeToNextAccident = document.getElementById('closeToNextAccident')
closeToNextAccident.addEventListener('click', ()=> {
    closeButton(accident, hideAccidentInfo, counterA, injury, hideInjuryInfo, counterB)
})

let closeToNextInjury = document.getElementById('closeToNextInjury')
closeToNextInjury.addEventListener('click', ()=> {
    closeButton(injury, hideInjuryInfo, counterB, employment, hideEmploymentInfo, counterC)
})

let closeToNextEmployment = document.getElementById('closeToNextEmployment')
closeToNextEmployment.addEventListener('click', ()=> {
    employment.classList.toggle('employment')
    if (counterC %2 === 1){
        hideEmploymentInfo.textContent = '(Click to Show Details)'
        counterC ++;
    } else {
        hideEmploymentInfo.textContent = '(Click to Hide Details)'
        counterC ++;
    }
    window.location.href= '#reviewAndSubmit'
})