const NavBar = document.getElementById('nav')
const NavBarToggle = document.getElementById('NavBarToggle')
NavBarToggle.addEventListener('click', () => {
    let nav_display = NavBar.style.display
    if(nav_display != "none"){
        NavBar.style.display = "none"
    } else {
        NavBar.style.display = "block"
    }
})
