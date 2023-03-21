<?php

class Router {
    
    private DefaultController $defaultControl;
    private ChiefController $chiefControl;
    private DishController $dishControl;
    private CategoryController $categoryControl;
    private FoodStyleController $foodStyleControl;
    // private EventController $eventControl;
    // private ZoneController $zoneControl;

    public function __construct()
    {
        $this->defaultControl = new DefaultController();
        $this->chiefControl = new ChiefController();
        $this->dishControl = new DishController();
        $this->categoryControl = new CategoryController();
        $this->foodStyleControl = new FoodStyleController();
        // $this->eventControl = new EventController();
        // $this->zoneControl = new ZoneController();
    }
    
    function checkRoute(string $request) : void
    {
        $route=explode("/", $request);
        // var_dump($route);

        // Public pages
        if ($route[0]===""){
            $this->chiefControl->visitorHome();
        }
        else if ($route[0]==="chefs"){
            $this->chiefControl->displayAllChiefs();
        }
        else if ($route[0]==="cartes"){
            $this->chiefControl->displayAllMenus();
        }
        else if ($route[0]==="plats"){
            $this->dishControl->displayAllDishes();
        }
        else if ($route[0]==="plat"){
            $this->dishControl->displayDish($route[1]);
        }
        else if ($route[0]==="chef"){
            if (!isset($route[2])){
                $this->chiefControl->displayChief($route[1]);
            }
            else if ($route[2]==="demande-de-prestation"){
                $this->chiefControl->displayChiefRequest($route[1]);
            }
            else{
                echo "erreur 404";
            }
        }
        else if ($route[0]==="inscription"){
            $this->defaultControl->register($_POST);
        }
        else if ($route[0]==="connexion"){
            $this->defaultControl->login($_POST);
        }
        else if ($route[0]==="deconnexion"){
            $this->defaultControl->logout();
        }

        // Chief pages
        else if ($route[0]==="mon-compte"){
            if (!isset($route[1])){
                $this->chiefControl->displayMonCompte($_SESSION["chiefId"]);
            }
            else if ($route[1]==="plats"){
                $this->dishControl->displayChiefDishes($route[1]);
            }
            else if ($route[1]==="plat"){
                if ($route[2]==="creer"){
                    $this->dishControl->createDish($_POST);
                }
                else if (!isset($route[4])){
                    $this->dishControl->displayChiefDish($route[3]);
                }
                else if (($route[4]==="modifier")){
                    $this->dishControl->editChiefDish($route[3]);
                }
                else{
                    echo "erreur 404";
                }
            }
            else if ($route[2]==="secteur"){
                if (!isset($route[3])){
                    $this->zoneControl->displayChiefZone($route[1]);
                }
                else if (($route[3]==="creer")){
                    $this->zoneControl->createChiefZone($route[1]);
                }
                else if (($route[3]==="modifier")){
                    $this->zoneControl->updateChiefZone($route[1]);
                }
                else{
                    echo "erreur 404";
                }
            }
            else{
                echo "erreur 404";
            }
        }
        
        // Admin pages
        else if ($route[0]==="admin"){
            
            // Chefs
            if (!isset($route[1])){
                $this->chiefControl->adminAllChiefs();
            }
            else if ($route[1]==="chef"){
                if (!isset($route[3])){
                    $this->chiefControl->adminChief($route[2]);
                }
                else if ($route[3]==="supprimer"){
                    $this->chiefControl->deleteChief($route[2]);
                }
            }
            
            // Plats
            else if ($route[1]==="plats"){
                $this->dishControl->adminAllDishes();
            }
            else if ($route[1]==="plat"){
                if (!isset($route[3])){
                    $this->dishControl->adminDish($route[2]);
                }
                else if ($route[3]==="supprimer"){
                    $this->dishControl->deleteDish($route[2]);
                }
            }



            // Styles de cuisine
            else if ($route[1]==="styles-de-cuisine"){
                if (!isset($route[2])){
                    $this->foodStyleControl->adminAllFoodStyles();
                }
                else if ($route[2]==="creer"){
                    $this->foodStyleControl->adminCreateFoodStyle($_POST);
                }
            }
            else if ($route[1]==="style-de-cuisine"){
                if (!isset($route[3])){
                    $this->foodStyleControl->adminFoodStyle($route[2]);
                }
                else if ($route[3]==="modifier"){
                    $this->foodStyleControl->adminFoodStyleUpdate($route[2]);
                }
                else if ($route[3]==="supprimer"){
                    $this->foodStyleControl->adminFoodStyleDelete($route[2]);
                }
            }
            

            // Catégories
            else if ($route[1]==="categories"){
                if (!isset($route[2])){
                    $this->categoryControl->adminAllCategories();
                }
                else if ($route[2]==="creer"){
                    $this->categoryControl->adminCreateCategory($_POST);
                }
            }
            else if ($route[1]==="categorie"){
                if (!isset($route[3])){
                    $this->categoryControl->adminCategory($route[2]);
                }
                else if ($route[3]==="modifier"){
                    $this->categoryControl->adminCategoryUpdate($route[2]);
                }
                else if ($route[3]==="supprimer"){
                    $this->categoryControl->adminCategoryDelete($route[2]);
                }
            }
            
            
            
            
        }
        else{
            echo "erreur 404";
        }
    }
}

?>