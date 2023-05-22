import { Chief } from './chief.js';

function registerFormTest(){
    
    // Formulaire
    let registerForm = document.getElementById('registerForm');

    registerForm.addEventListener('submit', (event)=>{

       let chief = new Chief();

       chief.firstName = document.getElementById("firstName").value;
       chief.lastName = document.getElementById("lastName").value;
       chief.chiefName = document.getElementById("chiefName").value;
       chief.email = document.getElementById("email").value;
       chief.firstPassword = document.getElementById("firstPassword").value;
       chief.secondPassword = document.getElementById("secondPassword").value;
       chief.phone = document.getElementById("phone").value;
       chief.image = document.getElementById("image").value;
       chief.descriptio = document.getElementById("description").value;
       chief.foodStyle = document.getElementById("foodStyle").value;

       if(!chief.validate())
       {
           event.preventDefault();
       }
    });
}

export { registerFormTest };