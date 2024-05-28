  // JavaScript functions to control the side menu
    function openSideMenu() {
      document.getElementById("sideMenu").classList.add("open");
      document.addEventListener("click", closeSideMenuOutside);
    }

    function closeSideMenu() {
      document.getElementById("sideMenu").classList.remove("open");
      document.removeEventListener("click", closeSideMenuOutside);
    }

    function closeSideMenuOutside(event) {
      const sideMenu = document.getElementById("sideMenu");
      const targetElement = event.target;

      if (!sideMenu.contains(targetElement) && targetElement.tagName !== "BUTTON") {
        closeSideMenu();
      }
    }
function openSideMenu() {
  // Show the side menu
  document.getElementById("sideMenu").classList.add("open");

  // Disable scrolling of the website content
  document.body.style.overflow = "hidden";
}

function closeSideMenu() {
  // Hide the side menu
  document.getElementById("sideMenu").classList.remove("open");

  // Enable scrolling of the website content
  document.body.style.overflow = "auto";
}
