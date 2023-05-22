export class Dish {
    dishName;
    image;
    descriptio;
    dishPrice;
    dishFoodStyle;
    dishCategory;

    constructor(dishName = "", image = "", descriptio = "", dishPrice = "", dishFoodStyle = "", dishCategory = "") {
        this.dishName = dishName;
        this.image = image;
        this.descriptio = descriptio;
        this.dishPrice = dishPrice;
        this.dishFoodStyle = dishFoodStyle;
        this.dishCategory = dishCategory;
    }

    get dishName () {
      return this.dishName;
    }

    set dishName (dishName) {
        this.dishName = dishName;
    }

    get image () {
      return this.image;
    }

    set image (image) {
        this.image = image;
    }

    get descriptio () {
        return this.descriptio;
    }

    set descriptio (descriptio) {
        this.descriptio = descriptio;
    }

    get dishPrice () {
        return this.dishPrice;
    }

    set dishPrice (dishPrice) {
        this.dishPrice = dishPrice;
    }

    get dishFoodStyle () {
        return this.dishFoodStyle;
    }

    set dishFoodStyle (dishFoodStyle) {
        this.dishFoodStyle = dishFoodStyle;
    }

    get dishCategory () {
        return this.dishCategory;
    }

    set dishCategory (dishCategory) {
        this.dishCategory = dishCategory;
    }

    validate() {
        if(this.checkDishName() === true &&
        this.checkImage() === true &&
        this.checkDescriptio() === true &&
        this.checkDishPrice() === true &&
        this.checkDishFoodStyle() === true &&
        this.checkDishCategory() === true)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    checkDishName() {
        let dishNameError = document.getElementById('dishNameError');
        let dishNameRegEx = /^[a-zA-ZÀ-ÖØ-öø-ÿ\s-']{2,50}$/;
        if(!dishNameRegEx.test(this.dishName)){
            dishNameError.style.display = 'block';
            return false;
        }
        else{
            dishNameError.style.display = 'none';
            return true;
        }
    }

    checkImage() {
        let imageError = document.getElementById('imageError');
        let imageRegEx = /.(jpe?g|pdf|png|JPE?G)$/;
        
        if(!imageRegEx.test(this.image)){
            imageError.style.display = 'block';
            return false;
        }
        else{
            imageError.style.display = 'none';
            return true;
        }
    }

    checkDescriptio() {
        let descriptionError = document.getElementById('descriptionError');
        let descriptionRegEx = /^[a-zA-ZÀ-ÖØ-öø-ÿ0-9\s-.,;:!?'()]+$/;

        if(!descriptionRegEx.test(this.descriptio)){
            descriptionError.style.display = 'block';
            return false;
        }
        else{
            descriptionError.style.display = 'none';
            return true;
        }
    }

    checkDishPrice() {
        let dishPriceError = document.getElementById('dishPriceError');
        let priceRegEx = /^\d+(?:\.\d{1,2})?$/;

        if(!priceRegEx.test(this.dishPrice)){
            dishPriceError.style.display = 'block';
            return false;
        }
        else{
            dishPriceError.style.display = 'none';
            return true;
        }
    }

    checkDishFoodStyle() {
        let dishFoodStyleError = document.getElementById('dishFoodStyleError');
        let foodStyleRegEx = /^[0-9]+$/;

        if(!foodStyleRegEx.test(this.dishFoodStyle)){
            dishFoodStyleError.style.display = 'block';
            return false;
        }
        else{
            dishFoodStyleError.style.display = 'none';
            return true;
        }
    }

    checkDishCategory() {
        let dishCategoryError = document.getElementById('dishCategoryError');
        let categoryRegEx = /^[0-9]+$/;

        if(!categoryRegEx.test(this.dishCategory)){
            dishCategoryError.style.display = 'block';
            return false;
        }
        else{
            dishCategoryError.style.display = 'none';
            return true;
        }
    }
}

