function showPopup() {
    var popup = document.getElementById("popup");
    popup.style.display = "block";
    setTimeout(function() {
      popup.style.display = "none";
      window.location.href = "../index.php";
    }, 2000); // 7000 milliseconds = 7 seconds
  }
  
  function closePopup() {
    var popup = document.getElementById("popup");
    popup.style.display = "none";
  }
  
  // Call showPopup function when the page loads (you might want to adjust this based on your specific login mechanism)
  window.onload = function() {
    showPopup();
  };
  