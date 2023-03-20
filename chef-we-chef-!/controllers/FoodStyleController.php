<?php

class FoodStyleController extends AbstractController {
    private FoodStyleManager $dishfoodStyleManag;

    public function __construct()
    {
        $this->dishfoodStyleManag = new FoodStyleManager();
    }

    // ADMIN
    public function adminAllFoodStyles(){
        $allFoodStyles = $this->dishfoodStyleManag->getAllFoodStyles();

        $this->render("admin/food-styles", $allFoodStyles);
    }
    
}

