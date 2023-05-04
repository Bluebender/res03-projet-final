function loginForm(){
    
    // Form
    let loginForm = document.getElementById('login');
    
    // Inputs
    let loginEmail = document.getElementById('loginEmail');
    let loginPassword = document.getElementById('loginPassword');

    // Error messages
    let loginEmailError = document.getElementById('loginEmailError');
    let loginPasswordError = document.getElementById('loginPasswordError');

    loginForm.addEventListener('submit', (event)=>{

        let emailRegEx = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if(!emailRegEx.test(loginEmail.value)){
            loginEmailError.style.display = 'block';
            event.preventDefault();
        }
        else{
            loginEmailError.style.display = 'none';
        }

        let passwordRegEx = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/;
        if(!passwordRegEx.test(loginPassword.value)){
            loginPasswordError.style.display = 'block';
            event.preventDefault();
        }
        else{
            loginPasswordError.style.display = 'none';
        }

    });

}

export { loginForm };