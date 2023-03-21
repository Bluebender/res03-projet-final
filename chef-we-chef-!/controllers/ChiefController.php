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

    private function chiefsData(){
        // get all the chiefs from the manager
        $allChiefs = $this->chiefManag->getAllChefs();
        
        $data=[];
        foreach ($allChiefs as $chief){
            // Je cré le tableau de donnée et j'y ajoute le chef
            $chiefWithFoodStyleAndSpecialDish=[];
            $chiefWithFoodStyleAndSpecialDish["chief"] = $chief;

            // Je vais chercher le food-style qui va avec le plat et je l'ajoute au tableau           
            $foodStyleId1 = $chief->getFirstFoodStyleId();
            $foodstyle1 = $this->foodStyleManag->getFoodStyleById($foodStyleId1);
            $chiefWithFoodStyleAndSpecialDish["foodStyle"][] = $foodstyle1;
            
            $foodStyleId2 = $chief->getSecondFoodStyleId();
            if (!isset($foodStyleId2)){
                $foodstyle2="Pas de second style de cuisine";
            }
            else{
                $foodstyle2 = $this->foodStyleManag->getFoodStyleById($foodStyleId2);
            }
            $chiefWithFoodStyleAndSpecialDish["foodStyle"][] = $foodstyle2;
            
            $data[] = $chiefWithFoodStyleAndSpecialDish;

        }
        return $data;
    }
    
    private function chiefData($id){
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
        
        // var_dump($data);
        return $data;
    }
    
    public function displayAllChiefs(){
        $data = $this->chiefsData();

        $this->render("visitor/chiefs", $data);
    }

    public function visitorHome(){
        $data = $this->chiefsData();
        $longeurData = count($data);
        $threeLastChiefs = [$data[$longeurData-1], $data[$longeurData-2], $data[$longeurData-3]];

        $this->render("visitor/home", $threeLastChiefs);
    }

    public function displayChief($id){
        $data = $this->chiefData($id);
        
        $this->render("visitor/chief", $data);
    }

    public function displayMonCompte($id){
        $data = $this->chiefData();
        
        $this->render("chef/profil", $data);
    }



    // ADMIN
    public function adminAllChiefs(){
        $data = $this->chiefsData();

        $this->render("admin/chiefs", $data);
    }

    public function adminChief($id){
        $data = $this->chiefData($id);
        
        $this->render("admin/chief", $data);
    }

    public function deleteChief($id){
        $data = $this->chiefData($id);
        foreach($data["dishes"] as $dish){
            $this->dishManag->deleteDish($dish->getId());
        }        
        
        $this->chiefManag->deleteChief($id);

        header('Location: /res03-projet-final/chef-we-chef-!/admin');
    }


}