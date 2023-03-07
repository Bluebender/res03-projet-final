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
        $this->eventControl = new EventController();
        $this->zoneControl = new ZoneController();
        $this->categoryControl = new CategoryController();
        $this->foodStyleControl = new FoodStyleController();
    }
    
    function checkRoute(string $request) : void 
    {
        $route=explode("/", $request);

        // Public pages     
        if ($route[0]===null){
            $this->chiefControl->visitorHome();
        }
        if ($route[0]==="chefs"){
            $this->chiefControl->displayAllChiefs();
        }
        if ($route[0]==="cartes"){
            $this->chiefControl->displayAllMenus();
        }
        if ($route[0]==="plats"){
            $this->dishControl->displayAllDishes();
        }
        if ($route[0]==="plat"){
            $this->dishControl->displayDish($route[1]);
        }
        if ($route[0]==="chef"){
            if ($route[2]==="présentation"){
                $this->chiefControl->displayChief($route[1]);
            }
            if ($route[2]==="carte"){
                $this->chiefControl->displayChiefMenu($route[1]);
            }
            if ($route[2]==="demande-de-prestation"){
                $this->chiefControl->displayChiefRequest($route[1]);
            }
        }
        if ($route[0]==="inscription"){
                $this->defaultControl->register();
        }
        if ($route[0]==="connexion"){
            $this->defaultControl->login();
        }

        // Chief pages     
        if ($route[0]==="mon-compte"){
            if ($route[2]==="accueil"){
                $this->chiefControl->chiefHome($route[1]);
            }
            if ($route[2]==="carte"){
                $this->chiefControl->displayChiefMenu($route[1]);
            }
            if ($route[2]==="plats"){
                $this->dishControl->displayChiefDishes($route[1]);
            }
            if ($route[2]==="plat"){
                if ($route[3]==="creer"){
                    $this->dishControl->createChiefDish($route[1]);
                }
                if (!isset($route[4])){
                    $this->dishControl->displayChiefDish($route[3]);
                }
                if (($route[4]==="modifier")){
                    $this->dishControl->updateChiefDish($route[3]);
                }
            }
            if ($route[2]==="secteur"){
                if (!isset($route[3])){
                    $this->zoneControl->displayChiefZone($route[1]);
                }
                if (($route[3]==="creer")){
                    $this->zoneControl->createChiefZone($route[1]);
                }
                if (($route[3]==="modifier")){
                    $this->zoneControl->updateChiefZone($route[1]);
                }
            }
        }
        
        // Admin pages
        if ($route[0]==="admin"){
            if ($route[1]==="accueil"){
                $this->chiefControl->adminHome();
            }
            if ($route[1]==="chefs"){
                $this->chiefControl->displayAllChiefs();
            }
            if ($route[1]==="chef"){
                if ($route[3]==="presentaton"){
                    $this->chiefControl->displayChief($route[2]);
                }
                if ($route[3]==="modifier"){
                    $this->chiefControl->updateChief($route[2]);
                }
            }
        }


    }
}

?>