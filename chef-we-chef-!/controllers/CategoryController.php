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
    
    public function adminCategory($id){
        $category = $this->categoryManag->getCategoryById($id);
        $data[]=$category;
        
        $this->render("admin/category", $data);
    }
    
    public function adminCreateCategory($post){
        if (empty($post)){
            $this->render("admin/category-create-form", [""]);
        }
        else {
            if ((isset($post["categoryName"]) && !empty($post["categoryName"]))){

                $newcategory = new Category (null, $post["categoryName"]);
                $this->categoryManag->createCategory($newcategory);

                header('Location: /res03-projet-final/chef-we-chef-!/admin/categories');
            }
            else if(isset($post['categoryName']) && empty($post['categoryName'])){
                echo "Veuillez saisir une catégories";
            }
        }
    }
    
    public function adminCategoryUpdate($id){
        $post=$_POST;
        if(empty($post)){
            $category = $this->categoryManag->getCategoryById($id);
            $data["category"]=$category;
    
            $this->render("admin/category-edit-form", $data);
        }
        else {
            if ((isset($post["categoryName"]) && !empty($post["categoryName"]))){

                $category = new Category ($id, $post["categoryName"]);
                $this->categoryManag->updateCategory($category);

                header('Location: /res03-projet-final/chef-we-chef-!/admin/categories');
            }
            else if(isset($post['categoryName']) && empty($post['categoryName'])){
                echo "Veuillez saisir une catégorie";
            }
        }
    }
    
    public function adminFoodStyleDelete($id){
        $this->categoryManag->deleteCategory($id);

        header('Location: /res03-projet-final/chef-we-chef-!/admin/categories');
    }

    
}

