function createDishForm(){
    
    // Form
    let createDish = document.getElementById('createDish');
    
    // Inputs
    let dishName = document.getElementById('dishName');
    let image = document.getElementById('image');
    let description = document.getElementById('description');
    let dishPrice = document.getElementById('dishPrice');
    let dishFoodStyle = document.getElementById('dishFoodStyle');
    let dishCategory = document.getElementById('dishCategory');

    // Error messages
    let dishNameError = document.getElementById('dishNameError');
    let imageError = document.getElementById('imageError');
    let descriptionError = document.getElementById('descriptionError');
    let dishPriceError = document.getElementById('dishPriceError');
    let dishFoodStyleError = document.getElementById('dishFoodStyleError');
    let dishCategoryError = document.getElementById('dishCategoryError');

    createDish.addEventListener('submit', (event)=>{

        let dishNameRegEx = /^[a-zA-ZÀ-ÖØ-öø-ÿ\s-']{2,50}$/;
        if(!dishNameRegEx.test(dishName.value)){
            dishNameError.style.display = 'block';
            event.preventDefault();
        }
        else{
            dishNameError.style.display = 'none';
        }

        let imageRegEx = /.(jpe?g|pdf|png|JPE?G)$/;
        if(!imageRegEx.test(image.value)){
            imageError.style.display = 'block';
            event.preventDefault();
        }
        else{
            imageError.style.display = 'none';
        }

        let descriptionRegEx = /^[a-zA-ZÀ-ÖØ-öø-ÿ0-9\s-.,;:!?'()]+$/;
        if(!descriptionRegEx.test(description.value)){
            descriptionError.style.display = 'block';
            event.preventDefault();
        }
        else{
            descriptionError.style.display = 'none';
        }

        let priceRegEx = /^\d+(?:\.\d{1,2})?$/;
        if(!priceRegEx.test(dishPrice.value)){
            dishPriceError.style.display = 'block';
            event.preventDefault();
        }
        else{
            dishPriceError.style.display = 'none';
        }

        let foodStyleRegEx = /^[0-9]+$/;
        if(!foodStyleRegEx.test(dishFoodStyle.value)){
            dishFoodStyleError.style.display = 'block';
            event.preventDefault();
        }
        else{
            dishFoodStyleError.style.display = 'none';
        }

        let categoryRegEx = /^[0-9]+$/;
        if(!categoryRegEx.test(dishCategory.value)){
            dishCategoryError.style.display = 'block';
            event.preventDefault();
        }
        else{
            dishCategoryError.style.display = 'none';
        }

    });

}

export { createDishForm };