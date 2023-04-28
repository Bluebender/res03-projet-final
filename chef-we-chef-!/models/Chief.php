<?php

class Chief {
    private ?int $id;
    private string $firstName;
    private string $lastName;
    private ?string $chiefName;
    private string $email;
    private string $password;
    private string $phone;
    private string $profilPictureUrl;
    private string $description;
    private int $foodStyleId;

    public function __construct(?int $id, string $firstName, string $lastName, ?string $chiefName, string $email, string $password, string $phone, string $profilPictureUrl, string $description, int $foodStyleId)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->chiefName = $chiefName;
        $this->email = $email;
        $this->password = $password;
        $this->phone = $phone;
        $this->profilPictureUrl = $profilPictureUrl;
        $this->description = $description;
        $this->foodStyleId = $foodStyleId;
    }

    public function getId() : ?int
    {
        return $this->id;
    }
    public function setId(?int $id) : void
    {
        $this->id = $id;
    }


    public function getFirstName() : string
    {
        return $this->firstName;
    }
    public function setFirstName(string $firstName) : void
    {
        $this->firstName = $firstName;
    }


    public function getLastName() : string
    {
        return $this->lastName;
    }
    public function setLastName(string $lastName) : void
    {
        $this->lastName = $lastName;
    }


    public function getChiefName() : ?string
    {
        return $this->chiefName;
    }
    public function setChiefName(string $chiefName) : void
    {
        $this->chiefName = $chiefName;
    }


    public function getEmail() : string
    {
        return $this->email;
    }
    public function setEmail(string $email) : void
    {
        $this->email = $email;
    }


    public function getPassword() : string
    {
        return $this->password;
    }
    public function setPassword(string $password) : void
    {
        $this->password = $password;
    }
    

    public function getPhone() : string
    {
        return $this->phone;
    }
    public function setPhone(string $phone) : void
    {
        $this->phone = $phone;
    }


    public function getProfilPictureUrl() : string
    {
        return $this->profilPictureUrl;
    }
    public function setProfilPictureUrl(string $profilPictureUrl) : void
    {
        $this->profilPictureUrl = $profilPictureUrl;
    }


    public function getDescription() : string
    {
        return $this->description;
    }
    public function setDescription(string $description) : void
    {
        $this->description = $description;
    }


    public function getFoodStyleId() : int
    {
        return $this->foodStyleId;
    }
    public function setFoodStyleId(string $foodStyleId) : void
    {
        $this->foodStyleId = $foodStyleId;
    }

}