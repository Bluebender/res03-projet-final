function registerForm(){
    
    // Form
    let registerForm = document.getElementById('registerForm');
    
    // Inputs
    let firstName = document.getElementById('firstName');
    let lastName = document.getElementById('lastName');
    let chiefName = document.getElementById('chiefName');
    let email = document.getElementById('email');
    let firstPassword = document.getElementById('firstPassword');
    let secondPassword = document.getElementById('secondPassword');
    let phone = document.getElementById('phone');
    let image = document.getElementById('image');
    let description = document.getElementById('description');
    let foodStyle = document.getElementById('foodStyle');
    
    // Error messages
    let firstNameError = document.getElementById('firstNameError');
    let lastNameError = document.getElementById('lastNameError');
    let chiefNameError = document.getElementById('chiefNameError');
    let emailError = document.getElementById('emailError');
    let firstPasswordError = document.getElementById('firstPasswordError');
    let secondPasswordError = document.getElementById('secondPasswordError');
    let phoneError = document.getElementById('phoneError');
    let imageError = document.getElementById('imageError');
    let descriptionError = document.getElementById('descriptionError');
    let foodStyleError = document.getElementById('foodStyleError');

    registerForm.addEventListener('submit', (event)=>{
                console.log(foodStyle.length);

        let firstNameRegEx = /^[a-zA-ZÀ-ÖØ-öø-ÿ\s-']{2,50}$/;
        if(!firstNameRegEx.test(firstName.value)){
            firstNameError.style.display = 'block';
            event.preventDefault();
        }
        else{
            firstNameError.style.display = 'none';
        }

        
        let lastNameRegEx = /^[a-zA-ZÀ-ÖØ-öø-ÿ\s-']{2,50}$/;
        if(!lastNameRegEx.test(lastName.value)){
            lastNameError.style.display = 'block';
            event.preventDefault();
        }
        else{
            lastNameError.style.display = 'none';
        }

        let chiefNameRegEx = /^[a-zA-ZÀ-ÖØ-öø-ÿ\s-']{2,50}$/;
        if(!chiefNameRegEx.test(chiefName.value)){
            chiefNameError.style.display = 'block';
            event.preventDefault();
        }
        else{
            chiefNameError.style.display = 'none';
        }

        let emailRegEx = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if(!emailRegEx.test(email.value)){
            emailError.style.display = 'block';
            event.preventDefault();
        }
        else{
            emailError.style.display = 'none';
        }

        let firstPasswordRegEx = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/;
        if(!firstPasswordRegEx.test(firstPassword.value)){
            firstPasswordError.style.display = 'block';
            event.preventDefault();
        }
        else{
            firstPasswordError.style.display = 'none';
        }

        if(secondPassword.value != firstPassword.value){
            secondPasswordError.style.display = 'block';
            event.preventDefault();
        }
        else{
            secondPasswordError.style.display = 'none';
        }

        let phoneRegEx = /^0[1-9](\-|\s)?(\d{2}(\-|\s)?){4}$/;
        if(!phoneRegEx.test(phone.value)){
            phoneError.style.display = 'block';
            event.preventDefault();
        }
        else{
            phoneError.style.display = 'none';
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

        let foodStyleRegEx = /^[0-9]+$/;
        if(!foodStyleRegEx.test(foodStyle.value)){
            foodStyleError.style.display = 'block';
            event.preventDefault();
        }
        else{
            foodStyleError.style.display = 'none';
        }

    });

}

export { registerForm };