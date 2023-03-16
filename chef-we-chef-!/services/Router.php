<?php

class Router {
    
    private DefaultController $defaultControl;
    private ChiefController $chiefControl;
    private DishController $dishControl;
    private EventController $eventControl;
    private ZoneController $zoneControl;
    private CategoryController $categoryControl;
    private FoodStyleController $foodStyleControl;

    public function __construct()
    {
        $this->defaultControl = new DefaultController();
        $this->chiefControl = new ChiefController();
        $this->dishControl = new DishController();
        // $this->eventControl = new EventController();
        // $this->zoneControl = new ZoneController();
        // $this->categoryControl = new CategoryController();
        // $this->foodStyleControl = new FoodStyleController();
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
            if (!isset($route[1])){
                $this->chiefControl->adminHome();
            }
            else if ($route[1]==="chefs"){
                $this->chiefControl->displayAllChiefs();
            }
            else if ($route[1]==="chef"){
                if (!isset($route[3])){
                    $this->chiefControl->displayChief($route[2]);
                }
                else if ($route[3]==="modifier"){
                    $this->chiefControl->editChief($route[2]);
                }
                else if ($route[3]==="carte"){
                    $this->chiefControl->displayMenuChief($route[2]);
                }
                else if ($route[3]==="plats"){
                    $this->dishControl->displayAllChiefDishes($route[2]);
                }
                else if ($route[3]==="plat"){
                    if (!isset($route[5])){
                        $this->dishControl->displayDish($route[4]);
                    }
                    else if ($route[5]==="modifier"){
                        $this->dishControl->editDish($route[4]);
                    }
                    else if ($route[5]==="modifier"){
                        $this->dishControl->editDish($route[4]);
                    }
                    else{
                        echo "erreur 404";
                    }
                }
                else if ($route[3]==="zone"){
                    if (!isset($route[4])){
                        $this->zoneControl->displayChiefZone($route[2]);
                    }
                    else if ($route[4]==="modifier"){
                        $this->zoneControl->editChiefZone($route[2]);
                    }
                    else{
                        echo "erreur 404";
                    }
                }
                else if ($route[3]==="disponibilite"){
                    if (!isset($route[4])){
                        $this->eventControl->displayChiefAvability($route[2]);
                    }
                    else if ($route[4]==="modifier"){
                        $this->zoneControl->editChiefAvaibility($route[2]);
                    }
                    else{
                        echo "erreur 404";
                    }
                }
                else{
                    echo "erreur 404";   
                }
            }
            else if ($route[1]==="categorie"){
                if (!isset($route[3])){
                    $this->categoryControl->displayAllCategories($route[2]);
                }
                else if ($route[3]==="creer"){
                    $this->categoryControl->createCategory($route[2]);
                }
                else if ($route[3]==="modifier"){
                    $this->categoryControl->editCategory($route[2]);
                }
                else{
                    echo "erreur 404";
                }
            }
            else if ($route[1]==="style"){
                if (!isset($route[3])){
                    $this->foodStyleControl->displayAllStyles($route[2]);
                }
                else if ($route[3]==="creer"){
                    $this->foodStyleControl->createstyle($route[2]);
                }
                else if ($route[3]==="modifier"){
                    $this->foodStyleControl->editStyle($route[2]);
                }
                else{
                    echo "erreur 404";
                }
            }
            else{
                echo "erreur 404";
            }
        }
        else{
            echo "erreur 404";
        }
    }
}

?>