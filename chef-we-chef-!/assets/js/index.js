import { myCalendar } from './calendar.js';
import { chiefCalendar } from './calendar.js';
import { eventsCreation } from './eventsCreation.js';


window.addEventListener("DOMContentLoaded", function(){  

    if (window.location.toString().includes("/mon-compte")) {
        console.log("route1");
        myCalendar();
    }

    if (window.location.toString().includes("/chef&id")) {
        console.log("route2");
        chiefCalendar();
    }

    if (window.location.toString().includes("/mon-compte/calendar")) {
        console.log("route3");
        eventsCreation();
    }

});
