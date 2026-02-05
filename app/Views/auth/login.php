<!DOCTYPE html>
<html lang="en">
<!-- dir="rtl"-->

<!-- Mirrored from adminuiux.com/adminuiux/adminux/html/adminux-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 11 Jan 2026 07:08:34 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>GRUPO ES CONSULTORES</title>
    <link rel="icon" type="image/png" href="assets/img/favicon.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300..800&amp;family=SUSE:wght@100..800&amp;display=swap" rel="stylesheet">
    <style>
        :root {
            --adminuiux-content-font: "Open Sans", sans-serif;
            --adminuiux-content-font-weight: 400;
            --adminuiux-title-font: "SUSE", sans-serif;
            --adminuiux-title-font-weight: 600;
        }
    </style>

    <script defer src="assets/js/app134b.js?772e8d72791201a52a4c"></script>
    <link href="assets/css/app134b.css?772e8d72791201a52a4c" rel="stylesheet">
</head>

<body class="main-bg main-bg-opac adminuiux-header-standard theme-blue adminuiux-header-transparent adminuiux-sidebar-fill-white adminuiux-sidebar-standard bg-r-gradient scrollup" data-theme="theme-blue" data-sidebarfill="adminuiux-sidebar-fill-white" data-sidebarlayout="adminuiux-sidebar-standard" data-bs-spy="scroll" data-bs-target="#list-example" data-bs-smooth-scroll="true" tabindex="0" data-headerlayout="adminuiux-header-standard" data-bggradient="bg-r-gradient"
    data-headerfill="adminuiux-header-transparent"><!-- -->
    <!-- Pageloader -->
    <div class="pageloader">
        <div class="container h-100">
            <div class="row justify-content-center align-items-center text-center h-100">
                <div class="col-12 mb-auto pt-4"></div>
                <div class="col-auto">
                    <img src="assets/img/logo.svg" alt="" class="height-100 mb-3">
                    <p class="h3 mb-0"><span class="text-gradient">GRUPO ES</span></p>
                    <p class="small text-secondary mb-3"><span class="">GRUPO ES CONSULTORES</span></p>
                    <div class="loader6 mb-2 mx-auto" style="border-color: var(--adminuiux-theme-2);"></div>
                </div>
                <div class="col-12 mt-auto pb-4">
                    <p class="text-secondary">Petal of flower being ready to <span class="text-gradient">blossom</span>...</p>
                </div>
            </div>
        </div>
    </div> <!-- standard header -->
    <!-- standard header -->

    <main class="flex-shrink-0 pt-0 z-index-1">
        <div class="container">
            <div class="auth-wrapper">

                <!-- login wrap -->
                <div class="row justify-content-center minheight-dynamic" style="--mih-dynamic: calc(100vh - 135px)">
                    <div class="col-12 col-md-8 col-xl-6">
                        <div class="h-100 py-4 px-md-3">
                            <div class="row h-100 align-items-center justify-content-center mt-md-3">
                                <div class="col-12 col-sm-8 col-md-11 col-xl-11 col-xxl-10 login-box">
                                    <div class="card adminuiux-card shadow-sm mb-2">
                                        <div class="card-body">
                                            <div class="text-center mb-4">
                                                <img src="assets/img/logo.svg" alt="logo" class="mb-3" style="height:64px">
                                                <h2 class="mb-1 text-theme-1">Sistema Mia</h2>
                                                <p class="text-secondary small">Accede con tus credenciales al panel administrativo</p>
                                            </div>

                                            <form id="loginForm" novalidate>
                                                <div class="mb-3">
                                                    <label class="form-label">Correo Electrónico</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                                        <input type="email" class="form-control" id="emailadd" name="email" placeholder="usuario@gmail.com" required autofocus>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Contraseña</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                                        <input type="password" class="form-control" id="passwd" name="password" placeholder="Ingresa tu contraseña" required>
                                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword" aria-label="Mostrar contraseña"><i class="bi bi-eye"></i></button>
                                                    </div>
                                                </div>

                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="rememberMe">
                                                        <label class="form-check-label small" for="rememberMe">Recordarme</label>
                                                    </div>
                                                    <div>
                                                        <a href="#" class="small">¿Olvidaste tu contraseña?</a>
                                                    </div>
                                                </div>

                                                <div class="d-grid mb-3">
                                                    <button type="submit" class="btn btn-lg btn-theme">Iniciar sesión</button>
                                                </div>

                                                <div class="text-center small text-secondary">
                                                    ¿No tienes cuenta? <a href="#">Contacta al administrador</a>
                                                </div>
                                            </form>

                                            <script>
                                                (function() {
                                                    const toggle = document.getElementById('togglePassword');
                                                    const pwd = document.getElementById('passwd');
                                                    if (toggle && pwd) {
                                                        toggle.addEventListener('click', function() {
                                                            const type = pwd.getAttribute('type') === 'password' ? 'text' : 'password';
                                                            pwd.setAttribute('type', type);
                                                            this.querySelector('i').classList.toggle('bi-eye');
                                                            this.querySelector('i').classList.toggle('bi-eye-slash');
                                                        });
                                                    }
                                                })();
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- standard footer -->
    <!-- standard index footer -->
    <footer class="adminuiux-footer mt-auto bg-theme-1">
        <div class="container-fluid text-center">
            <span class="small">Grupo Es Consultores @2026, <a href="https://grupoesconsultores.com/" target="_blank" class="text-white">Sistema Mia</a> ❤️
            </span>
        </div>
    </footer>

    <script src="assets/js/adminux/adminux-auth.js" type="text/javascript"></script>
    <script src="js/auth/login.js" type="text/javascript"></script>
</body>


<!-- Mirrored from adminuiux.com/adminuiux/adminux/html/adminux-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 11 Jan 2026 07:08:35 GMT -->

</html>