function contactUsForm(){

    // Form
    let contactUsForm = document.getElementById('contactUsForm');

    // Inputs
    let contactSubject = document.getElementById('contactSubject');
    let contactEmail = document.getElementById('contactEmail');
    let contactDescription = document.getElementById('contactDescription');

    // Error messages
    let contactSubjectError = document.getElementById('contactSubjectError');
    let contactEmailError = document.getElementById('contactEmailError');
    let contactDescriptionError = document.getElementById('contactDescriptionError');

    contactUsForm.addEventListener('submit', (event)=>{

        let titleRegEx = /^[0-9a-zA-ZÀ-ÖØ-öø-ÿ\s-':]{2,100}$/;
        if(!titleRegEx.test(contactSubject.value)){
            contactSubjectError.style.display = 'block';
            event.preventDefault();
        }
        else{
            contactSubjectError.style.display = 'none';
        }

        let emailRegEx = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if(!emailRegEx.test(contactEmail.value)){
            contactEmailError.style.display = 'block';
            event.preventDefault();
        }
        else{
            contactEmailError.style.display = 'none';
        }

        let messageRegEx = /^[a-zA-ZÀ-ÖØ-öø-ÿ0-9\s-.,;:!?'()]+$/;
        if(!messageRegEx.test(contactDescription.value)){
            contactDescriptionError.style.display = 'block';
            event.preventDefault();
        }
        else{
            contactDescriptionError.style.display = 'none';
        }


    });
}

export { contactUsForm };