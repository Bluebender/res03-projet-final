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
        if (empty($post)){
            $foodstyles = $this->foodStyleManag->getAllFoodStyles();
            $this->render("visitor/register-form", $foodstyles);
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
                    echo"adresse email non disponible";
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
                        echo "Les mots de passe sont différents !";
                    }
                }
            }
            else if(isset($post['firstName']) && empty($post['firstName'])){
                echo "Veuillez saisir votre prénom";
            }
            else if(isset($post['lastName']) && empty($post['lastName'])){
                echo "Veuillez saisir votre nom";
            }
            else if(isset($post['chiefName']) && empty($post['chiefName'])){
                echo "Veuillez saisir votre nom de chef";
            }
            else if(isset($post['email']) && empty($post['email'])){
                echo "Veuillez saisir votre email";
            }
            else if(isset($post['firstPassword']) && empty($post['firstPassword'])){
                echo "Veuillez saisir votre mot de passe";
            }
            else if(isset($post['secondPassword']) && empty($post['secondPassword'])){
                echo "Veuillez confirmer votre mot de passe";
            }
            else if(isset($post['phone']) && empty($post['phone'])){
                echo "Veuillez saisir votre numéro de téléphone";
            }
            else if(isset($_FILES) && empty($_FILES["image"]["name"])){
                echo "Veuillez charger votre photo de profil";
            }
            else if(isset($post['description']) && empty($post['description'])){
                echo "Veuillez saisir votre déscription";
            }
            else if(isset($post['firstFoodStyle']) && empty($post['firstFoodStyle'])){
                echo "Veuillez choisir un premier style de cuisine";
            }
            else if(isset($post['secondFoodStyle']) && empty($post['secondFoodStyle'])){
                echo "Veuillez choisir un second style de cuisine";
            }
        }
    }

    public function login($post){   
        if (empty($post)){
            $this->render("visitor/login-form", [""]);
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
                        echo "Mauvais mot de passe";
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
                        echo "adresse email inconnue";
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
                            echo "Mauvais mot de passe";
                        }
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
    
    public function logout(){
        session_destroy();
        
        header('Location: /res03-projet-final/chef-we-chef-!');
    }
    
    public function erreur404(){
        $this->render("404", [""]);
    }

}