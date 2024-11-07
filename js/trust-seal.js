document.addEventListener("DOMContentLoaded", function() {
  const trustSealContainer = document.getElementById('trust-seal-container');
  if (trustSealContainer) {
    trustSealContainer.style.position = 'fixed';
    trustSealContainer.style.bottom = '10px';
    trustSealContainer.style.right = '10px';
    trustSealContainer.style.display = 'block';

    setTimeout(() => {
      trustSealContainer.style.display = 'none';
    }, 10000); // 10 seconds
  }
});
