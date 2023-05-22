import { Dish } from './dish.js';

function createDishFormTest(){

    // Formulaire
    let createDish = document.getElementById('createDish');
    
    createDish.addEventListener('submit', (event)=>{

       let dish = new Dish();

       dish.dishName = document.getElementById("dishName").value;
       dish.image = document.getElementById("image").value;
       dish.descriptio = document.getElementById("description").value;
       dish.dishPrice = document.getElementById("dishPrice").value;
       dish.dishFoodStyle = document.getElementById("dishFoodStyle").value;
       dish.dishCategory = document.getElementById("dishCategory").value;

       if(!dish.validate())
       {
           event.preventDefault();
       }
    });
}

export { createDishFormTest };