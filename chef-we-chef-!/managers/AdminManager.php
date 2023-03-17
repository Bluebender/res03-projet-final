<?php


class AdminManager extends AbstractManager {

    public function getAdmin() : Admin
    {   
        $query = $this->db->prepare('SELECT * FROM admin');
        $query->execute();
        $loadedAdmin = $query->fetch(PDO::FETCH_ASSOC);

        $loadedAdminObject = new Admin ($loadedAdmin["id"], $loadedAdmin["email"], $loadedAdmin["password"]);
        
        var_dump($loadedAdminObject);
        return $loadedAdminObject;
    }
}
