<?php

class ChiefController extends AbstractController {
    private ChiefManager $chiefManag;
    private FoodStyleManager $foodStyleManag;
    private DishManager $dishManag;

    public function __construct()
    {
        $this->chiefManag = new ChiefManager();
        $this->foodStyleManag = new FoodStyleManager();
        $this->dishManag = new DishManager();
    }

    private function createData()
    {
        // get all the chiefs from the manager
        $allChiefs = $this->chiefManag->getAllChefs();
        
        $allChiefsWithFoodStyleAndSpecialDish=[];
        foreach ($allChiefs as $chief){
            // Je cré le tableau de donnée et j'y ajoute le chef
            $chiefWithFoodStyleAndSpecialDish=[];
            $chiefWithFoodStyleAndSpecialDish[] = $chief;

            // Je vais chercher le food-style qui va avec le plat et je l'ajoute au tableau           
            $foodStyleId1 = $chief->getFirstFoodStyleId();
            $foodstyle1 = $this->foodStyleManag->getFoodStyleById($foodStyleId1);
            $chiefWithFoodStyleAndSpecialDish[] = $foodstyle1;
            
            $foodStyleId2 = $chief->getSecondFoodStyleId();
            if (!isset($foodStyleId2)){
                $foodstyle2="Pas de second style de cuisine";
            }
            else{
                $foodstyle2 = $this->foodStyleManag->getFoodStyleById($foodStyleId2);
            }
            $chiefWithFoodStyleAndSpecialDish[] = $foodstyle2;
            
            $allChiefsWithFoodStyleAndSpecialDish[] = $chiefWithFoodStyleAndSpecialDish;

        }
        // var_dump($allChiefsWithFoodStyleAndSpecialDish);
        return $allChiefsWithFoodStyleAndSpecialDish;
    }
    
    public function displayAllChiefs()
    {
        $data = $this->createData();
        // var_dump($data);
        // render
        $this->render("visitor/chiefs", $data);
    }

    public function visitorHome()
    {
        $data = $this->createData();
        $longeurData = count($data);
        $threeLastChiefs = [$data[$longeurData-1], $data[$longeurData-2], $data[$longeurData-3]];

        $this->render("visitor/home", $threeLastChiefs);
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
                    $_SESSION["role"] = "chief";
                    
                    header('Location: mon-compte/'.$_SESSION["chiefId"]);
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
            else if(isset($_FILES) && empty($_FILES["picture"]["name"])){
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

    public function displayChief($id)
    {
        $data = [];
        
        // On ajoute l'objet chief aux datas
        $chief = $this->chiefManag->getChiefById($id);
        $data["chief"]=$chief;
        
        // On ajoute les objets dish aux datas
        $dishes = $this->dishManag->getAllDishes();
        $chiefsDishes = [];
        foreach($dishes as $dish){
            if ($dish->getChiefId()===$chief->getId()){
                $chiefsDishes[]=$dish;
            }
        }
        $data["dishes"]=$chiefsDishes;

        // On ajoute les objets FoodStyle aux datas
        $foodStyles = $this->foodStyleManag->getAllFoodStyles();
        $chiefFoodStyles = [];
        foreach($foodStyles as $foodStyle){
            if ($chief->getFirstFoodStyleId()===$foodStyle->getId()){
                $chiefFoodStyles []= $foodStyle;
            }
        }
        foreach($foodStyles as $foodStyle){
            if ($chief->getSecondFoodStyleId()===$foodStyle->getId()){
                $chiefFoodStyles []= $foodStyle;
            }
        }
        $data["foodstyles"]=$chiefFoodStyles;
        
        // On ajoute les plats sous forme de menu aux datas
        $menu = [];

        $starter=[];
        foreach($dishes as $dish){
            if ($dish->getCategoryId()===1){
                $starter [] = $dish;
            }
        }
        $menu["entrée"]=$starter;
        
        $dishh=[];
        foreach($dishes as $dish){
            if ($dish->getCategoryId()===2){
                $dishh [] = $dish;
            }
        }
        $menu["plat"]=$dishh;
        
        $dessert=[];
        foreach($dishes as $dish){
            if ($dish->getCategoryId()===3){
                $dessert [] = $dish;
            }
        }
        $menu["dessert"]=$dessert;

        $data["menu"]=$menu;
        
        
        // render
        $this->render("visitor/chief", $data);
    }




    public function displayMonCompte($id)
    {
        $data = [];
        
        // On ajoute l'objet chief aux datas
        $chief = $this->chiefManag->getChiefById($id);
        $data["chief"]=$chief;
        
        // On ajoute les objets dish aux datas
        $dishes = $this->dishManag->getAllDishes();
        $chiefsDishes = [];
        foreach($dishes as $dish){
            if ($dish->getChiefId()===$chief->getId()){
                $chiefsDishes[]=$dish;
            }
        }
        $data["dishes"]=$chiefsDishes;

        // On ajoute les objets FoodStyle aux datas
        $foodStyles = $this->foodStyleManag->getAllFoodStyles();
        $chiefFoodStyles = [];
        foreach($foodStyles as $foodStyle){
            if ($chief->getFirstFoodStyleId()===$foodStyle->getId()){
                $chiefFoodStyles []= $foodStyle;
            }
        }
        foreach($foodStyles as $foodStyle){
            if ($chief->getSecondFoodStyleId()===$foodStyle->getId()){
                $chiefFoodStyles []= $foodStyle;
            }
        }
        $data["foodstyles"]=$chiefFoodStyles;
        
        // On ajoute les plats sous forme de menu aux datas
        $menu = [];

        $starter=[];
        foreach($dishes as $dish){
            if ($dish->getCategoryId()===1){
                $starter [] = $dish;
            }
        }
        $menu["entrée"]=$starter;
        
        $dishh=[];
        foreach($dishes as $dish){
            if ($dish->getCategoryId()===2){
                $dishh [] = $dish;
            }
        }
        $menu["plat"]=$dishh;
        
        $dessert=[];
        foreach($dishes as $dish){
            if ($dish->getCategoryId()===3){
                $dessert [] = $dish;
            }
        }
        $menu["dessert"]=$dessert;

        $data["menu"]=$menu;
        
        
        // render
        $this->render("chef/home", $data);
    }














    public function getUser(string $get)
    {
        // get the user from the manager
        $id=intval($get);
        $user = $this->um->getUserById($id);
        $userArray=$user->toArray();
        // either by email or by id

        // render
        $this->render($userArray);
    }

    public function createUser(array $post)
    {
        // create the user in the manager
        $UserToCreate=new User (null, $post["username"], $post["firstName"], $post["lastName"], $post["email"]);
        $userCreated = $this->um->createUser($UserToCreate);
        $userCreatedArray=$userCreated->toArray();

        // render the created user
        $this->render($userCreatedArray);
    }

    public function updateUser(string $post)
    {   
        // update the user in the manager
        $UserToUpdate=new User ($_POST["id"], $_POST["username"], $_POST["firstName"], $_POST["lastName"], $_POST["email"]);
        $userUpdated = $this->um->updateUser($UserToUpdate);
        $userUpdatedArray=$userUpdated->toArray();

        // render the updated user
        $this->render($userUpdatedArray);
    }

    public function deleteUser(int $post)
    {
        // delete the user in the manager
        var_dump($post);
        // $UserToDelete=new User ($_POST["id"], $_POST["username"], $_POST["firstName"], $_POST["lastName"], $_POST["email"]);
        $DeletedUser = $this->um->deleteUser($post);
        // $NewUserTabArray=$NewUserTab->toArray();

        // render the list of all users
        $this->render($NewUserTabArray);
    }
}