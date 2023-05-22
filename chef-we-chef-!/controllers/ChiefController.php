<?php

class ChiefController extends AbstractController {
    private ChiefManager $chiefManag;
    private FoodStyleManager $foodStyleManag;
    private DishManager $dishManag;
    private EventManager $eventManag;

    public function __construct()
    {
        $this->chiefManag = new ChiefManager();
        $this->foodStyleManag = new FoodStyleManager();
        $this->dishManag = new DishManager();
        $this->eventManag = new EventManager();
    }

    private function chiefsData(){
        // get all the chiefs from the manager
        $allChiefs = $this->chiefManag->getAllChefs();
        
        $data=[];
        foreach ($allChiefs as $chief){
            // Je cré le tableau de donnée et j'y ajoute le chef
            $chiefWithFoodStyleAndSpecialDish=[];
            $chiefWithFoodStyleAndSpecialDish["chief"] = $chief;

            // Je vais chercher le food-style qui va avec le plat et je l'ajoute au tableau           
            $foodStyleId1 = $chief->getFoodStyleId();
            $foodstyle1 = $this->foodStyleManag->getFoodStyleById($foodStyleId1);
            $chiefWithFoodStyleAndSpecialDish["foodStyle"][] = $foodstyle1;
            
            $data[] = $chiefWithFoodStyleAndSpecialDish;

        }
        return $data;
    }
    
    private function chiefData($id){
        $data = [];
        
        // On ajoute l'objet chief aux datas
        $chief = $this->chiefManag->getChiefById($id);
        $data["chief"]=$chief;
        
        // On ajoute les objets dish aux datas
        $dishes = $this->dishManag->getAllDishes();
        $chiefsDishes = [];
        foreach($dishes as $dish){
            if ($dish->getChiefId()===$chief->getId()){
                $chiefsDishes[]=$dish;
            }
        }
        $data["dishes"]=$chiefsDishes;

        // On ajoute les objets FoodStyle aux datas
        $foodStyles = $this->foodStyleManag->getAllFoodStyles();
        $chiefFoodStyles = [];
        foreach($foodStyles as $foodStyle){
            if ($chief->getFoodStyleId()===$foodStyle->getId()){
                $chiefFoodStyles []= $foodStyle;
            }
        }
        $data["foodstyles"]=$chiefFoodStyles;
        
        // Je rajoute les datas du calendar
        $calendarData = $this->calendarData();
        $data["calendar"]=$calendarData;
        
        // Je rajoute les datas du calendarByWeek
        $weekData = $this->calendarByWeek();
        $data["weekCalendar"]=$weekData;
        

        // Je rajoute les datas des events
        // $eventData = $this->eventManag->getAllEvents();
        // $data["events"]=$eventData;
        

        // var_dump($data);
        return $data;
    }
    
    public function displayAllChiefs(){
        $data = $this->chiefsData();

        $this->render("visitor/chiefs", $data);
    }

    public function visitorHome(){
        $data = $this->chiefsData();
        $test = $this->calendarByWeek();
        
        $longeurData = count($data);
        $threeLastChiefs = [$data[$longeurData-1], $data[$longeurData-2], $data[$longeurData-3]];

        $this->render("visitor/home", $threeLastChiefs);
    }
    
    public function error404(){

        $this->render("visitor/error404", []);
    }
    

    public function displayChief($id){
        $data = $this->chiefData($id);
        
        $this->render("visitor/chief", $data);
    }

    public function displayMonCompte($id){
        $data = $this->chiefData($id);
        
        $this->render("chef/profil", $data);
    }

    public function displayCalendar($id){
        $data = $this->chiefData($id);

        $this->render("chef/events", $data);
    }
    
