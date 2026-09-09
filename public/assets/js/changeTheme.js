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
function initTheme() {
    const theme = localStorage.getItem('theme');
    if (theme) {
        document.body.classList.remove('theme-dark', 'theme-warm');
        document.body.classList.add('theme-' + theme);
    }
}
initTheme()
changeTheme()