<?php


class ChiefManager extends AbstractManager {

    public function getAllChefs() : array
    {   
        $query = $this->db->prepare('SELECT * FROM chiefs');
        $query->execute();
        $loadedChiefs = $query->fetchAll(PDO::FETCH_ASSOC);

        $loadedChiefsObject=[];
        foreach ($loadedChiefs as $loadedChief){
            $loadedChiefObject = new Chief ($loadedChief["id"], $loadedChief["first_name"], $loadedChief["last_name"], $loadedChief["chief_name"], $loadedChief["company_name"], $loadedChief["email"], $loadedChief["phone"], $loadedChief["profil_picture_url"], $loadedChief["description"], $loadedChief["spécial_dish_id"], $loadedChief["first_food_style_id"], $loadedChief["second_food_style_id"]);
            $loadedChiefsObject[] = $loadedChiefObject;
        }
        // var_dump($loadedChiefsObject);
        return $loadedChiefsObject;
    }

    public function getChiefById(int $id) : Chief
    {
        $query= $this->db->prepare("SELECT * FROM chiefs WHERE id=:value");
        $parameters=['value' => $id];
        $query->execute($parameters);
        $loadedChief = $query->fetch(PDO::FETCH_ASSOC);

        $loadedChiefObject = new Chief ($loadedChief["id"], $loadedChief["first_name"], $loadedChief["last_name"], $loadedChief["chief_name"], $loadedChief["company_name"], $loadedChief["email"], $loadedChief["phone"], $loadedChief["profil_picture_url"], $loadedChief["description"], $loadedChief["spécial_dish_id"], $loadedChief["first_food_style_id"], $loadedChief["second_food_style_id"]);
        
        // var_dump($loadedChiefObject);
        return $loadedChiefObject;
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
