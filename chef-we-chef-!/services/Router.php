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

                case 'chefCalendar':
                    $this->eventControl->displayEvents($_GET['id']);
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

                case 'contactChief':
                    $this->chiefControl->contactChief($_GET);
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

                case 'mon-compte/myCalendar':
                    $this->eventControl->displayEvents($_SESSION["chiefId"]);
                    break;

                case 'mon-compte/createEvent':
                    $this->eventControl->createEvent($_POST);
                    break;


                // Admin pages
                // Chiefs
                case 'admin':
                    if(isset($_SESSION['role']) && $_SESSION['role']=='admin'){
                        $this->chiefControl->adminAllChiefs();
                    }
                    else{
                        $this->defaultControl->login($_POST);
                    }
                    break;

                case 'admin/chef':
                    if(isset($_SESSION['role']) && $_SESSION['role']=='admin'){
                    $this->chiefControl->adminChief($_GET['id']);
                    }
                    else{
                        $this->defaultControl->login($_POST);
                    }
                    break;

                case 'admin/supprimer-chef':
                    if(isset($_SESSION['role']) && $_SESSION['role']=='admin'){
                    $this->chiefControl->deleteChief($_GET['id']);
                    }
                    else{
                        $this->defaultControl->login($_POST);
                    }
                    break;

                // Plats
                case 'admin/plats':
                    if(isset($_SESSION['role']) && $_SESSION['role']=='admin'){
                    $this->dishControl->adminAllDishes();
                    }
                    else{
                        $this->defaultControl->login($_POST);
                    }
                    break;

                case 'admin/plat':
                    if(isset($_SESSION['role']) && $_SESSION['role']=='admin'){
                    $this->dishControl->adminDish($_GET['id']);
                    }
                    else{
                        $this->defaultControl->login($_POST);
                    }
                    break;

                case 'admin/supprimer-plat':
                    if(isset($_SESSION['role']) && $_SESSION['role']=='admin'){
                    $this->dishControl->adminDishDelete($_GET['id']);
                    }
                    else{
                        $this->defaultControl->login($_POST);
                    }
                    break;

                // Food Styles
                case 'admin/styles-de-cuisine':
                    if(isset($_SESSION['role']) && $_SESSION['role']=='admin'){
                    $this->foodStyleControl->adminAllFoodStyles();
                    }
                    else{
                        $this->defaultControl->login($_POST);
                    }
                    break;
                
                case 'admin/styles-de-cuisine/creer':
                    if(isset($_SESSION['role']) && $_SESSION['role']=='admin'){
                    $this->foodStyleControl->adminCreateFoodStyle($_POST);
                    }
                    else{
                        $this->defaultControl->login($_POST);
                    }
                    break;

                case 'admin/style-de-cuisine':
                    if(isset($_SESSION['role']) && $_SESSION['role']=='admin'){
                    $this->foodStyleControl->adminFoodStyle($_GET['id']);
                    }
                    else{
                        $this->defaultControl->login($_POST);
                    }
                    break;

                case 'admin/modifier-style-de-cuisine':
                    if(isset($_SESSION['role']) && $_SESSION['role']=='admin'){
                    $this->foodStyleControl->adminFoodStyleUpdate($_GET['id']);
                    }
                    else{
                        $this->defaultControl->login($_POST);
                    }
                    break;

                case 'admin/supprimer-style-de-cuisine':
                    if(isset($_SESSION['role']) && $_SESSION['role']=='admin'){
                    $this->foodStyleControl->adminFoodStyleDelete($_GET['id']);
                    }
                    else{
                        $this->defaultControl->login($_POST);
                    }
                    break;

                // Categories
                case 'admin/categories':
                    if(isset($_SESSION['role']) && $_SESSION['role']=='admin'){
                    $this->categoryControl->adminAllCategories();
                    }
                    else{
                        $this->defaultControl->login($_POST);
                    }
                    break;

                case 'admin/categories/creer':
                    if(isset($_SESSION['role']) && $_SESSION['role']=='admin'){
                    $this->categoryControl->adminCreateCategory($_POST);
                    }
                    else{
                        $this->defaultControl->login($_POST);
                    }
                    break;

                case 'admin/categorie':
                    if(isset($_SESSION['role']) && $_SESSION['role']=='admin'){
                    $this->categoryControl->adminCategory($_GET['id']);
                    }
                    else{
                        $this->defaultControl->login($_POST);
                    }
                    break;

                case 'admin/modifier-categorie':
                    if(isset($_SESSION['role']) && $_SESSION['role']=='admin'){
                    $this->categoryControl->adminCategoryUpdate($_GET['id']);
                    }
                    else{
                        $this->defaultControl->login($_POST);
                    }
                    break;

                case 'admin/supprimer-categorie':
                    if(isset($_SESSION['role']) && $_SESSION['role']=='admin'){
                    $this->categoryControl->adminCategoryDelete($_GET['id']);
                    }
                    else{
                        $this->defaultControl->login($_POST);
                    }
                    break;

                default:
                    $this->chiefControl->error404();
                    break;
            }
        }
        else {
            $this->chiefControl->visitorHome();
        }
    }
}

?>