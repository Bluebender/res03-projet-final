function eventsCreation(){
    let calendarEvents = document.getElementsByClassName("event");


    for (let calendarEvent of calendarEvents){
        calendarEvent.addEventListener("click", function(){
            let newEvent = calendarEvent.getAttribute("date")
            console.log(newEvent);
           
            let formData = new FormData();
            formData.append('newEvent', newEvent);
            
            // console.log(formData);
            
            const options = {
                method: 'POST',
                body: formData
            };
                
            fetch('http://vincentollivier.sites.3wa.io/res03-projet-final/chef-we-chef-!/mon-compte/createEvent', options)
            .then(response => response.json())
            .then(data => {
                // console.log(data);
            });  
            
            // window.location.href="http://vincentollivier.sites.3wa.io/res03-projet-final/chef-we-chef-!/mon-compte/calendar";

        });
    }
}

export { eventsCreation };