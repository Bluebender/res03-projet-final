function myCalendar(requestUrlStart){
    
    let calendarEvents = document.getElementsByClassName("event");
    console.log(requestUrlStart+'/mon-compte/myCalendar');
    fetch(requestUrlStart+'/mon-compte/myCalendar')
    .then(response => response.json())
    .then(data => {
        let chiefEvents=data;

        // on vérifie si un evenement du Calendar est Booked ou non    
        for (let calendarEvent of calendarEvents){
            for (let chiefEvent of chiefEvents){
                if(calendarEvent.getAttribute("date")===chiefEvent.event+"-"+chiefEvent.slot){
                    if(chiefEvent.availablity){
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

export { myCalendar };

function chiefCalendar(requestUrlStart){
    let queryString = window.location.pathname;
    let chiefId = queryString.substring (queryString.lastIndexOf( "=" )+1 );

    let calendarEvents = document.getElementsByClassName("event");

    fetch(requestUrlStart+'/chefCalendar&id='+chiefId)
    .then(response => response.json())
    .then(data => {
        let chiefEvents=data;

        // on vérifie si un evenement du Calendar est Booked ou non    
        for (let calendarEvent of calendarEvents){

            for (let chiefEvent of chiefEvents){
                if(calendarEvent.getAttribute("date")===chiefEvent.event+"-"+chiefEvent.slot){
                    if(chiefEvent.availablity){
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

export { chiefCalendar };