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
  
  // Dropdown elements for "Services" and "Policies"
  var servicesDropdown = document.getElementById("servicesDropdown");
  var policyDropdown = document.getElementById("policyDropdown");

  // Loop through links to check if the href matches the current path
  let isActive = false;
  navLinks.forEach(function(link) {
      var linkPath = link.getAttribute("href").split("/").pop(); // Only compare the last part of the href
      if (linkPath.toLowerCase() === currentPath.toLowerCase()) {
          link.classList.add("current-page");
          link.parentElement.classList.add("current-page");
          isActive = true;
      }
  });

  // Check if any dropdown items match the current path for Services or Policies
  dropdownLinks.forEach(function(link) {
      var linkPath = link.getAttribute("href").split("/").pop();
      if (linkPath.toLowerCase() === currentPath.toLowerCase()) {
          link.classList.add("current-page");

          // Check which dropdown the link belongs to and add 'current-page' to the appropriate dropdown
          if (link.closest(".dropdown-menu").previousElementSibling === servicesDropdown) {
              servicesDropdown.classList.add("current-page");
          } else if (link.closest(".dropdown-menu").previousElementSibling === policyDropdown) {
              policyDropdown.classList.add("current-page");
          }

          isActive = true;
      }
  });

  // Optionally, highlight 'Home' if no other active links are found
  if (!isActive && currentPath === "index.html") {
      var homeLink = document.querySelector('a[href="index.html"]');
      if (homeLink) {
          homeLink.classList.add("current-page");
          homeLink.parentElement.classList.add("current-page");
      }
  }

  // Lazy loading of images
  let lazyImages = [].slice.call(document.querySelectorAll("img.lazyload"));

  if ("IntersectionObserver" in window) {
      let lazyImageObserver = new IntersectionObserver(function(entries, observer) {
          entries.forEach(function(entry) {
              if (entry.isIntersecting) {
                  let lazyImage = entry.target;
                  lazyImage.src = lazyImage.dataset.src;
                  lazyImage.classList.remove("lazyload");
                  lazyImage.classList.add("lazyloaded");
                  lazyImageObserver.unobserve(lazyImage);
              }
          });
      });

      lazyImages.forEach(function(lazyImage) {
          lazyImageObserver.observe(lazyImage);
      });
  } else {
      // Fallback for browsers without IntersectionObserver support
      lazyImages.forEach(function(lazyImage) {
          lazyImage.src = lazyImage.dataset.src;
          lazyImage.classList.remove("lazyload");
          lazyImage.classList.add("lazyloaded");
      });
  }

  // Ensure the banner image source is correctly set
  var bannerImg = document.querySelector(".banner-img");
  if (bannerImg && !bannerImg.src) {
    bannerImg.src = "pexels-disability-photo-banner.jpg"; // Fallback image
  }
});

// Show the trust seal for 10 seconds
document.addEventListener('DOMContentLoaded', function() {
  var trustSealContainer = document.getElementById('trust-seal-container');
  if (trustSealContainer) {
    trustSealContainer.style.display = 'block';
    setTimeout(function() {
      trustSealContainer.style.display = 'none';
    }, 10000);
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

// Example scrollFunction implementation
function scrollFunction() {
    var someElement = document.getElementById('someElementId');
    if (someElement) {
        someElement.style.display = 'block';
    }
}

// Ensure scrollFunction is called appropriately
window.addEventListener('scroll', function() {
    scrollFunction();
});




