<?php

class DefaultController extends AbstractController {
    private ChiefManager $chiefManag;

    public function __construct()
    {
        $this->chiefManag = new ChiefManager();
    }


    public function login($post)
    {   
        if (empty($post)){
            $this->render("visitor/login-form", [""]);
        }
        else {
            if ((isset($post["loginEmail"]) && !empty($post["loginEmail"]))
            && (isset($post["loginPassword"]) && !empty($post["loginPassword"]))){

                $allChiefs = $this->chiefManag->getAllChefs();
                $ChiefFind = false;
                foreach($allChiefs as $chief){
                    if ($post["loginEmail"] === $chief->getEmail())
                    $ChiefFind=true;
                } 
                

                if ($ChiefFind===false){
                    echo "adresse email inconnue";
                }
                else{
                    $chiefToConnect = $this->chiefManag->getChiefByEmail($post["loginEmail"]);
                    if(password_verify($post["loginPassword"], $chiefToConnect->getPassword())){
                        $_SESSION["connected"] = true;
                        $_SESSION["chiefId"] = $chiefToConnect->getId();
                        $_SESSION["chiefEmail"] = $chiefToConnect->getEmail();
                        $_SESSION["role"] = "chief";
                        
                        header('Location: mon-compte/'.$_SESSION["chiefId"]);
                    }
                    else{
                        echo "Mauvais mot de passe";
                    }
                }
            }
            else if(isset($post['loginEmail']) && empty($post['loginEmail'])){
                echo "Veuillez saisir votre email";
            }
            else if(isset($post['loginPassword']) && empty($post['loginPassword'])){
                echo "Veuillez saisir votre mot de passe";
            }
        }        
    }
    
    public function logout()
    {
        $_SESSION["connected"] = false;
        $_SESSION["chiefId"] = "";
        $_SESSION["chiefEmail"] = "";
        $_SESSION["role"] = "";
        
        header('Location: /res03-projet-final/chef-we-chef-!');
    }
}
    