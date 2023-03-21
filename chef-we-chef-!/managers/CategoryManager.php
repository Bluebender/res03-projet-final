<?php


class CategoryManager extends AbstractManager {

    public function getAllCategories() : array{   
        $query = $this->db->prepare('SELECT * FROM categories');
        $query->execute();
        $loadedCategories = $query->fetchAll(PDO::FETCH_ASSOC);

        $loadedCategoriesObject=[];
        foreach ($loadedCategories as $loadedCategory){
            $loadedCategoryObject = new Category ($loadedCategory["id"], $loadedCategory["name"]);
            $loadedCategoriesObject[] = $loadedCategoryObject;
        }
        // var_dump($loadedCategoriesObject);
        return $loadedCategoriesObject;
    }

    public function getCategoryById(int $id) : Category{
        $query= $this->db->prepare("SELECT * FROM `categories` WHERE id=:value");
        $parameters=['value' => $id];
        $query->execute($parameters);
        $loadedCategories = $query->fetch(PDO::FETCH_ASSOC);

        $loadedCategoriesObject = new Category ($loadedCategories["id"], $loadedCategories["name"]);
        
        // var_dump($loadedCategoriesObject);
        return $loadedCategoriesObject;
    }
    
    public function createCategory(Category $category) : void{
        $query = $this->db->prepare('INSERT INTO categories VALUES (null, :value1)');
        $parameters = [
        'value1' => $category -> getName(),
        ];
        $query->execute($parameters);
    }

    public function updateCategory(Category $category) : void{
        $query= $this->db->prepare("UPDATE categories SET name=:value2 WHERE id=:value1");
        $parameters = [
        'value1' => $category -> getId(),
        'value2' => $category -> getName(),
        ];
        $query->execute($parameters);
    }

    public function deleteCategory(int $id) : void{
        $query= $this->db->prepare("DELETE FROM categories WHERE id=:value");
        $parameters = [
        'value' => $id,
        ];
        $query->execute($parameters);
    }

}
