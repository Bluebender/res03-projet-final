import { myCalendar } from './calendar.js';
import { chiefCalendar } from './calendar.js';
import { eventsCreation } from './eventsCreation.js';


window.addEventListener("DOMContentLoaded", function(){  
console.log(window.location.toString().includes("/mon-compte"))
    if (window.location.toString().includes("/mon-compte")) {
        console.log("route01");
        
        myCalendar();
    }

    if (window.location.toString().includes("/chef/")) {
        console.log("route2");
        chiefCalendar();
    }

    if (window.location.toString().includes("/mon-compte/calendar")) {
        console.log("route3");
        eventsCreation();
    }

});
