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

    public function createEvent($newEvent){
        $events = $this->eventManag->getAllEvents();
        $chiefEvents = [];
        foreach ($events as $event){
            if($event->getChiefId()===$_SESSION["chiefId"]){
                $chiefEvents[]=$event;
            }
        }
        
        
        $toCreate=true;

        foreach ($chiefEvents as $event){
            $eventInForm =   $event->getEvent()."-".$event->getSlot();
            // var_dump($eventInForm);

            if ($newEvent["newEvent"] == $event->getEvent()."-".$event->getSlot()){
                if($event->getAvailablity()===0){
                    // Delete event
                    $this->jsRender(["On est dans la suppression"]);
                    $this->eventManag->deleteEvent($event->getId());
                    $toCreate=false;
                }
                else{
                    // Change availability to 0
                    $this->jsRender(["On est dans l'update"]);
                    $this->eventManag->updateEvent($event->getId());
                    $toCreate=false;
                }
            }
        }
        if($toCreate){
            // Create event in DB
            $this->jsRender(["On est dans la creation"]);

            $newEventCut = explode("-", $newEvent["newEvent"]);
            $eventArry["event"]=$newEventCut[0]."-".$newEventCut[1]."-".$newEventCut[2];
            $eventArry["slot"]=$newEventCut[3];
                    var_dump($eventArry);

            

            $this->eventManag->createEvent($eventArry);
            
        }
    }
}