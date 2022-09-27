const sidebar = document.getElementById("sidebar");
const closeButton = document.getElementById("closeSidebar");
const openButton = document.getElementById("sidebar-bttn");

closeButton.addEventListener("click", function() {
    sidebar.classList.remove("show-sidebar");
    document.body.classList.toggle('opacity');
});

openButton.addEventListener("click", function() {
    sidebar.classList.add("show-sidebar");
    document.body.classList.toggle('opacity');
});