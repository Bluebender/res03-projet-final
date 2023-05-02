function eventsCreation(requestUrlStart){
    let calendarEvents = document.getElementsByClassName("event");


    for (let calendarEvent of calendarEvents){
        calendarEvent.addEventListener("click", function(){
            let newEvent = calendarEvent.getAttribute("data-date");

            let formData = new FormData();
            formData.append('newEvent', newEvent);

            const options = {
                method: 'POST',
                body: formData
            };
                
            fetch(requestUrlStart+'/mon-compte/createEvent', options)
            .then(response => response.json())
            .then(data => {
                // console.log(data);
            window.location.href=requestUrlStart+"/mon-compte/calendar";
            });  
        });
    }
}

export { eventsCreation };