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

    public function createFoodStyle(FoodStyle $foodStyle) : void
    {
        $query = $this->db->prepare('INSERT INTO food_styles VALUES (null, :value1, :value2)');
        $parameters = [
        'value1' => $foodStyle -> getName(),
        'value2' => $foodStyle -> getDescription()
        ];
        $query->execute($parameters);
    }

    public function updateFoodStyle(FoodStyle $foodStyle) : void
    {
        $query= $this->db->prepare("UPDATE food_styles SET name=:value2, description=:value3 WHERE id=:value1");
        $parameters = [
        'value1' => $foodStyle -> getId(),
        'value2' => $foodStyle -> getName(),
        'value3' => $foodStyle -> getDescription()
        ];
        $query->execute($parameters);
    }

    public function deleteFoodStyle(int $id) : void
    {
        $query= $this->db->prepare("DELETE FROM food_styles WHERE id=:value");
        $parameters = [
        'value' => $id,
        ];
        $query->execute($parameters);
    }
}
