<?php

class Dish {
    private ?int $id;
    private string $name;
    private string $pictureUrl;
    private string $description;
    private string $price;
    private int $chiefId;
    private int $foodStyleId;
    private int $categoryId;

    public function __construct(?int $id, string $name, string $pictureUrl, string $description, string $price, int $chiefId, int $foodStyleId, int $categoryId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->pictureUrl = $pictureUrl;
        $this->description = $description;
        $this->price = $price;
        $this->chiefId = $chiefId;
        $this->foodStyleId = $foodStyleId;
        $this->categoryId = $categoryId;
    }

    public function getId() : ?int
    {
        return $this->id;
    }
    public function setId(?int $id) : void
    {
        $this->id = $id;
    }


    public function getName() : string
    {
        return $this->name;
    }
    public function setName(string $name) : void
    {
        $this->name = $name;
    }


    public function getPictureUrl() : string
    {
        return $this->pictureUrl;
    }
    public function setPictureUrl(string $pictureUrl) : void
    {
        $this->pictureUrl = $pictureUrl;
    }


    public function getDescription() : string
    {
        return $this->description;
    }
    public function setDescription(string $description) : void
    {
        $this->description = $description;
    }


    public function getPrice() : string
    {
        return $this->price;
    }
    public function setPrice(string $price) : void
    {
        $this->price = $price;
    }


    public function getChiefId() : int
    {
        return $this->chiefId;
    }
    public function setChiefId(string $chiefId) : void
    {
        $this->chiefId = $chiefId;
    }

    
    public function getFoodStyleId() : int
    {
        return $this->foodStyleId;
    }
    public function setFoodStyleId(string $foodStyleId) : void
    {
        $this->foodStyleId = $foodStyleId;
    }


    public function getCategoryId() : int
    {
        return $this->categoryId;
    }
    public function setCategoryId(string $categoryId) : void
    {
        $this->categoryId = $categoryId;
    }

}