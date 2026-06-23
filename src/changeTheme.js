// Temas
function changeTheme() {
    const butts = document.querySelectorAll(".butt-theme")
    butts.forEach(comp => {
        comp.addEventListener("click", () => {
            const theme = comp.id
            document.body.classList.remove('theme-dark', 'theme-warm');
            if (theme !== 'light') document.body.classList.add('theme-' + theme);
            localStorage.setItem('theme', theme);
        })
    })

}
function navigateHome(){
    const titleLogo = document.querySelector('.title-logo')
    titleLogo.addEventListener('click',(e)=>{
        location.href = 'index.php';
    })
}

changeTheme()
navigateHome()