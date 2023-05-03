import { myCalendar } from './calendar.js';
import { chiefCalendar } from './calendar.js';
import { eventsCreation } from './eventsCreation.js';
import { registerForm } from './registerForm.js';
import { asideMenu } from './asideMenu.js';
import { loginForm } from './loginForm.js';
import { createDishForm } from './createDishForm.js';
import { contactChiefForm } from './contactChiefForm.js';
import { contactUsForm } from './contactUsForm.js';



window.addEventListener("DOMContentLoaded", function(){  

    asideMenu();
    contactUsForm();

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
    
    if (window.location.toString().includes("/connexion")) {
        console.log("route5");
        loginForm();
    }
    
    if (window.location.toString().includes("/plat/creer")) {
        console.log("route6");
        createDishForm();
    }
    
    if (window.location.toString().includes("/contactChief")) {
        console.log("route7");
        contactChiefForm();
    }
    
    

});