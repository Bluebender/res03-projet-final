<?php

class EventController extends AbstractController {
    private EventManager $eventManag;

    public function __construct()
    {
        $this->eventManag = new EventManager();
    }

    
    public function displayEvents($chiefId){
        $events = $this->eventManag->getAllEvents();
        $chiefEvents=[];
        foreach($events as $event){
            if(intval($event->getChiefId())===intval($chiefId)){
                $chiefEvents[]=$event;
            }
        }
        $chiefEventsArray=[];
        foreach ($chiefEvents as $event){
            $eventArray=$event->toArray();
            $chiefEventsArray[]=$eventArray;
        }
        // var_dump($eventsArray);
        $this->jsRender($chiefEventsArray);
    }



}