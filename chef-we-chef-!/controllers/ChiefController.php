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
        
        // render
        $this->render("chef/profil", $data);
    }



    // ADMIN
    public function adminAllChiefs()
    {
        $data = $this->createData();
        // var_dump($data);
        // render
        $this->render("admin/chiefs", $data);
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