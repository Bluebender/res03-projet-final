<?php

class FoodStyleController extends AbstractController {
    private FoodStyleManager $foodStyleManag;

    public function __construct()
    {
        $this->foodStyleManag = new FoodStyleManager();
    }

    // ADMIN
    public function adminAllFoodStyles(){
        $allFoodStyles = $this->foodStyleManag->getAllFoodStyles();

        $this->render("admin/food-styles", $allFoodStyles);
    }
    
    public function adminFoodStyle($id){
        $foodStyle = $this->foodStyleManag->getFoodStyleById($id);
        $data[]=$foodStyle;
        
        $this->render("admin/food-style", $data);
    }

    public function adminCreateFoodStyle($post){
        if (empty($post)){
            $this->render("admin/food-styles-create-form", [""]);
        }
        else {
            if ((isset($post["foodStyleName"]) && !empty($post["foodStyleName"]))
            && (isset($post["foodStyleDescription"]) && !empty($post["foodStyleDescription"]))){

                $newFoodStyle = new FoodStyle (null, $post["foodStyleName"], $post["foodStyleDescription"]);
                $this->foodStyleManag->createFoodStyle($newFoodStyle);

                header('Location: /res03-projet-final/chef-we-chef-!/admin/styles-de-cuisine');
            }
            else if(isset($post['foodStyleName']) && empty($post['foodStyleName'])){
                echo "Veuillez saisir un style de cuisine";
            }
            else if(isset($post['foodStyleDescription']) && empty($post['foodStyleDescription'])){
                echo "Veuillez saisir une description";
            }
        }
    }
    
    public function adminFoodStyleUpdate($id){
        $post=$_POST;
        if(empty($post)){
            $foodStyle = $this->foodStyleManag->getFoodStyleById($id);
            $data["foodStyle"]=$foodStyle;
    
            $this->render("admin/food-style-edit-form", $data);
        }
        else {
            if ((isset($post["foodStyleName"]) && !empty($post["foodStyleName"]))
            && (isset($post["foodStyleDescription"]) && !empty($post["foodStyleDescription"]))){

                $FoodStyle = new FoodStyle ($id, $post["foodStyleName"], $post["foodStyleDescription"]);
                $this->foodStyleManag->updateFoodStyle($FoodStyle);

                header('Location: /res03-projet-final/chef-we-chef-!/admin/styles-de-cuisine');
            }
            else if(isset($post['foodStyleName']) && empty($post['foodStyleName'])){
                echo "Veuillez saisir un style de cuisine";
            }
            else if(isset($post['foodStyleDescription']) && empty($post['foodStyleDescription'])){
                echo "Veuillez saisir une description";
            }
        }
    }
    
    public function adminFoodStyleDelete($id){
        $this->foodStyleManag->deleteFoodStyle($id);

        header('Location: /res03-projet-final/chef-we-chef-!/admin/styles-de-cuisine');
    }
}