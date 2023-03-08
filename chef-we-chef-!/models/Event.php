<?php

class Event {
    private ?int $id;
    private date $day;
    private int $slot;
    private int $chiefId;

    public function __construct(?int $id, date $day, int $slot, int $chiefId)
    {
        $this->id = $id;
        $this->day = $day;
        $this->slot = $slot;
        $this->chiefId = $chiefId;
    }

    public function getId() : ?int
    {
        return $this->id;
    }
    public function setId(?int $id) : void
    {
        $this->id = $id;
    }


    public function getDay() : date
    {
        return $this->day;
    }
    public function setDay(string $day) : void
    {
        $this->day = $day;
    }


    public function getSlot() : int
    {
        return $this->slot;
    }
    public function setSlot(string $slot) : void
    {
        $this->slot = $slot;
    }


    public function getChiefId() : int
    {
        return $this->chiefId;
    }
    public function setChiefId(string $chiefId) : void
    {
        $this->chiefId = $chiefId;
    }

}