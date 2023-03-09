<?php


class FoodStyleManager extends AbstractManager {

    public function getAllFoodStyles() : array
    {   
        $query = $this->db->prepare('SELECT * FROM food_styles');
        $query->execute();
        $loadedFoodStyles = $query->fetchAll(PDO::FETCH_ASSOC);

        $loadedFoodStylesObject=[];
        foreach ($loadedFoodStyles as $loadedFoodStyle){
            $loadedFoodStyleObject = new FoodStyle ($loadedFoodStyle["id"], $loadedFoodStyle["name"], $loadedFoodStyle["description"]);
            $loadedFoodStylesObject[] = $loadedFoodStyleObject;
        }
        // var_dump($loadedFoodStylesObject);
        return $loadedFoodStylesObject;
    }

    public function getFoodStyleById(int $id) : FoodStyle
    {
        $query= $this->db->prepare("SELECT * FROM `food_styles` WHERE id=:value");
        $parameters=['value' => $id];
        $query->execute($parameters);
        $loadedFoodStyle = $query->fetch(PDO::FETCH_ASSOC);

        $loadedFoodStyleObject = new FoodStyle ($loadedFoodStyle["id"], $loadedFoodStyle["name"], $loadedFoodStyle["description"]);
        
        // var_dump($loadedFoodStyleObject);
        return $loadedFoodStyleObject;
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
