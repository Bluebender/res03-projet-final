<?php

class CategoryController extends AbstractController {
    private CategoryManager $categoryManag;

    public function __construct()
    {
        $this->categoryManag = new CategoryManager();
    }

    // ADMIN
    public function adminAllCategories(){
        $allCategories = $this->categoryManag->getAllCategories();

        $this->render("admin/categories", $allCategories);
    }
    public function adminFoodStyle($id){
        $category = $this->categoryManag->getCategoryById($id);
        $data[]=$category;
        
        $this->render("admin/category", $data);
    }
    
}

