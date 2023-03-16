<?php

class DefaultController extends AbstractController {
    private ChiefManager $chiefManag;

    public function __construct()
    {
        $this->chiefManag = new ChiefManager();
    }

    public function register($post)
    {
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
            && (isset($post["firstFoodStyle"]) && !empty($post["firstFoodStyle"]))
            && (isset($post["secondFoodStyle"]) && !empty($post["secondFoodStyle"]))){
            
                if($post["firstPassword"] === $post["secondPassword"]){
                    $hashPwd = password_hash($post["firstPassword"], PASSWORD_DEFAULT);
                    
                    // Chargement de la photo de profile
                    $uploader = new Uploader();
                    $media = $uploader->upload($_FILES, "image");
                    $profilePictureUrl = $media->getUrl();

                    $newChief = new Chief (null, $post["firstName"], $post["lastName"], $post["chiefName"], $post["email"], $hashPwd, $post["phone"], $profilePictureUrl, $post["description"], $post["firstFoodStyle"], $post["secondFoodStyle"]);
                    $this->chiefManag->createChief($newChief);

                    $chiefToConnect=$this->chiefManag->getChiefByEmail($post['email']);

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
        session_destroy();
        
        header('Location: /res03-projet-final/chef-we-chef-!');
    }
}