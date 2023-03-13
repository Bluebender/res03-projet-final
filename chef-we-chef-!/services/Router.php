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
        if ($route[1]===""){
            $this->chiefControl->visitorHome();
        }
        else if ($route[1]==="chefs"){
            $this->chiefControl->displayAllChiefs();
        }
        else if ($route[1]==="cartes"){
            $this->chiefControl->displayAllMenus();
        }
        else if ($route[1]==="plats"){
            $this->dishControl->displayAllDishes();
        }
        else if ($route[1]==="plat"){
            $this->dishControl->displayDish($route[2]);
        }
        else if ($route[1]==="chef"){
            if (!isset($route[3])){
                $this->chiefControl->displayChief($route[2]);
            }
            else if ($route[3]==="carte"){
                $this->chiefControl->displayChiefMenu($route[2]);
            }
            else if ($route[3]==="demande-de-prestation"){
                $this->chiefControl->displayChiefRequest($route[2]);
            }
            else{
                echo "erreur 404";
            }
        }
        else if ($route[1]==="inscription"){
            $this->chiefControl->register($_POST);
        }
        else if ($route[1]==="connexion"){
            $this->defaultControl->login($_POST);
        }

        // Chief pages
        else if ($route[1]==="mon-compte"){
            if (!isset($route[3])){
                $this->chiefControl->chiefHome($route[2]);
            }
            else if ($route[3]==="carte"){
                $this->chiefControl->displayChiefMenu($route[2]);
            }
            else if ($route[3]==="plats"){
                $this->dishControl->displayChiefDishes($route[2]);
            }
            else if ($route[3]==="plat"){
                if ($route[4]==="creer"){
                    $this->dishControl->createChiefDish($route[2]);
                }
                else if (!isset($route[5])){
                    $this->dishControl->displayChiefDish($route[4]);
                }
                else if (($route[5]==="modifier")){
                    $this->dishControl->editChiefDish($route[4]);
                }
                else{
                    echo "erreur 404";
                }
            }
            else if ($route[3]==="secteur"){
                if (!isset($route[4])){
                    $this->zoneControl->displayChiefZone($route[2]);
                }
                else if (($route[4]==="creer")){
                    $this->zoneControl->createChiefZone($route[2]);
                }
                else if (($route[4]==="modifier")){
                    $this->zoneControl->updateChiefZone($route[2]);
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
        else if ($route[1]==="admin"){
            if (!isset($route[2])){
                $this->chiefControl->adminHome();
            }
            else if ($route[2]==="chefs"){
                $this->chiefControl->displayAllChiefs();
            }
            else if ($route[2]==="chef"){
                if (!isset($route[4])){
                    $this->chiefControl->displayChief($route[3]);
                }
                else if ($route[4]==="modifier"){
                    $this->chiefControl->editChief($route[3]);
                }
                else if ($route[4]==="carte"){
                    $this->chiefControl->displayMenuChief($route[3]);
                }
                else if ($route[4]==="plats"){
                    $this->dishControl->displayAllChiefDishes($route[3]);
                }
                else if ($route[4]==="plat"){
                    if (!isset($route[6])){
                        $this->dishControl->displayDish($route[5]);
                    }
                    else if ($route[6]==="modifier"){
                        $this->dishControl->editDish($route[5]);
                    }
                    else if ($route[6]==="modifier"){
                        $this->dishControl->editDish($route[5]);
                    }
                    else{
                        echo "erreur 404";
                    }
                }
                else if ($route[4]==="zone"){
                    if (!isset($route[5])){
                        $this->zoneControl->displayChiefZone($route[3]);
                    }
                    else if ($route[5]==="modifier"){
                        $this->zoneControl->editChiefZone($route[3]);
                    }
                    else{
                        echo "erreur 404";
                    }
                }
                else if ($route[4]==="disponibilite"){
                    if (!isset($route[5])){
                        $this->eventControl->displayChiefAvability($route[3]);
                    }
                    else if ($route[5]==="modifier"){
                        $this->zoneControl->editChiefAvaibility($route[3]);
                    }
                    else{
                        echo "erreur 404";
                    }
                }
                else{
                    echo "erreur 404";   
                }
            }
            else if ($route[2]==="categorie"){
                if (!isset($route[3])){
                    $this->categoryControl->displayAllCategories($route[3]);
                }
                else if ($route[3]==="creer"){
                    $this->categoryControl->createCategory($route[3]);
                }
                else if ($route[3]==="modifier"){
                    $this->categoryControl->editCategory($route[3]);
                }
                else{
                    echo "erreur 404";
                }
            }
            else if ($route[2]==="style"){
                if (!isset($route[3])){
                    $this->foodStyleControl->displayAllStyles($route[3]);
                }
                else if ($route[3]==="creer"){
                    $this->foodStyleControl->createstyle($route[3]);
                }
                else if ($route[3]==="modifier"){
                    $this->foodStyleControl->editStyle($route[3]);
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