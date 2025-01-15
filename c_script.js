// Highlight Active Page in Navigation
document.addEventListener("DOMContentLoaded", function () {
  const currentPath = window.location.pathname;
  const navLinks = document.querySelectorAll("nav a");

  navLinks.forEach((link) => {
    if (link.getAttribute("href").endsWith(currentPath.split("/").pop())) {
      link.classList.add("active");
    }
  });
});

// Validate Contact Form Submission
const contactForm = document.querySelector("form");

if (contactForm) {
  contactForm.addEventListener("submit", function (event) {
    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const message = document.getElementById("message").value.trim();

    if (!name || !email || !message) {
      event.preventDefault();
      alert("Please fill out all fields before submitting.");
    } else {
      alert("Message Sent Successfully!");
    }
  });
}

