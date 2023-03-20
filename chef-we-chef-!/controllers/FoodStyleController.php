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
    
}

