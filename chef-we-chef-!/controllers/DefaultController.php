<?php

class DefaultController extends AbstractController {
    private ChiefManager $chiefManag;
    private FoodStyleManager $foodStyleManag;
    private AdminManager $adminManag;

    public function __construct()
    {
        $this->chiefManag = new ChiefManager();
        $this->foodStyleManag = new FoodStyleManager();
        $this->adminManag = new AdminManager();
    }

    public function register($post){

        $foodstyles = $this->foodStyleManag->getAllFoodStyles();
        $errorMessage = "";
        $data ["foodstyles"] = $foodstyles;
        $data ["errorMessage"] = $errorMessage;
        

        if (empty($post)){
            $this->render("visitor/register-form", $data);
        }
        else {
            if ((isset($post["firstName"]) && !empty($post["firstName"]))
            && (isset($post["lastName"]) && !empty($post["lastName"]))
            && (isset($post["chiefName"]) && !empty($post["chiefName"]))
            && (isset($post["email"]) && !empty($post["email"]))
            && (isset($post["firstPassword"]) && !empty($post["firstPassword"]))
            && (isset($post["secondPassword"]) && !empty($post["secondPassword"]))
            && (isset($post["phone"]) && !empty($post["phone"]))
            && (isset($_FILES) && !empty($_FILES["image"]["name"]))
            && (isset($post["description"]) && !empty($post["description"]))
            && (isset($post["foodStyle"]) && !empty($post["foodStyle"]))){
            
                // Sanitisation des données du formulaire
                $firstName      = $this->sanitize($post["firstName"]);
                $lastName       = $this->sanitize($post["lastName"]);
                $chiefName      = $this->sanitize($post["chiefName"]);
                $email          = $this->sanitize($post["email"]);
                $firstPassword  = $this->sanitize($post["firstPassword"]);
                $secondPassword = $this->sanitize($post["secondPassword"]);
                $phone          = $this->sanitize($post["phone"]);
                $description    = $this->sanitize($post["description"]);
                $foodStyle      = $this->sanitize($post["foodStyle"]);

                // vérification que l'adresse email est disponible
                $chiefs = $this->chiefManag->getAllChefs();
                $emailFree = true;
                foreach ($chiefs as $chief){
                    if($chief->getEmail()===$email){
                        $emailFree = false;
                    }
                }
                if ($emailFree===false){
                    $errorMessage = "adresse email non disponible";
                    $data ["errorMessage"] = $errorMessage;
                    
                    $this->render("visitor/register-form", $data);
                }
                else{
                    if($firstPassword === $secondPassword){
                        $hashPwd = password_hash($firstPassword, PASSWORD_DEFAULT);
                        
                        // Chargement de la photo de profile
                        $uploader = new Uploader();
                        $media = $uploader->upload($_FILES, "image");
                        $profilePictureUrl = $media->getUrl();
    
                        // Création du chef
                        $newChief = new Chief (null, $firstName, $lastName, $chiefName, $email, $hashPwd, $phone, $profilePictureUrl, $description, $foodStyle);
                        $this->chiefManag->createChief($newChief);
    
                        $chiefToConnect=$this->chiefManag->getChiefByEmail($email);
    
                        $_SESSION["connected"] = true;
                        $_SESSION["chiefId"] = $chiefToConnect->getId();
                        $_SESSION["chiefEmail"] = $chiefToConnect->getEmail();
                        $_SESSION["chiefName"] = $chiefToConnect->getChiefName();
                        $_SESSION["chiefPicture"] = $chiefToConnect->getProfilPictureUrl();
                        $_SESSION["role"] = "chief";
                        
                        header('Location: mon-compte');
                    }
                    else{
                        $errorMessage = "Les mots de passe sont différents !";
                        $data ["errorMessage"] = $errorMessage;
                        
                        $this->render("visitor/register-form", $data);
                    }
                }
            }
            else if(isset($post['firstName']) && empty($post['firstName'])){
                $errorMessage = "Veuillez saisir votre prénom";
                $data ["errorMessage"] = $errorMessage;
                
                $this->render("visitor/register-form", $data);
            }
            else if(isset($post['lastName']) && empty($post['lastName'])){
                $errorMessage = "Veuillez saisir votre nom";
                $data ["errorMessage"] = $errorMessage;
                
                $this->render("visitor/register-form", $data);
            }
            else if(isset($post['chiefName']) && empty($post['chiefName'])){
                $errorMessage = "Veuillez saisir votre nom de chef";
                $data ["errorMessage"] = $errorMessage;
                
                $this->render("visitor/register-form", $data);
            }
            else if(isset($post['email']) && empty($post['email'])){
                $errorMessage = "Veuillez saisir votre email";
                $data ["errorMessage"] = $errorMessage;
                
                $this->render("visitor/register-form", $data);
            }
            else if(isset($post['firstPassword']) && empty($post['firstPassword'])){
                $errorMessage = "Veuillez saisir votre mot de passe";
                $data ["errorMessage"] = $errorMessage;
                
                $this->render("visitor/register-form", $data);
            }
            else if(isset($post['secondPassword']) && empty($post['secondPassword'])){
                $errorMessage = "Veuillez confirmer votre mot de passe";
                $data ["errorMessage"] = $errorMessage;
                
                $this->render("visitor/register-form", $data);
            }
            else if(isset($post['phone']) && empty($post['phone'])){
                $errorMessage = "Veuillez saisir votre numéro de téléphone";
                $data ["errorMessage"] = $errorMessage;
                
                $this->render("visitor/register-form", $data);
            }
            else if(isset($_FILES) && empty($_FILES["image"]["name"])){
                $errorMessage = "Veuillez charger votre photo de profil";
                $data ["errorMessage"] = $errorMessage;
                
                $this->render("visitor/register-form", $data);
            }
            else if(isset($post['description']) && empty($post['description'])){
                $errorMessage = "Veuillez saisir votre déscription";
                $data ["errorMessage"] = $errorMessage;
                
                $this->render("visitor/register-form", $data);
            }
            else if(isset($post['firstFoodStyle']) && empty($post['firstFoodStyle'])){
                $errorMessage = "Veuillez choisir un premier style de cuisine";
                $data ["errorMessage"] = $errorMessage;
                
                $this->render("visitor/register-form", $data);
            }
        }
    }

