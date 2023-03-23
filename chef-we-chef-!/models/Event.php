<?php

class Event {
    private ?int $id;
    private string $event;
    private string $slot;
    private int $availablity;
    private int $chiefId;

    public function __construct(?int $id, string $event, string $slot, int $availablity, int $chiefId)
    {
        $this->id = $id;
        $this->event = $event;
        $this->slot = $slot;
        $this->availablity = $availablity;
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


    public function getEvent() : string
    {
        return $this->event;
    }
    public function setEvent(string $event) : void
    {
        $this->event = $event;
    }


    public function getSlot() : string
    {
        return $this->slot;
    }
    public function setSlot(string $slot) : void
    {
        $this->slot = $slot;
    }
    
    public function getAvailablity() : int
    {
        return $this->availablity;
    }
    public function setAvailablity(int $availablity) : void
    {
        $this->availablity = $availablity;
    }


    public function getChiefId() : string
    {
        return $this->chiefId;
    }
    public function setChiefId(string $chiefId) : void
    {
        $this->chiefId = $chiefId;
    }


    public function toArray() : array
    {
        return [
            "id" => $this->id,
            "event" => $this->event,
            "slot" => $this->slot,
            "availablity" => $this->availablity,
            "chiefId" => $this->chiefId,
        ];
    }

}