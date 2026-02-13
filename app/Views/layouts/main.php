<!DOCTYPE html>
<html lang="en">
<!-- dir="rtl"-->

<!-- Mirrored from adminuiux.com/adminuiux/adminux/html/adminux-dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 11 Jan 2026 07:04:46 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Home - Grupo Es</title>
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

    <!-- SweetAlert2 -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?= $this->renderSection('styles') ?>

    <script defer src="assets/js/app134b.js?772e8d72791201a52a4c"></script>
    <link href="assets/css/app134b.css?772e8d72791201a52a4c" rel="stylesheet">
</head>

<body class="main-bg main-bg-opac adminuiux-header-standard theme-blue adminuiux-header-transparent adminuiux-sidebar-fill-white adminuiux-sidebar-standard bg-r-gradient scrollup" data-theme="theme-blue" data-sidebarfill="adminuiux-sidebar-fill-white" data-sidebarlayout="adminuiux-sidebar-standard" data-bs-spy="scroll" data-bs-target="#list-example" data-bs-smooth-scroll="true" tabindex="0" data-headerlayout="adminuiux-header-standard" data-bggradient="bg-r-gradient"
    data-headerfill="adminuiux-header-transparent">
    <!-- Pageloader -->
    <div class="pageloader">
        <div class="container h-100">
            <div class="row justify-content-center align-items-center text-center h-100">
                <div class="col-12 mb-auto pt-4"></div>
                <div class="col-auto">
                    <img src="assets/img/logo.svg" alt="" class="height-100 mb-3">
                    <p class="h3 mb-0"><span class="text-gradient">Grupo Es</span></p>
                    <p class="small text-secondary mb-3"><span class="">Sistema Mia</span></p>
                    <div class="loader6 mb-2 mx-auto" style="border-color: var(--adminuiux-theme-2);"></div>
                </div>
                <div class="col-12 mt-auto pb-4">
                    <p class="text-secondary">Petal of flower being ready to <span class="text-gradient">blossom</span>...</p>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="url_backend" value="<?= getenv('URL_BACKEND') ?>">
    <input type="hidden" id="url_base" value="<?= base_url() ?>">
    <!-- standard header -->
    <header class="adminuiux-header">
        <!-- Fixed navbar -->
        <?= $this->include('layouts/header') ?>
    </header>
    <div class="adminuiux-wrap">

        <!-- Standard sidebar -->
        <!-- Standard sidebar -->
        <div class="adminuiux-sidebar shadow-sm">
            <div class="adminuiux-sidebar-inner">

                <!-- user information -->
                <div class="px-3 text-center not-iconic collapse" id="usersidebarprofile">
                    <div class="avatar avatar-100 rounded-circle shadow-sm my-3 bg-white">
                        <figure class="avatar avatar-90 rounded-circle coverimg">
                            <img src="assets/img/modern-ai-image/user-4.jpg" alt="" id="userphotoonboarding" style="display: none;">
                        </figure>
                    </div>
                    <h5 class="mb-0" id="usernamedisplay">Grupo Es</h5>
                    <p class="text-secondary small mb-3">Sistema Mia</p>
                </div>

                <!-- user menu navigation -->
                <ul class="nav flex-column menu-active-line">
                    <?= $this->include('layouts/menu') ?>
                </ul>

            </div>
        </div>
        <main class="adminuiux-content has-sidebar" onclick="contentClick()">

            <?= $this->renderSection('content') ?>
        </main>
    </div>

    <!-- notification -->
    <?= $this->include('layouts/notification') ?>

    <!-- themes -->
    <!-- theming offcanvas-->


    <!-- standard footer -->
    <footer class="adminuiux-footer has-adminuiux-sidebar mt-auto bg-theme-1">
        <?= $this->include('layouts/footer') ?>
    </footer>

    <!-- theming action-->


    <!-- Page Level js -->
    <!--<script src="assets/js/adminux/adminux-dashboard.js"></script>-->
    <script src="js/main.js"></script>

    <?= $this->renderSection('scripts') ?>

</body>


<!-- Mirrored from adminuiux.com/adminuiux/adminux/html/adminux-dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 11 Jan 2026 07:05:48 GMT -->

</html>