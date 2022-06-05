let load = () => {
    let overlay = document.getElementById('overlay');
    let sideMenu = document.getElementById('side-menu');
    let hamburgerBtn = document.getElementById("hamburger-btn");
    let closeBtn = document.getElementById("close-btn");

    overlay.style.opacity = 0;
    sideMenu.style.transform = "translateX(-100%)";
    closeBtn.style.opacity = 0;

    hamburgerBtn.style.zIndex = 50;

    hamburgerBtn.addEventListener("click", () => {
        overlay.style.opacity = 1.0;
        sideMenu.style.transform = "translateX(0px)";
        closeBtn.style.opacity = 1.0;
        hamburgerBtn.style.zIndex = 0;
    });

    closeBtn.addEventListener("click", () => {
        overlay.style.opacity = 0.0;
        sideMenu.style.transform = "translateX(-100%)";
        closeBtn.style.opacity = 0.0;
        hamburgerBtn.style.zIndex = 50;
    });
}
