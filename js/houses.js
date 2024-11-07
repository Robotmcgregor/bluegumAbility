document.addEventListener('DOMContentLoaded', function () {
  const otherGenderRadio = document.getElementById('genderOther');
  const otherGenderDiv = document.getElementById('otherGenderDiv');

  otherGenderRadio.addEventListener('change', function () {
    if (this.checked) {
      otherGenderDiv.style.display = 'block';
    } else {
      otherGenderDiv.style.display = 'none';
    }
  });

  // Hide the 'Other' gender input field if the 'Other' radio button is not selected
  const genderRadios = document.querySelectorAll('input[name="gender"]');
  genderRadios.forEach(radio => {
    radio.addEventListener('change', function () {
      if (!otherGenderRadio.checked) {
        otherGenderDiv.style.display = 'none';
      }
    });
  });
});

