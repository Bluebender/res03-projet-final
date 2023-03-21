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
    }
    
    function checkRoute(string $request) : void
    {
        $route=explode("/", $request);
        // var_dump($route);
        $routeFound=false;
        // Public pages
        if ($route[0]===""){
            $routeFound = true;
            $this->chiefControl->visitorHome();
        }
        else if ($route[0]==="chefs"){
            $routeFound = true;
            $this->chiefControl->displayAllChiefs();
        }
        else if ($route[0]==="plats"){
            $routeFound = true;
            $this->dishControl->displayAllDishes();
        }
        else if ($route[0]==="chef"){
            if (!isset($route[2])){
                $routeFound = true;
                $this->chiefControl->displayChief($route[1]);
            }
            else if ($route[2]==="demande-de-prestation"){
                $routeFound = true;
                $this->chiefControl->displayChiefRequest($route[1]);
            }
        }

        else if ($route[0]==="inscription"){
            $routeFound = true;
            $this->defaultControl->register($_POST);
        }
        else if ($route[0]==="connexion"){
            $routeFound = true;
            $this->defaultControl->login($_POST);
        }
        else if ($route[0]==="deconnexion"){
            $routeFound = true;
            $this->defaultControl->logout();
        }

        // Chief pages
        else if ($route[0]==="mon-compte"){
            if (!isset($route[1])){
                $routeFound = true;
                $this->chiefControl->displayMonCompte($_SESSION["chiefId"]);
            }
            else if ($route[1]==="plats"){
                $routeFound = true;
                $this->dishControl->displayChiefDishes($route[1]);
            }
            else if ($route[1]==="plat"){
                if ($route[2]==="creer"){
                    $routeFound = true;
                    $this->dishControl->createDish($_POST);
                }
                else if (!isset($route[4])){
                    $routeFound = true;
                    $this->dishControl->displayChiefDish($route[3]);
                }
                else if (($route[4]==="modifier")){
                    $routeFound = true;
                    $this->dishControl->editChiefDish($route[3]);
                }
            }
            else if ($route[2]==="secteur"){
                if (!isset($route[3])){
                    $routeFound = true;
                    $this->zoneControl->displayChiefZone($route[1]);
                }
                else if (($route[3]==="creer")){
                    $routeFound = true;
                    $this->zoneControl->createChiefZone($route[1]);
                }
                else if (($route[3]==="modifier")){
                    $routeFound = true;
                    $this->zoneControl->updateChiefZone($route[1]);
                }
            }
        }
        
        // Admin pages
        else if ($route[0]==="admin"){
            
            // Chefs
            if (!isset($route[1])){
                $routeFound = true;
                $this->chiefControl->adminAllChiefs();
            }
            else if ($route[1]==="chef"){
                if (!isset($route[3])){
                    $routeFound = true;
                    $this->chiefControl->adminChief($route[2]);
                }
                else if ($route[3]==="supprimer"){
                    $routeFound = true;
                    $this->chiefControl->deleteChief($route[2]);
                }
            }
            
            // Plats
            else if ($route[1]==="plats"){
                $routeFound = true;
                $this->dishControl->adminAllDishes();
            }
            else if ($route[1]==="plat"){
                if (!isset($route[3])){
                    $routeFound = true;
                    $this->dishControl->adminDish($route[2]);
                }
                else if ($route[3]==="supprimer"){
                    $routeFound = true;
                    $this->dishControl->deleteDish($route[2]);
                }
            }



            // Styles de cuisine
            else if ($route[1]==="styles-de-cuisine"){
                if (!isset($route[2])){
                    $routeFound = true;
                    $this->foodStyleControl->adminAllFoodStyles();
                }
                else if ($route[2]==="creer"){
                    $routeFound = true;
                    $this->foodStyleControl->adminCreateFoodStyle($_POST);
                }
            }
            else if ($route[1]==="style-de-cuisine"){
                if (!isset($route[3])){
                    $routeFound = true;
                    $this->foodStyleControl->adminFoodStyle($route[2]);
                }
                else if ($route[3]==="modifier"){
                    $routeFound = true;
                    $this->foodStyleControl->adminFoodStyleUpdate($route[2]);
                }
                else if ($route[3]==="supprimer"){
                    $routeFound = true;
                    $this->foodStyleControl->adminFoodStyleDelete($route[2]);
                }
            }
            

            // Catégories
            else if ($route[1]==="categories"){
                if (!isset($route[2])){
                    $routeFound = true;
                    $this->categoryControl->adminAllCategories();
                }
                else if ($route[2]==="creer"){
                    $routeFound = true;
                    $this->categoryControl->adminCreateCategory($_POST);
                }
            }
            else if ($route[1]==="categorie"){
                if (!isset($route[3])){
                    $routeFound = true;
                    $this->categoryControl->adminCategory($route[2]);
                }
                else if ($route[3]==="modifier"){
                    $routeFound = true;
                    $this->categoryControl->adminCategoryUpdate($route[2]);
                }
                else if ($route[3]==="supprimer"){
                    $routeFound = true;
                    $this->categoryControl->adminCategoryDelete($route[2]);
                }
            }
        }
        
        if(!$routeFound) // anything else will throw an exception telling us the route does not exist
        {   
            echo "attention";
            throw new Exception("Route not found", 404);
        }

    }
}

?>