    public function contactChief($get){

        // Affichage les infos du chef à contacter
        $chief = $this->chiefManag->getChiefById($get['id']);
        $chiefEmail = $chief->getEmail();
        $chiefName = $chief->getChiefName();
        $chiefId = $chief->getId();
        
        
        // Affichage de la date au format final
        $date=$get['date'];
        $dateElements=explode("-", $date);
        $month=["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];
        $slot=["12:00", "19:00"];
        $newDate=$dateElements[2]." ".$month[$dateElements[1]-1]." ".$dateElements[0]." à ".$slot[$dateElements[3]-1];

        if(!isset($_POST['title'])){

            $data['email']=$chiefEmail;
            $data['name']=$chiefName;
            $data['id']=$chiefId;
            $data['date']=$date;
            $data['newDate']=$newDate;
            
            $this->render("visitor/contactChief", $data);
            
        }
        else{
            $title   = $this->sanitize($_POST['title']);
            $email   = $this->sanitize($_POST['email']);
            $message = $this->sanitize($_POST['message']);
            
            $messageToSend = "Email de l'expéditeur: ".$email."\r\n"."Message: ".$message;
            mail($chiefEmail, $title, $messageToSend);
            
            $data['name'] = $chiefName;
            
            $this->render("visitor/contactValidation", $data);

        }

    }

    public function contactUs($post){
        
        $adminEmail         = "admin@admin.fr";
        $title              = $this->sanitize($_POST['contactSubject']);
        $contactEmail       = $this->sanitize($_POST['contactEmail']);
        $contactDescription = $this->sanitize($_POST['contactDescription']);
        
        $message = "Email de l'expéditeur: ".$contactEmail."\r\n"."Message: ".$contactDescription;
        mail($adminEmail, $title, $message);
        
        $this->render("visitor/contactValidation2", []);
    }

    // ADMIN
    public function adminAllChiefs(){
        $data = $this->chiefsData();

        $this->render("admin/chiefs", $data);
    }

    public function adminChief($id){
        $data = $this->chiefData($id);
        
        $this->render("admin/chief", $data);
    }

    public function deleteChief($id){
        $data = $this->chiefData($id);
        foreach($data["dishes"] as $dish){
            $this->dishManag->deleteDish($dish->getId());
        }        
        
        $this->chiefManag->deleteChief($id);

        header('Location: /res03-projet-final/chef-we-chef-!/admin');
    }
    
    
    // Calendar Datas
    private function calendarData(){
        // Set timezone
        date_default_timezone_set("Europe/Paris");
        // Get prev & next month
        if (isset($_GET["ym"])){
            $ym = $_GET["ym"];
        }
        else{
            $ym = date("Y-m");
        }
        // Check format
        $timestamp = strtotime($ym,"-01");
        if ($timestamp === false){
            $timestamp = time();
        }
        
        // Today
        $today = date("Y-m-d", time());
        // For h3 title
        $html_title = date("Y / m", $timestamp);

        // Create prev & next month link      mktime(hour,minute,second,month,day,year)
        $prev = date("Y-m", mktime(0, 0, 0, date("m", $timestamp)-1, 1, date("Y", $timestamp)));
        $next = date("Y-m", mktime(0, 0, 0, date("m", $timestamp)+1, 1, date("Y", $timestamp)));

        // Numer of day in a month
        $day_count = date("t", $timestamp);

        // 0:Lun 1:Mar 2:Mer...
        $str = date("w", mktime(0, 0, 0, date("m", $timestamp), 0, date("Y", $timestamp)));

        // Create Calendar!!
        $weeks = array();
        $week = "";
        
        $week .= str_repeat("<td></td>", $str);

        // import des event de la database
        $eventData = $this->eventManag->getAllEvents();
        $events = [];
        foreach ($eventData as $data){
            $events[]=$data->getEvent()."-".$data->getSlot();
        }

        for ($day=1; $day <= $day_count; $day++, $str++){
            $date;
            if(strlen($day)===1){
                $date = $ym."-0".$day;
            }
            else{
                $date = $ym."-".$day;
            }
            
            $slot1 = $date."-1";
            $slot2 = $date."-2";

            
            if ($today == $date){
                $week .= "
                    <td class='today'>
                        <p><strong>".$day."</strong></p>
                        <section>
                            <h4 class='hidden'>Week</h4>
                            <p data-date='".$date."-1' class='event'>Midi</p>
                            <p data-date='".$date."-2' class='event'>Soir</p>
                        </section>
                    ";
            }
            else{
                $week .= "
                    <td>
                        <p><strong>".$day."</strong></p>
                        <section>
                            <h4 class='hidden'>Week</h4>
                            <p data-date='".$date."-1' class='event'>Midi</p>
                            <p data-date='".$date."-2' class='event'>Soir</p>
                        </section>
                    ";
            }
            $week .= "</td>";
            
            // End of the week OR End of the month
            if ($str % 7 == 6 || $day == $day_count){
                
                if ($day == $day_count){
                    // Add empty cell
                    $week .= str_repeat("<td></td>", 6 - ($str % 7));
                }
                
                $weeks[] = "<tr>".$week."</tr>";
                
                // Prepare for new week
                $week = "";
            }
        }
        $data = [];
        $data["preview"]=$prev;
        $data["next"]=$next;
        $data["title"]=$html_title;
        $data["weeks"]=$weeks;
        
        
        return $data;
    }

    private function calendarByWeek(){

        // Set timezone
        date_default_timezone_set("Europe/Paris");
        
        $startOfWeek;
        if(isset($_GET['date'])){
            $startOfWeek=$_GET['date'];
        }
        else{
        // Date du jour
        $date = new DateTime('now');
        // Définir le début de la semaine
        $date->modify('this week');
        // Date du début de la semaine au format 2023-02-24
        $startOfWeek = $date->format('Y-m-d');
        }

        // Week table
        $weekDay = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
        // Month table
        $yearMonth = ['Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
        
        $weekData;
        $date = new DateTime($startOfWeek);
        for ($i=0; $i<7; $i++){
            $data=[];
            $day = $date->format('Y-m-d');
            $daystr = $weekDay[$i];
            $datestr = $date->format('d')." ".$yearMonth[$date->format('n')];
            $year = $date->format('Y');
            $data['date']=$day;
            $data['day']=$daystr;
            $data['dateStr']=$datestr;
            $data['year']=$year;
            $weekData['day'.$i+1]=$data;
            $date->modify('+1 day');
        }
        // Déclaration du début de la semaine suivante
        $week['weekData']=$weekData;
        $nextWeekDate = $date->format('Y-m-d');

        // Déclaration du début de la semaine précédente
        $date->modify('-14 days');
        $pastWeekDate = $date->format('Y-m-d');

        $week['nextWeekDate']= $nextWeekDate;  
        $week['pastWeekDate']= $pastWeekDate;  
        return $week;
    }
}