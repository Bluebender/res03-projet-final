function myCalendar(){
    let calendarEvents = document.getElementsByClassName("event");

    fetch('https://vincentollivier.sites.3wa.io/res03-projet-final/chef-we-chef-!/mon-compte/myCalendar')
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

function chiefCalendar(){
    let queryString = window.location.pathname;
    let chiefId = queryString.substring (queryString.lastIndexOf( "/" )+1 );
    console.log(chiefId);

    let calendarEvents = document.getElementsByClassName("event");
    
    fetch('https://vincentollivier.sites.3wa.io/res03-projet-final/chef-we-chef-!/chef/chefCalendar/'+chiefId)
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