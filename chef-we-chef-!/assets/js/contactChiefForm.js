function contactChiefForm(){

    // Form
    let contactChiefForm = document.getElementById('contactChiefForm');

    // Inputs
    let title = document.getElementById('title');
    let email = document.getElementById('email');
    let message = document.getElementById('message');

    // Error messages
    let titleError = document.getElementById('titleError');
    let emailError = document.getElementById('emailError');
    let messageError = document.getElementById('messageError');

    contactChiefForm.addEventListener('submit', (event)=>{

        let titleRegEx = /^[0-9a-zA-ZÀ-ÖØ-öø-ÿ\s-':]{2,100}$/;
        if(!titleRegEx.test(title.value)){
            titleError.style.display = 'block';
            event.preventDefault();
        }
        else{
            titleError.style.display = 'none';
        }

        let emailRegEx = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if(!emailRegEx.test(email.value)){
            emailError.style.display = 'block';
            event.preventDefault();
        }
        else{
            emailError.style.display = 'none';
        }

        let messageRegEx = /^[a-zA-ZÀ-ÖØ-öø-ÿ0-9\s-.,;:!?'()]+$/;
        if(!messageRegEx.test(message.value)){
            messageError.style.display = 'block';
            event.preventDefault();
        }
        else{
            messageError.style.display = 'none';
        }


    });
}

export { contactChiefForm };