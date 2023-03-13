<?php


class ChiefManager extends AbstractManager {

    public function getAllChefs() : array
    {   
        $query = $this->db->prepare('SELECT * FROM chiefs');
        $query->execute();
        $loadedChiefs = $query->fetchAll(PDO::FETCH_ASSOC);

        $loadedChiefsObject=[];
        foreach ($loadedChiefs as $loadedChief){
            $loadedChiefObject = new Chief ($loadedChief["id"], $loadedChief["first_name"], $loadedChief["last_name"], $loadedChief["chief_name"], $loadedChief["email"], $loadedChief["password"], $loadedChief["phone"], $loadedChief["profil_picture_url"], $loadedChief["description"], $loadedChief["first_food_style_id"], $loadedChief["second_food_style_id"]);
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

        $loadedChiefObject = new Chief ($loadedChief["id"], $loadedChief["first_name"], $loadedChief["last_name"], $loadedChief["chief_name"], $loadedChief["email"], $loadedChief["password"], $loadedChief["phone"], $loadedChief["profil_picture_url"], $loadedChief["description"], $loadedChief["first_food_style_id"], $loadedChief["second_food_style_id"]);
        
        // var_dump($loadedChiefObject);
        return $loadedChiefObject;
    }

    public function getChiefByEmail(string $email) : Chief
    {
        $query= $this->db->prepare("SELECT * FROM chiefs WHERE email=:value");
        $parameters=['value' => $email];
        $query->execute($parameters);
        $loadedChief = $query->fetch(PDO::FETCH_ASSOC);

        $loadedChiefObject = new Chief ($loadedChief["id"], $loadedChief["first_name"], $loadedChief["last_name"], $loadedChief["chief_name"], $loadedChief["email"], $loadedChief["password"], $loadedChief["phone"], $loadedChief["profil_picture_url"], $loadedChief["description"], $loadedChief["first_food_style_id"], $loadedChief["second_food_style_id"]);
        
        // var_dump($loadedChiefObject);
        return $loadedChiefObject;
    }

    public function createChief(Chief $chief) : Chief
    {
        $query = $this->db->prepare('INSERT INTO chiefs VALUES (null, :value1, :value2, :value3, :value4, :value5, :value6, :value7, :value8, :value9, :value10)');
        $parameters = [
        'value1' => $chief -> getFirstName(),
        'value2' => $chief -> getLastName(),
        'value3' => $chief -> getChiefName(),
        'value4' => $chief -> getEmail(),
        'value5' => $chief -> getPassword(),
        'value6' => $chief -> getPhone(),
        'value7' => $chief -> getProfilPictureUrl(),
        'value8' => $chief -> getDescription(),
        'value9' => $chief -> getFirstFoodStyleId(),
        'value10' => $chief -> getSecondFoodStyleId()
        ];
        $query->execute($parameters);

        $query= $this->db->prepare("SELECT * FROM chiefs WHERE email=:value");
        $parameters=['value' => $chief -> getEmail()];
        $query->execute($parameters);
        $loadedSavedChief = $query->fetch(PDO::FETCH_ASSOC);

        $loadedSavedChiefObject= new Chief ($loadedSavedChief["id"], $loadedSavedChief["first_name"], $loadedSavedChief["last_name"], $loadedSavedChief["chief_name"], $loadedSavedChief["email"], $loadedSavedChief["password"], $loadedSavedChief["phone"], $loadedSavedChief["profil_picture_url"], $loadedSavedChief["description"], $loadedSavedChief["first_food_style_id"], $loadedSavedChief["second_food_style_id"]);

        return $loadedSavedChiefObject;
    }

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
