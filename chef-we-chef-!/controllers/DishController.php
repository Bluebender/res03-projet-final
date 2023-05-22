<?php

class DishController extends AbstractController {
    private DishManager $dishManag;
    private FoodStyleManager $foodStyleManag;
    private CategoryManager $categoryManag;
    private ChiefManager $chiefManag;

    public function __construct()
    {
        $this->dishManag = new DishManager();
        $this->foodStyleManag = new FoodStyleManager();
        $this->categoryManag = new CategoryManager();
        $this->chiefManag = new ChiefManager();
    }

    
    private function dishesData(){
        // get all the dishes from the manager
        $allDishes = $this->dishManag->getAllDishes();

        $data=[];
        foreach ($allDishes as $dish){
            // Je crée le tableau de donnée et j'y ajoute le plat
            $dishWithFoodStyleAndCategory=[];
            $dishWithFoodStyleAndCategory["dish"] = $dish;

            // Je vais chercher la catégorie qui va avec le plat et je l'ajoute au tableau           
            $categoryId = $dish->getCategoryId();
            $category = $this->categoryManag->getCategoryById($categoryId);
            $dishWithFoodStyleAndCategory["category"] = $category;
            
            // Je vais chercher le food-style qui va avec le plat et je l'ajoute au tableau           
            $foodStyleId = $dish->getFoodStyleId();
            $foodStyle = $this->foodStyleManag->getFoodStyleById($foodStyleId);
            $dishWithFoodStyleAndCategory["foodStyle"] = $foodStyle;
            
            // Je vais chercher le chef qui va avec le plat et je l'ajoute au tableau           
            $chiefId = $dish->getChiefId();
            $chief = $this->chiefManag->getChiefById($chiefId);
            $dishWithFoodStyleAndCategory["chief"] = $chief;
            
            $data[] = $dishWithFoodStyleAndCategory;
        }
        return $data;
    }

    private function dishData($id){
        $data=[];

        $dish = $this->dishManag->getDishById($id);
        $data["dish"] = $dish;


        // Je vais chercher la catégorie qui va avec le plat et je l'ajoute au tableau           
        $categoryId = $dish->getCategoryId();
        $category = $this->categoryManag->getCategoryById($categoryId);
        $data["category"] = $category;
        
        // Je vais chercher le food-style qui va avec le plat et je l'ajoute au tableau           
        $foodStyleId = $dish->getFoodStyleId();
        $foodStyle = $this->foodStyleManag->getFoodStyleById($foodStyleId);
        $data["foodStyle"] = $foodStyle;
        
        // Je vais chercher le chef qui va avec le plat et je l'ajoute au tableau           
        $chiefId = $dish->getChiefId();
        $chief = $this->chiefManag->getChiefById($chiefId);
        $data["chief"] = $chief;

        return $data;
    }
    
    public function displayAllDishes(){
        $data = $this->dishesData();

        $this->render("visitor/dishes", $data);
    }

    public function createDish($post){
        $foodstyles = $this->foodStyleManag->getAllFoodStyles();
        $categories = $this->categoryManag->getAllCategories();
        $errorMessage = "";

        $data ["foodStyles"]=$foodstyles;
        $data ["categories"]=$categories;
        $data ["errorMessage"] = $errorMessage;

        if (empty($post)){
            $this->render("chef/create-dish-form", $data);
        }
        else {
            if ((isset($post["dishName"]) && !empty($post["dishName"]))
            && (isset($_FILES) && !empty($_FILES["image"]["name"]))
            && (isset($post["description"]) && !empty($post["description"]))
            && (isset($post["dishPrice"]) && !empty($post["dishPrice"]))
            && (isset($post["dishFoodStyle"]) && !empty($post["dishFoodStyle"]))
            && (isset($post["dishCategory"]) && !empty($post["dishCategory"]))){

                // Sanitisation des données du formulaire
                $dishName = $this->sanitize($post["dishName"]);
                $description = $this->sanitize($post["description"]);
                $dishPrice = $this->sanitize($post["dishPrice"]);
                $dishFoodStyle = $this->sanitize($post["dishFoodStyle"]);
                $dishCategory = $this->sanitize($post["dishCategory"]);

                // Chargement de la photo du plat
                $uploader = new Uploader();
                $media = $uploader->upload($_FILES, "image");
                $dishPictureUrl = $media->getUrl();

                $newDish = new Dish (null, $dishName, $dishPictureUrl, $description, $dishPrice, $_SESSION["chiefId"], $dishFoodStyle, $dishCategory);
                $this->dishManag->createDish($newDish);

                header('Location: /res03-projet-final/chef-we-chef-!/mon-compte');
            }

            else if(isset($post['dishName']) && empty($post['dishName'])){
                $errorMessage = "Veuillez saisir le nom du plat";
                $data ["errorMessage"] = $errorMessage;
                
                $this->render("chef/create-dish-form", $data);
            }
            else if(isset($_FILES) && empty($_FILES["image"]["name"])){
                $errorMessage = "Veuillez charger la photo de votre plat";
                $data ["errorMessage"] = $errorMessage;
                
                $this->render("chef/create-dish-form", $data);
            }
            else if(isset($post['description']) && empty($post['description'])){
                $errorMessage = "Veuillez saisir une description pour votre plat";
                $data ["errorMessage"] = $errorMessage;
                
                $this->render("chef/create-dish-form", $data);
            }
            else if(isset($post['dishPrice']) && empty($post['dishPrice'])){
                $errorMessage = "Veuillez saisir un prix";
                $data ["errorMessage"] = $errorMessage;
                
                $this->render("chef/create-dish-form", $data);
            }
            else if(isset($post['dishFoodStyle']) && empty($post['dishFoodStyle'])){
                $errorMessage = "Veuillez saisir un style de cuisine";
                $data ["errorMessage"] = $errorMessage;
                
                $this->render("chef/create-dish-form", $data);
            }
            else if(isset($post['dishCategory']) && empty($post['dishCategory'])){
                $errorMessage = "Veuillez saisir une catégorie";
                $data ["errorMessage"] = $errorMessage;
                
                $this->render("chef/create-dish-form", $data);
            }
        }
    }




    // ADMIN
    public function adminAllDishes(){
        $data = $this->dishesData();

        $this->render("admin/dishes", $data);
    }
    
    public function adminDish($id){
        $data = $this->dishData($id);
        
        $this->render("admin/dish", $data);
    }

    public function adminDishDelete($id){
        $this->dishManag->deleteDish($id);

        $data = $this->dishesData();
        
        $this->render("admin/dishes", $data);
    }

    
}

