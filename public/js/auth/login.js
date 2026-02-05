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
        console.log("Respuesta login:", data);
        if (data && data.success) {
          // Redirigir a /home cuando login exitoso
          window.location.href = "/home";
        } else {
          alert(data.message || "Credenciales inválidas");
        }
      })
      .catch((err) => {
        console.error("Error en fetch:", err);
        alert("Error en la conexión: " + (err.message || err));
      });
  });
});
