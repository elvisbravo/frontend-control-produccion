document.addEventListener("DOMContentLoaded", function () {
  const loginForm = document.getElementById("loginForm");

  loginForm.addEventListener("submit", (e) => {
    e.preventDefault();

    const formData = new FormData(loginForm);

    fetch("/auth/login", {
      method: "POST",
      body: formData,
      credentials: "same-origin",
      headers: {
        "X-Requested-With": "XMLHttpRequest",
      },
    })
      .then((res) => res.json())
      .then((data) => {
        if (data.status == "error") {
          alert(data.message);
          return false;
        }
      
        window.location.href = "/home";
        
        
      })
      .catch((err) => {
        console.error("Error en fetch:", err);
        alert("Error en la conexión: " + (err.message || err));
      });
  });
});
