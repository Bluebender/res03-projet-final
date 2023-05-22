export class Chief {
    firstName;
    lastName;
    chiefName;
    email;
    firstPassword;
    secondPassword;
    phone;
    image;
    descriptio;
    foodStyle;
    
    constructor(firstName = "", lastName = "", chiefName = "", email = "", firstPassword = "", secondPassword = "", phone = "", image = "", descriptio = "", foodStyle ="") {
        this.firstName = firstName;
        this.lastName = lastName;
        this.chiefName = chiefName;
        this.email = email;
        this.firstPassword = firstPassword;
        this.secondPassword = secondPassword;
        this.phone = phone;
        this.image = image;
        this.descriptio = descriptio;
        this.foodStyle = foodStyle;
        
    }

    get firstName () {
      return this.firstName;
    }

    set firstName (firstName) {
        this.firstName = firstName;
    }

    get lastName () {
      return this.lastName;
    }

    set lastName (lastName) {
        this.lastName = lastName;
    }

    get chiefName () {
        return this.chiefName;
    }

    set chiefName (chiefName) {
        this.chiefName = chiefName;
    }

    get email () {
        return this.email;
    }

    set email (email) {
        this.email = email;
    }

    get firstPassword () {
        return this.firstPassword;
    }

    set firstPassword (firstPassword) {
        this.firstPassword = firstPassword;
    }

    get secondPassword () {
        return this.secondPassword;
    }

    set secondPassword (secondPassword) {
        this.secondPassword = secondPassword;
    }

    get phone () {
        return this.phone;
    }

    set phone (phone) {
        this.phone = phone;
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

    get foodStyle () {
        return this.foodStyle;
    }

    set foodStyle (foodStyle) {
        this.foodStyle = foodStyle;
    }

    validate() {
        if(this.checkFirstName() === true &&
        this.checkLastName() === true &&
        this.checkChiefName() === true &&
        this.checkEmail() === true &&
        this.checkFirstPassword() === true &&
        this.checkSecondPassword() === true &&
        this.checkPhone() === true &&
        this.checkImage() === true &&
        this.checkDescriptio() === true &&
        this.checkFoodStyle() === true)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    checkFirstName() {
        let firstNameError = document.getElementById('firstNameError');
        let firstNameRegEx = /^[a-zA-ZÀ-ÖØ-öø-ÿ\s-']{2,50}$/;
        if(!firstNameRegEx.test(this.firstName)){
            firstNameError.style.display = 'block';
            return false;
        }
        else{
            firstNameError.style.display = 'none';
            return true;
        }
    }

    checkLastName() {
        let lastNameError = document.getElementById('lastNameError');
        let lastNameRegEx = /^[a-zA-ZÀ-ÖØ-öø-ÿ\s-']{2,50}$/;
        if(!lastNameRegEx.test(this.lastName)){
            lastNameError.style.display = 'block';
            return false;
        }
        else{
            lastNameError.style.display = 'none';
            return true;
        }
    }

    checkChiefName() {
        let chiefNameError = document.getElementById('chiefNameError');
        let chiefNameRegEx = /^[a-zA-ZÀ-ÖØ-öø-ÿ\s-']{2,50}$/;
        if(!chiefNameRegEx.test(this.chiefName)){
            chiefNameError.style.display = 'block';
            return false;
        }
        else{
            chiefNameError.style.display = 'none';
            return true;
        }
    }

    checkEmail() {
        let emailError = document.getElementById('emailError');
        let emailRegEx = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if(!emailRegEx.test(this.email)){
            emailError.style.display = 'block';
            return false;
        }
        else{
            emailError.style.display = 'none';
            return true;
        }
    }

    checkFirstPassword() {
        let firstPasswordError = document.getElementById('firstPasswordError');
        let firstPasswordRegEx = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/;
        if(!firstPasswordRegEx.test(this.firstPassword)){
            firstPasswordError.style.display = 'block';
            return false;
        }
        else{
            firstPasswordError.style.display = 'none';
            return true;
        }
    }

    checkSecondPassword() {
        let secondPasswordError = document.getElementById('secondPasswordError');
        if(this.secondPassword != this.firstPassword){
            secondPasswordError.style.display = 'block';
            return false;
        }
        else{
            secondPasswordError.style.display = 'none';
            return true;
        }
    }

    checkPhone() {
        let phoneError = document.getElementById('phoneError');
        let phoneRegEx = /^0[1-9](\-|\s)?(\d{2}(\-|\s)?){4}$/;
        if(!phoneRegEx.test(this.phone)){
            phoneError.style.display = 'block';
            return false;
        }
        else{
            phoneError.style.display = 'none';
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

    checkFoodStyle() {
        let foodStyleError = document.getElementById('foodStyleError');
        let foodStyleRegEx = /^[0-9]+$/;
        if(!foodStyleRegEx.test(this.foodStyle)){
            foodStyleError.style.display = 'block';
            return false;
        }
        else{
            foodStyleError.style.display = 'none';
            return true;
        }
    }
    
}

