<?php

class DefaultController extends AbstractController {
    private ChiefManager $chiefManag;

    public function __construct()
    {
        $this->chiefManag = new ChiefManager();
    }


    public function displayLoginForm()
    {
        $this->render("login-form", [""]);
    }


}