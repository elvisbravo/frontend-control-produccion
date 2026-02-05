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
    <div class="offcanvas offcanvas-end shadow border-0 maxwidth-300" tabindex="-1" id="view-notification" data-bs-scroll="true" data-bs-backdrop="false">
        <div class="offcanvas-header border-bottom">
            <div class="flex-grow-1">
                <h6 class="mb-0">Notifications</h6>
                <p class="text-secondary">6 new updates</p>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="small text-center px-3 py-2 bg-theme-1-subtle text-theme-1 border-bottom">
            <div class="input-group">
                <input type="text" class="form-control daterangepickers">
                <span class="input-group-text text-secondary">
                    <i class="bi bi-calendar-week"></i>
                </span>
            </div>
        </div>
        <div class="offcanvas-body">
            <div class="card bg-none mb-2">
                <div class="card-body">
                    <div class="row gx-3">
                        <div class="col-auto">
                            <figure class="avatar avatar-30 coverimg rounded-circle">
                                <img src="assets/img/modern-ai-image/user-2.jpg" alt="">
                            </figure>
                        </div>
                        <div class="col">
                            <p class="small mb-2"><a href="adminux-profile-professional.html" class="text-theme-1 style-none">Alex Smith</a>, <a href="adminux-profile-professional.html" class="text-theme-1 style-none">John McMillan</a> and <span class="fw-medium">36 others</span> are also ordered from same website</p>

                            <div class="row gx-3 align-items-center">
                                <div class="col">
                                    <p class="text-secondary small">2:14 pm</p>
                                </div>
                                <div class="col-auto">
                                    <a href="javascript:void(0)" class="btn btn-sm btn-square btn-link theme-red"><i class="bi bi-trash"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card bg-none mb-2">
                <div class="card-body">
                    <div class="row gx-3">
                        <div class="col-auto">
                            <figure class="avatar avatar-30 rounded-circle bg-theme-1 border border-theme-1">
                                <p class="h6 fw-medium">JM</p>
                            </figure>
                        </div>
                        <div class="col">
                            <p class="small mb-2"><a href="adminux-profile-professional.html" class="text-theme-1 style-none">Jack Mario</a> commented: "This one is most usable design with great user experience. w..."</p>

                            <div class="row gx-3 align-items-center">
                                <div class="col">
                                    <p class="text-secondary small">2 days ago</p>
                                </div>
                                <div class="col-auto">
                                    <a href="javascript:void(0)" class="btn btn-sm btn-square btn-link theme-red"><i class="bi bi-trash"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="alert alert-warning mb-2">
                <div class="row gx-3">
                    <div class="col-auto">
                        <figure class="avatar avatar-30 rounded-circle bg-warning text-white">
                            <i class="bi bi-bell"></i>
                        </figure>
                    </div>
                    <div class="col">
                        <p class="small mb-2">Your subscription going to expire soon. Please <a href="adminux-subscription.html">upgrade</a> to get service interrupt free.</p>

                        <div class="row gx-3 align-items-center">
                            <div class="col">
                                <p class="text-secondary small">4 days ago</p>
                            </div>
                            <div class="col-auto">
                                <a href="javascript:void(0)" class="btn btn-sm btn-square btn-link theme-red"><i class="bi bi-trash"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card bg-none mb-2">
                <div class="card-body">
                    <div class="row gx-3">
                        <div class="col-auto">
                            <figure class="avatar avatar-30 coverimg rounded-circle">
                                <img src="assets/img/modern-ai-image/user-4.jpg" alt="">
                            </figure>
                        </div>
                        <div class="col">
                            <p class="small mb-2"><a href="https://www.adminuiux.com/adminuiux/adminux/html/adminux-invoice.html" class="text-theme-1 style-none">Roberto Carlos</a> has requested to send $120.00 money.</p>

                            <div class="row gx-3 align-items-center">
                                <div class="col">
                                    <p class="text-secondary small">6 days ago</p>
                                </div>
                                <div class="col-auto">
                                    <a href="javascript:void(0)" class="btn btn-sm btn-square btn-link theme-red"><i class="bi bi-trash"></i></a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card bg-none mb-2">
                <div class="card-body">
                    <div class="row gx-3">
                        <div class="col-auto">
                            <figure class="avatar avatar-30 rounded-circle bg-theme-1-subtle text-theme-1 theme-orange">
                                <i class="bi bi-calendar-event"></i>
                            </figure>
                        </div>
                        <div class="col">
                            <h6 class="mb-1">Adminuiux: #1 HTML Templates</h6>
                            <p class="small mb-2">Learning for better user experience on Universal app. development</p>
                            <div class="avatar-group mb-2">
                                <figure class="avatar avatar-20 coverimg rounded-circle" data-bs-toggle="tooltip" title="Mickey">
                                    <img src="assets/img/modern-ai-image/user-3.jpg" alt="" style="display: none;">
                                </figure>
                                <figure class="avatar avatar-20 coverimg rounded-circle" data-bs-toggle="tooltip" title="Jacky">
                                    <img src="assets/img/modern-ai-image/user-4.jpg" alt="">
                                </figure>
                                <div class="avatar avatar-20 bg-theme-1 rounded-circle">
                                    <small class="fs-10 vm">9+</small>
                                </div>
                                <span class="text-secondary small"> are attending</span>
                            </div>

                            <div class="row gx-3 align-items-center">
                                <div class="col">
                                    <p class="text-secondary small">7 days ago</p>
                                </div>
                                <div class="col-auto">
                                    <a href="javascript:void(0)" class="btn btn-sm btn-square btn-link theme-red"><i class="bi bi-trash"></i></a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card bg-none mb-2">
                <div class="card-body">
                    <div class="row gx-3">
                        <div class="col-auto">
                            <figure class="avatar avatar-30 coverimg rounded-circle">
                                <img src="assets/img/modern-ai-image/user-3.jpg" alt="">
                            </figure>
                        </div>
                        <div class="col">
                            <p class="small mb-2"><a href="https://www.adminuiux.com/adminuiux/adminux/html/adminuiux-profile-professional.html" class="text-theme-1 style-none">The AdminUIUX</a> commented: "Thank you so much for this deep view at Adminuiux..."</p>

                            <div class="row gx-3 align-items-center">
                                <div class="col">
                                    <p class="text-secondary small">1 year ago</p>
                                </div>
                                <div class="col-auto">
                                    <a href="javascript:void(0)" class="btn btn-sm btn-square btn-link theme-red"><i class="bi bi-trash"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- themes -->
    <!-- theming offcanvas-->
    <div class="offcanvas offcanvas-end shadow border-0" tabindex="-1" id="theming" data-bs-scroll="true" data-bs-backdrop="false" aria-labelledby="theminglabel">
        <div class="offcanvas-header border-bottom">
            <div>
                <h5 class="offcanvas-title" id="theminglabel">Personalize</h5>
                <p class="text-secondary small">Make it more like your own</p>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <h6 class="offcanvas-title">Colors</h6>
            <p class="text-secondary small mb-4">Change colors of templates</p>

            <div class="row mb-4 theme-select">
                <div class="col-auto">
                    <div class="select-box text-center mb-2" data-title="">
                        <span class="avatar avatar-40 rounded-circle mb-2 bg-default">
                            <i class="bi bi-arrow-clockwise"></i>
                        </span>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="select-box text-center mb-2" data-title="theme-blue">
                        <span class="avatar avatar-40 rounded-circle mb-2 bg-theme-1 theme-blue"></span>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="select-box text-center mb-2" data-title="theme-indigo">
                        <span class="avatar avatar-40 rounded-circle mb-2 bg-indigo"></span>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="select-box text-center mb-2" data-title="theme-purple">
                        <span class="avatar avatar-40 rounded-circle mb-2 bg-purple"></span>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="select-box text-center mb-2" data-title="theme-pink">
                        <span class="avatar avatar-40 rounded-circle mb-2 bg-pink"></span>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="select-box text-center mb-2" data-title="theme-red">
                        <span class="avatar avatar-40 rounded-circle mb-2 bg-red"></span>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="select-box text-center mb-2" data-title="theme-orange">
                        <span class="avatar avatar-40 rounded-circle mb-2 bg-orange"></span>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="select-box text-center mb-2" data-title="theme-yellow">
                        <span class="avatar avatar-40 rounded-circle mb-2 bg-yellow"></span>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="select-box text-center mb-2" data-title="theme-green">
                        <span class="avatar avatar-40 rounded-circle mb-2 bg-green"></span>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="select-box text-center mb-2" data-title="theme-teal">
                        <span class="avatar avatar-40 rounded-circle mb-2 bg-teal"></span>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="select-box text-center mb-2" data-title="theme-cyan">
                        <span class="avatar avatar-40 rounded-circle mb-2 bg-cyan"></span>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="select-box text-center mb-2" data-title="theme-grey">
                        <span class="avatar avatar-40 rounded-circle mb-2 bg-grey"></span>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="select-box text-center mb-2" data-title="theme-brown">
                        <span class="avatar avatar-40 rounded-circle mb-2 bg-brown"></span>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="select-box text-center mb-2" data-title="theme-chocolate">
                        <span class="avatar avatar-40 rounded-circle mb-2 bg-chocolate"></span>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="select-box text-center mb-2" data-title="theme-black">
                        <span class="avatar avatar-40 rounded-circle mb-2 bg-dark"></span>
                    </div>
                </div>
            </div>

            <h6 class="offcanvas-title">Backgrounds</h6>
            <p class="text-secondary small mb-4">Change color for background</p>
            <div class="row mb-4 theme-background">
                <div class="col-auto">
                    <div class="gradient-box text-center mb-2" data-title="bg-default">
                        <span class="avatar avatar-40 rounded-circle mb-2 bg-default"><i class="bi bi-arrow-clockwise"></i></span>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="gradient-box text-center mb-2" data-title="bg-white">
                        <span class="avatar avatar-40 rounded-circle mb-2 bg-white"></span>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="gradient-box text-center mb-2" data-title="bg-r-gradient">
                        <span class="avatar avatar-40 rounded-circle mb-2 bg-r-gradient"></span>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="gradient-box text-center mb-2" data-title="bg-gradient-1">
                        <span class="avatar avatar-40 rounded-circle mb-2 bg-gradient-1"></span>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="gradient-box text-center mb-2" data-title="bg-gradient-2">
                        <span class="avatar avatar-40 rounded-circle mb-2 bg-gradient-2"></span>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="gradient-box text-center mb-2" data-title="bg-gradient-3">
                        <span class="avatar avatar-40 rounded-circle mb-2 bg-gradient-3"></span>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="gradient-box text-center mb-2" data-title="bg-gradient-4">
                        <span class="avatar avatar-40 rounded-circle mb-2 bg-gradient-4"></span>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="gradient-box text-center mb-2" data-title="bg-gradient-5">
                        <span class="avatar avatar-40 rounded-circle mb-2 bg-gradient-5"></span>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="gradient-box text-center mb-2" data-title="bg-gradient-6">
                        <span class="avatar avatar-40 rounded-circle mb-2 bg-gradient-6"></span>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="gradient-box text-center mb-2" data-title="bg-gradient-7">
                        <span class="avatar avatar-40 rounded-circle mb-2 bg-gradient-7"></span>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="gradient-box text-center mb-2" data-title="bg-gradient-8">
                        <span class="avatar avatar-40 rounded-circle mb-2 bg-gradient-8"></span>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="gradient-box text-center mb-2" data-title="bg-gradient-9">
                        <span class="avatar avatar-40 rounded-circle mb-2 bg-gradient-9"></span>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="gradient-box text-center mb-2" data-title="bg-gradient-10">
                        <span class="avatar avatar-40 rounded-circle mb-2 bg-gradient-10"></span>
                    </div>
                </div>
            </div>

            <h6 class="offcanvas-title">Sidebar Layout</h6>
            <p class="text-secondary small mb-4">Change sidebar layout style</p>

            <div class="row mb-4 sidebar-layout">
                <div class="col-auto">
                    <div class="select-box text-center mb-2" data-title="adminuiux-sidebar-standard" data-bs-toggle="tooltip" title="None">
                        <span class="avatar avatar-40 rounded-circle mb-2 bg-default">
                            <i class="bi bi-arrow-clockwise"></i>
                        </span>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="select-box text-center mb-2" data-title="adminuiux-sidebar-iconic" data-bs-toggle="tooltip" title="Iconic">
                        <span class="avatar avatar-40 rounded-circle mb-2 bg-default">
                            <i class="bi bi-bezier h4"></i>
                        </span>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="select-box text-center mb-2" data-title="adminuiux-sidebar-boxed" data-bs-toggle="tooltip" title="Boxed">
                        <span class="avatar avatar-40 rounded-circle mb-2 bg-default">
                            <i class="bi bi-box h5"></i>
                        </span>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="select-box text-center mb-2" data-title="adminuiux-sidebar-boxed adminuiux-sidebar-iconic" data-bs-toggle="tooltip" title="Iconic+Boxed">
                        <span class="avatar avatar-40 rounded-circle mb-2 bg-default">
                            <i class="bi bi-bounding-box h5"></i>
                        </span>
                    </div>
                </div>

            </div>

            <div class="text-center mb-4">
                <a href="adminux-personalization.html" class="btn btn-sm btn-outline-theme">More options <i class="bi bi-arrow-right-short"></i></a>
            </div>
        </div>
    </div>

    <!-- standard footer -->
    <footer class="adminuiux-footer has-adminuiux-sidebar mt-auto bg-theme-1">
        <?= $this->include('layouts/footer') ?>
    </footer>

    <!-- theming action-->
    <div class="position-fixed bottom-0 end-0 m-3 z-index-5">
        <button class="btn btn-square btn-theme shadow rounded-circle" type="button" data-bs-toggle="offcanvas" data-bs-target="#theming" aria-controls="theming"><i class="bi bi-palette"></i></button>
        <br>
        <button class="btn btn-theme btn-square shadow mt-2 d-none rounded-circle" id="backtotop"><i class="bi bi-arrow-up"></i></button>
    </div>

    <!-- Page Level js -->
    <script src="assets/js/adminux/adminux-dashboard.js"></script>

    <?= $this->renderSection('scripts') ?>
    
</body>


<!-- Mirrored from adminuiux.com/adminuiux/adminux/html/adminux-dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 11 Jan 2026 07:05:48 GMT -->

</html>