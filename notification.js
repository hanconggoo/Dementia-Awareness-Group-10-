// Check if the browser supports notifications
if ("Notification" in window) {
  // Function to check login status
  function checkLoginStatus() {
    fetch("check_login_success.php")
      .then((response) => response.text())
      .then((data) => {
        // If the login status is "true", the user is logged in, and we don't show the notification
        if (data.trim() === "false") {
          showNotification();
        }
      })
      .catch((error) => {
        console.error("Error checking login status: " + error);
      });
  }

  // Function to show the notification
  function showNotification() {
    // Request permission for showing notifications (optional)
    Notification.requestPermission().then((permission) => {
      if (permission === "granted") {
        // Create a new notification
        const notification = new Notification(
          "Welcome to the Dementia Awareness Website!",
          {
            body: "Please ensure you have logged in and finish your quiz",
          }
        );

        notification.onclick = function () {};
      }
    });
  }

  checkLoginStatus();
}
