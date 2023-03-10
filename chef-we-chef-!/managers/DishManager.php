<?php


class DishManager extends AbstractManager {

    public function getAllDishes() : array
    {   
        $query = $this->db->prepare('SELECT * FROM dishes');
        $query->execute();
        $loadedDishes = $query->fetchAll(PDO::FETCH_ASSOC);

        $loadedDishesObject=[];
        foreach ($loadedDishes as $loadedDish){
            $loadedDishObject = new Dish ($loadedDish["id"], $loadedDish["name"], $loadedDish["picture_url"], $loadedDish["description"], $loadedDish["price"], $loadedDish["chief_id"], $loadedDish["food_style_id"], $loadedDish["category_id"]);
            $loadedDishesObject[] = $loadedDishObject;
        }
        // var_dump($loadedDishesObject);
        return $loadedDishesObject;
    }

    public function getDishById(int $id) : Dish
    {
        $query= $this->db->prepare("SELECT * FROM dishes WHERE id=:value");
        $parameters=['value' => $id];
        $query->execute($parameters);
        $loadedDish = $query->fetch(PDO::FETCH_ASSOC);

        $loadedDishObject = new Dish ($loadedDish["id"], $loadedDish["name"], $loadedDish["picture_url"], $loadedDish["description"], $loadedDish["price"], $loadedDish["chief_id"], $loadedDish["food_style_id"], $loadedDish["category_id"]);
        
        // var_dump($loadedDishObject);
        return $loadedDishObject;
    }

    // public function createUser(User $user) : User
    // {
    //     $query = $this->db->prepare('INSERT INTO users VALUES (null, :value1, :value2, :value3, :value4)');
    //     $parameters = [
    //     'value1' => $user -> getUsername(),
    //     'value2' => $user -> getFirstName(),
    //     'value3' => $user -> getLastName(),
    //     'value4' => $user -> getEmail()
    //     ];
    //     $query->execute($parameters);

    //     $query= $this->db->prepare("SELECT * FROM users WHERE email=:value");
    //     $parameters=['value' => $user -> getEmail()];
    //     $query->execute($parameters);
    //     $loadedSavedUser = $query->fetch(PDO::FETCH_ASSOC);

    //     $loadedSavedUserObject=new User ($loadedSavedUser["id"], $loadedSavedUser["username"],$loadedSavedUser["first_name"], $loadedSavedUser["last_name"], $loadedSavedUser["email"]);

    //     return $loadedSavedUserObject;
    // }

    // public function updateUser(User $user) : User
    // {
    //     $query= $this->db->prepare("UPDATE users SET username=:value2, first_name=:value3, last_name=:value4, email=:value5 WHERE id=:value1");
    //     $parameters = [
    //     'value1' => $user -> getId(),
    //     'value2' => $user -> getUsername(),
    //     'value3' => $user -> getFirstName(),
    //     'value4' => $user -> getLastName(),
    //     'value5' => $user -> getEmail()
    //     ];
    //     $query->execute($parameters);

    //     $query= $this->db->prepare("SELECT * FROM users WHERE email=:value");
    //     $parameters=['value' => $user -> getEmail()];
    //     $query->execute($parameters);
    //     $loadedUpdatedUser = $query->fetch(PDO::FETCH_ASSOC);

    //     $loadedUpdatedUserObject=new User ($loadedUpdatedUser["id"], $loadedUpdatedUser["username"],$loadedUpdatedUser["first_name"], $loadedUpdatedUser["last_name"], $loadedUpdatedUser["email"]);

    //     return $loadedUpdatedUserObject;
    // }

    // public function deleteUser(int $id) : array
    // {
    //     $query= $this->db->prepare("DELETE FROM users WHERE id=:value");
    //     $parameters = [
    //     'value' => $id,
    //     ];
    //     $query->execute($parameters);

    //     return $this->getAllUsers();
    // }
}
