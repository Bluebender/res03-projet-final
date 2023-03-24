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
    
    public function createEvent($event){
        $query = $this->db->prepare('INSERT INTO events VALUES (null, :value1, :value2, :value3, :value4)');
        $parameters = [
        'value1' => $event["event"],
        'value2' => $event["slot"],
        'value3' => 1,
        'value4' => $_SESSION["chiefId"]
        ];
        $query->execute($parameters);
    }
    public function updateEvent($id){
        $query = $this->db->prepare('UPDATE events SET availablity=:value2 WHERE id=:value1');
        $parameters = [
        'value1' => $id,
        'value2' => 0,
        ];
        $query->execute($parameters);
        
    }
    public function deleteEvent($id){
        $query= $this->db->prepare("DELETE FROM events WHERE id=:value");
        $parameters = [
        'value' => $id,
        ];
        $query->execute($parameters);
        
    }
}
