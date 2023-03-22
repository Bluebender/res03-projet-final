function calendar(){

    let slots=document.getElementsByClassName("event");


    for(let i = 0; i < slots.length; i++){
        slots[i].addEventListener("click", function(){
            console.log(slots[i]);
            console.log(slots[i].classList[0])
            slots[i].classList.toggle("notAvailable")
            slots[i].classList.toggle("available")
            
        });
        
        
    }



}

export { calendar };