    public function login($post){

        $errorMessage = "";
        $data ["errorMessage"] = $errorMessage;

        if (empty($post)){
            $this->render("visitor/login-form", $data);
        }
        else {
            if ((isset($post["loginEmail"]) && !empty($post["loginEmail"]))
            && (isset($post["loginPassword"]) && !empty($post["loginPassword"]))){

                // Sanitisation des données du formulaire
                $loginEmail     = $this->sanitize($post["loginEmail"]);
                $loginPassword  = $this->sanitize($post["loginPassword"]);

                if($loginEmail==="admin@admin.fr"){
                    $admin = $this->adminManag->getAdmin();
                    if(password_verify($loginPassword, $admin->getPassword())){
                        $_SESSION["connected"] = true;
                        $_SESSION["role"] = "admin";
                        
                        header('Location: admin');
                    }
                    else{
                        $errorMessage = "Problème d'autentification, merci de vérifier votre email et votre mot de passe";
                        $data ["errorMessage"] = $errorMessage;

                        $this->render("visitor/login-form", $data);
                    }
                }
                else{
                    $allChiefs = $this->chiefManag->getAllChefs();
                    $ChiefFind = false;
                    foreach($allChiefs as $chief){
                        if ($loginEmail === $chief->getEmail())
                        $ChiefFind=true;
                    } 
                    
    
                    if ($ChiefFind===false){
                        $errorMessage = "Problème d'autentification, merci de vérifier votre email et votre mot de passe";
                        $data ["errorMessage"] = $errorMessage;

                        $this->render("visitor/login-form", $data);
                    }
                    else{
                        $chiefToConnect = $this->chiefManag->getChiefByEmail($loginEmail);
                        if(password_verify($loginPassword, $chiefToConnect->getPassword())){
                            $_SESSION["connected"] = true;
                            $_SESSION["chiefId"] = $chiefToConnect->getId();
                            $_SESSION["chiefEmail"] = $chiefToConnect->getEmail();
                            $_SESSION["chiefName"] = $chiefToConnect->getChiefName();
                            $_SESSION["chiefPicture"] = $chiefToConnect->getProfilPictureUrl();
                            $_SESSION["role"] = "chief";
                            
                            header('Location: mon-compte');
                        }
                        else{
                            $errorMessage = "Problème d'autentification, merci de vérifier votre email et votre mot de passe";
                            $data ["errorMessage"] = $errorMessage;
    
                            $this->render("visitor/login-form", $data);
                        }
                    }
                }
            }
            else if(isset($post['loginEmail']) && empty($post['loginEmail'])){
                $errorMessage = "Problème d'autentification, merci de vérifier votre email et votre mot de passe";
                $data ["errorMessage"] = $errorMessage;

                $this->render("visitor/login-form", $data);
            }
            else if(isset($post['loginPassword']) && empty($post['loginPassword'])){
                $errorMessage = "Problème d'autentification, merci de vérifier votre email et votre mot de passe";
                $data ["errorMessage"] = $errorMessage;

                $this->render("visitor/login-form", $data);
            }
        }        
    }
    
    public function logout(){
        session_destroy();
        
        header('Location: /res03-projet-final/chef-we-chef-!');
    }
    
    public function erreur404(){
        $this->render("404", [""]);
    }

}