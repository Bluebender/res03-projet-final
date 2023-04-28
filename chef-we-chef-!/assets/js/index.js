import { myCalendar } from './calendar.js';
import { chiefCalendar } from './calendar.js';
import { eventsCreation } from './eventsCreation.js';
import { registerForm } from './registerForm.js';



window.addEventListener("DOMContentLoaded", function(){  

    // URL start verification. If URL start by https, FETCH url start with https. If not FETCH url start with http 
    let url = window.location.href;
    let urlStart = url.substr(0, 5);
    let requestUrlStart;
    if(urlStart === "https"){
        requestUrlStart='https://vincentollivier.sites.3wa.io/res03-projet-final/chef-we-chef-!';
    }
    else{
        requestUrlStart ='http://vincentollivier.sites.3wa.io/res03-projet-final/chef-we-chef-!';
    }



    if (window.location.toString().includes("/mon-compte")) {
        console.log("route1");
        myCalendar(requestUrlStart);
    }

    if (window.location.toString().includes("/chef&id")) {
        console.log("route2");
        chiefCalendar(requestUrlStart);
    }

    if (window.location.toString().includes("/mon-compte/calendar")) {
        console.log("route3");
        eventsCreation(requestUrlStart);
    }

    if (window.location.toString().includes("/inscription")) {
        console.log("route4");
        registerForm();
    }

});