<?php

class Router {
    
    private DefaultController $defaultControl;
    private ChiefController $chiefControl;
    private DishController $dishControl;
    private CategoryController $categoryControl;
    private FoodStyleController $foodStyleControl;
    private EventController $eventControl;

    public function __construct()
    {
        $this->defaultControl = new DefaultController();
        $this->chiefControl = new ChiefController();
        $this->dishControl = new DishController();
        $this->categoryControl = new CategoryController();
        $this->foodStyleControl = new FoodStyleController();
        $this->eventControl = new EventController();
    }
    
    function checkRoute() : void{
        if(array_key_exists('path', $_GET)) {
            switch($_GET['path']) {
                
                // Public pages
                case 'home':
                    $this->chiefControl->visitorHome();
                    break;

                case 'chefs':
                    $this->chiefControl->displayAllChiefs();
                    break;
                    
                case 'plats':
                    $this->dishControl->displayAllDishes();
                    break;

                case 'chef':
                    $this->chiefControl->displayChief($_GET['id']);
                    break;

                case 'inscription':
                    $this->defaultControl->register($_POST);
                    break;

                case 'connexion':
                    $this->defaultControl->login($_POST);
                    break;

                case 'deconnexion':
                    $this->defaultControl->logout();
                    break;


                // Chief pages

                case 'mon-compte':
                    $this->chiefControl->displayMonCompte($_SESSION["chiefId"]);
                    break;

                case 'mon-compte/plat/creer':
                    $this->dishControl->createDish($_POST);
                    break;

                case 'mon-compte/calendar':
                    $this->chiefControl->displayCalendar($_SESSION["chiefId"]);
                    break;


                // Admin pages
                // Chiefs
                case 'admin':
                    $this->chiefControl->adminAllChiefs();
                    break;

                case 'admin/chef':
                    $this->chiefControl->adminChief($_GET['id']);
                    break;

                case 'admin/supprimer-chef':
                    $this->chiefControl->deleteChief($_GET['id']);
                    break;

                // Plats
                case 'admin/plats':
                    $this->dishControl->adminAllDishes();
                    break;

                case 'admin/plat':
                    $this->dishControl->adminDish($_GET['id']);
                    break;

                case 'admin/supprimer-plat':
                    $this->dishControl->adminDishDelete($_GET['id']);
                    break;

                // Food Styles
                case 'admin/styles-de-cuisine':
                    $this->foodStyleControl->adminAllFoodStyles();
                    break;
                
                case 'admin/styles-de-cuisine/creer':
                    $this->foodStyleControl->adminCreateFoodStyle($_POST);
                    break;

                case 'admin/style-de-cuisine':
                    $this->foodStyleControl->adminFoodStyle($_GET['id']);
                    break;

                case 'admin/modifier-style-de-cuisine':
                    $this->foodStyleControl->adminFoodStyleUpdate($_GET['id']);
                    break;

                case 'admin/supprimer-style-de-cuisine':
                    $this->foodStyleControl->adminFoodStyleDelete($_GET['id']);
                    break;

                // Categories
                case 'admin/categories':
                    $this->categoryControl->adminAllCategories();
                    break;

                case 'admin/categories/creer':
                    $this->categoryControl->adminCreateCategory($_POST);
                    break;

                case 'admin/categorie':
                    $this->categoryControl->adminCategory($_GET['id']);
                    break;

                case 'admin/modifier-categorie':
                    $this->categoryControl->adminCategoryUpdate($_GET['id']);
                    break;

                case 'admin/supprimer-categorie':
                    $this->categoryControl->adminCategoryDelete($_GET['id']);
                    break;

                default:
                    $this->chiefControl->visitorHome();
                    break;
            }
        }
        else {
            $this->chiefControl->visitorHome();
        }
    }
}

?>