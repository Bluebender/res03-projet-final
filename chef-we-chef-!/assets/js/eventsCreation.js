function eventsCreation(){
    let calendarEvents = document.getElementsByClassName("event");
    console.log(calendarEvents);

    

    fetch('http://vincentollivier.sites.3wa.io/res03-projet-final/chef-we-chef-!/mon-compte/myCalendar')
    .then(response => response.json())
    .then(data => {
        console.log(data);
        let chiefEvents=data;
        
        console.log(window.location.toString())
        
        // on vérifie si un evenement du Calendar est Booked ou non    
        for (let calendarEvent of calendarEvents){
            for (let chiefEvent of chiefEvents){
                if(calendarEvent.getAttribute("date")===chiefEvent.event+"-"+chiefEvent.slot){
                    console.log (calendarEvent.getAttribute("date"), chiefEvent.event+"-"+chiefEvent.slot);
                    if(chiefEvent.availablity){
                        console.log(chiefEvent.event);
                        calendarEvent.classList.add("available");
                    }
                    else{
                        calendarEvent.classList.add("booked");
                    }
                }
            }
        }            
    });
}

export { eventsCreation };