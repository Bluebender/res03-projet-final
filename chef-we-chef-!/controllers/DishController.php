<?php

class DishController extends AbstractController {
    private DishManager $dishManag;
    private FoodStyleManager $foodStyleManag;
    private CategoryManager $categoryManag;

    public function __construct()
    {
        $this->dishManag = new DishManager();
        $this->foodStyleManag = new FoodStyleManager();
        $this->categoryManag = new CategoryManager();
    }

    public function displayAllDishes()
    {
        // get all the dishes from the manager
        $allDishes = $this->dishManag->getAllDishes();

        $allDishesWithFoodStyleAndCategory=[];
        foreach ($allDishes as $dish){
            // Je cré le tableau de donnée et j'y ajoute le plat
            $dishWithFoodStyleAndCategory=[];
            $dishWithFoodStyleAndCategory[] = $dish;

            // Je vais chercher la catégorie qui va avec le plat et je l'ajoute au tableau           
            $categoryId = $dish->getCategoryId();
            $category = $this->categoryManag->getCategoryById($categoryId);
            $dishWithFoodStyleAndCategory[] = $category;
            
            // Je vais chercher le food-style qui va avec le plat et je l'ajoute au tableau           
            $foodStyleId = $dish->getFoodStyleId();
            $foodstyle = $this->foodStyleManag->getFoodStyleById($foodStyleId);
            $dishWithFoodStyleAndCategory[] = $foodstyle;
            
            $allDishesWithFoodStyleAndCategory[] = $dishWithFoodStyleAndCategory;
        }
        // var_dump($allDishesWithFoodStyleAndCategory);
        // render
        $this->render("dishes", $allDishesWithFoodStyleAndCategory);
    }










    public function getUser(string $get)
    {
        // get the user from the manager
        $id=intval($get);
        $user = $this->um->getUserById($id);
        $userArray=$user->toArray();
        // either by email or by id

        // render
        $this->render($userArray);
    }

    public function createUser(array $post)
    {
        // create the user in the manager
        $UserToCreate=new User (null, $post["username"], $post["firstName"], $post["lastName"], $post["email"]);
        $userCreated = $this->um->createUser($UserToCreate);
        $userCreatedArray=$userCreated->toArray();

        // render the created user
        $this->render($userCreatedArray);
    }

    public function updateUser(string $post)
    {   
        // update the user in the manager
        $UserToUpdate=new User ($_POST["id"], $_POST["username"], $_POST["firstName"], $_POST["lastName"], $_POST["email"]);
        $userUpdated = $this->um->updateUser($UserToUpdate);
        $userUpdatedArray=$userUpdated->toArray();

        // render the updated user
        $this->render($userUpdatedArray);
    }

    public function deleteUser(int $post)
    {
        // delete the user in the manager
        var_dump($post);
        // $UserToDelete=new User ($_POST["id"], $_POST["username"], $_POST["firstName"], $_POST["lastName"], $_POST["email"]);
        $DeletedUser = $this->um->deleteUser($post);
        // $NewUserTabArray=$NewUserTab->toArray();

        // render the list of all users
        $this->render($NewUserTabArray);
    }
}