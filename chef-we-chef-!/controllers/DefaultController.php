<?php

class DefaultController extends AbstractController {
    private ChiefManager $chiefManag;

    public function __construct()
    {
        $this->chiefManag = new ChiefManager();
    }

    public function displayRegisterForm()
    {
        echo "RegisterForm";
        $this->render("register-form", [""]);
    }

    public function displayLoginForm()
    {
        echo "LoginForm";
        $this->render("login-form", [""]);
    }


}