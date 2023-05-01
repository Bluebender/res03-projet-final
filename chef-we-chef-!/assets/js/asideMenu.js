function asideMenu(){
    
    let menuBtn = document.getElementById('menuBtn');
    let aside = document.getElementById('visitor_aside');

    menuBtn.addEventListener('click', function(){
    
        aside.classList.toggle('hidden');
    
    });

}

export { asideMenu };