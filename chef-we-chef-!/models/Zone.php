<?php

class Zone {
    private ?int $id;
    private int $zipCode;
    private string $city;
    private int $radius;

    public function __construct(?int $id, int $zipCode, string $city, int $radius)
    {
        $this->id = $id;
        $this->zipCode = $zipCode;
        $this->city = $city;
        $this->radius = $radius;
    }

    public function getId() : ?int
    {
        return $this->id;
    }
    public function setId(?int $id) : void
    {
        $this->id = $id;
    }


    public function getZipCode() : int
    {
        return $this->zipCode;
    }
    public function setZipCode(string $zipCode) : void
    {
        $this->zipCode = $zipCode;
    }


    public function getCity() : int
    {
        return $this->city;
    }
    public function setCity(string $city) : void
    {
        $this->city = $city;
    }


    public function getRadius() : int
    {
        return $this->radius;
    }
    public function setRadius(string $radius) : void
    {
        $this->radius = $radius;
    }

}