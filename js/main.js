
  // Assign current field to navigation items
  document.addEventListener("DOMContentLoaded", function() {
    // Get the current URL path (excluding domain)
    var currentPath = window.location.pathname.split("/").pop();
    if (currentPath === "" || currentPath === "/") {
      currentPath = "index.html"; // Set default for the homepage
    }

    // Get all navigation links
    var navLinks = document.querySelectorAll(".navbar-nav .nav-link");
    var dropdownLinks = document.querySelectorAll(".dropdown-menu .dropdown-item");
    var servicesDropdown = document.getElementById("navbarDropdown");

    // Loop through links to check if the href matches the current path
    let isActive = false;
    navLinks.forEach(function(link) {
      var linkPath = link.getAttribute("href").split("/").pop(); // Only compare the last part of the href
      if (linkPath.toLowerCase() === currentPath.toLowerCase()) {
        link.classList.add("current-page");
        isActive = true;
      }
    });

    // Check if any dropdown items match the current path
    dropdownLinks.forEach(function(link) {
      var linkPath = link.getAttribute("href").split("/").pop();
      if (linkPath.toLowerCase() === currentPath.toLowerCase()) {
        link.classList.add("current-page");
        if (servicesDropdown) {
          servicesDropdown.classList.add("current-page");
        }
        isActive = true;
      }
    });

    // Optionally, highlight 'Home' if no other active links are found
    if (!isActive) {
      var homeLink = document.querySelector('a[href="index.html"], a[href="/"]');
      if (homeLink) {
        homeLink.classList.add("current-page");
      }
    }
  });



  // Disabling form submissions if there are invalid fields
  (function() {
    'use strict';
    window.addEventListener('load', function() {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();

// Show/hide the "Other" gender text input

    document.addEventListener("DOMContentLoaded", function () {
      const genderOther = document.getElementById('genderOther');
      const otherGenderDiv = document.getElementById('otherGenderDiv');
      
      document.querySelectorAll('input[name="gender"]').forEach((radio) => {
        radio.addEventListener('change', function () {
          if (genderOther.checked) {
            otherGenderDiv.style.display = 'block';  // Show the 'Other' text input field
          } else {
            otherGenderDiv.style.display = 'none';   // Hide the 'Other' text input field
          }
        });
      });
    });



      //Get the button:
      mybutton = document.getElementById("myBtn");

      // When the user scrolls down 20px from the top of the document, show the button
      window.onscroll = function() {
        scrollFunction()
      };

      function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
          mybutton.style.display = "block";
        } else {
          mybutton.style.display = "none";
        }
      }

      // When the user clicks on the button, scroll to the top of the document
      function topFunction() {
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
      }




