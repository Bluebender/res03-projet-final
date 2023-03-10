<?php

class DefaultController extends AbstractController {
    private ChiefManager $chiefManag;

    public function __construct()
    {
        $this->chiefManag = new ChiefManager();
    }

    public function displayRegisterForm()
    {
        $this->render("register-form", [""]);
    }

    public function displayLoginForm()
    {
        $this->render("login-form", [""]);
    }


}