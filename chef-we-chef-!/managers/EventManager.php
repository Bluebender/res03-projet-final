<?php


class EventManager extends AbstractManager {

    public function getAllEvents() : array{   
        $query = $this->db->prepare('SELECT * FROM events');
        $query->execute();
        $loadedEvents = $query->fetchAll(PDO::FETCH_ASSOC);

        $loadedEventsObject=[];
        foreach ($loadedEvents as $loadedEvent){
            $loadedEventObject = new Event ($loadedEvent["id"], $loadedEvent["event"], $loadedEvent["slot"], $loadedEvent["availablity"], $loadedEvent["chief_id"]);
            $loadedEventsObject[] = $loadedEventObject;
        }
        // var_dump($loadedEventsObject);
        return $loadedEventsObject;
    }
}
