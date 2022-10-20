const sidebar = document.getElementById("sidebar");
const closeButton = document.getElementById("closeSidebar");
const openButton = document.getElementById("sidebar-bttn");

const blindfold = document.getElementById("blindfold");

closeButton.addEventListener("click", function() {
    sidebar.classList.remove("show-sidebar");
    document.body.classList.toggle('opacity');
    blindfold.classList.remove("show-blindfold");
});

openButton.addEventListener("click", function() {
    sidebar.classList.add("show-sidebar");
    document.body.classList.toggle('opacity');
    blindfold.classList.add("show-blindfold");
});