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
    
    public function displayAllDishes(){
        $data = $this->dishesData();

        $this->render("visitor/dishes", $data);
    }

    public function createDish($post){
        if (empty($post)){
            $foodstyles = $this->foodStyleManag->getAllFoodStyles();
            $categories = $this->categoryManag->getAllCategories();
            $data ["foodStyles"]=$foodstyles;
            $data ["categories"]=$categories;
            
            $this->render("chef/create-dish-form", $data);
        }
        else {
                var_dump($_FILES);
                var_dump($_POST);
            if ((isset($post["dishName"]) && !empty($post["dishName"]))
            && (isset($_FILES) && !empty($_FILES["image"]["name"]))
            && (isset($post["description"]) && !empty($post["description"]))
            && (isset($post["dishPrice"]) && !empty($post["dishPrice"]))
            && (isset($post["dishFoodStyle"]) && !empty($post["dishFoodStyle"]))
            && (isset($post["dishCategory"]) && !empty($post["dishCategory"]))){

                // Chargement de la photo du plat
                $uploader = new Uploader();
                $media = $uploader->upload($_FILES, "image");
                $dishPictureUrl = $media->getUrl();

                $newDish = new Dish (null, $post["dishName"], $dishPictureUrl, $post["description"], $post["dishPrice"], $_SESSION["chiefId"], $post["dishFoodStyle"], $post["dishCategory"]);
                $this->dishManag->createDish($newDish);

                header('Location: /res03-projet-final/chef-we-chef-!/mon-compte');
            }

            else if(isset($post['dishName']) && empty($post['dishName'])){
                echo "Veuillez saisir le nom du plat";
            }
            else if(isset($_FILES) && empty($_FILES["image"]["name"])){
                echo "Veuillez charger la photo de votre plat";
            }
            else if(isset($post['description']) && empty($post['description'])){
                echo "Veuillez saisir une déscriptio pour votre plat";
            }
            else if(isset($post['dishPrice']) && empty($post['dishPrice'])){
                echo "Veuillez saisir un prix";
            }
            else if(isset($post['dishFoodStyle']) && empty($post['dishFoodStyle'])){
                echo "Veuillez saisir un style de cuisine";
            }
            else if(isset($post['dishCategory']) && empty($post['dishCategory'])){
                echo "Veuillez saisir une catégorie";
            }
        }
    }




    // ADMIN
    public function adminAllDishes(){
        $data = $this->dishesData();

        $this->render("admin/dishes", $data);
    }

    public function deleteDish($id){
        $this->dishManag->deleteDish($id);

        $data = $this->dishesData();
        
        $this->render("admin/dishes", $data);
    }

    
}

