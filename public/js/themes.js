const btnSwitch = document.querySelector('#switch');

btnSwitch.addEventListener('click', ()=> {
    document.body.classList.toggle('dark');
    btnSwitch.classList.toggle('active');

    /**
     * Guarda el modo en localstorage.
     */
    //Pregunta si hay una clase "dark" en el body.
    if(document.body.classList.contains('dark')){
        //Guardo el modo dark-mode en localStorage.
        localStorage.setItem('dark-mode', 'true');
    } else {
        localStorage.setItem('dark-mode', 'false');
    }
});

/**
 * Obtener el modo actual.
 */
if(localStorage.getItem('dark-mode') === 'true'){
    document.body.classList.add('dark');
    btnSwitch.classList.add('active');
} else {
    document.body.classList.remove('dark');
    btnSwitch.classList.remove('active');
}