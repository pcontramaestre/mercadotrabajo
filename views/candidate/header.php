<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MercadoTrabajo - My Profile</title>
    <link href="<?php echo SYSTEM_BASE_DIR; ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo SYSTEM_BASE_DIR; ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo SYSTEM_BASE_DIR; ?>assets/css/dashboard.css">
    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Tailwind CSS desde CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Lucide Icons -->
    <!-- <script src="https://unpkg.com/lucide@latest"></script> -->
    <script src="<?php echo SYSTEM_BASE_DIR; ?>assets/js/lucide.min.js"></script>

    <!-- Select 2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Chart.js para el gráfico -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- main.js -->
    <script src="<?php echo SYSTEM_BASE_DIR; ?>assets/js/main.js"></script>
    <!-- Alpine Plugins -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>
    <!-- https://alpinejs.dev/plugins/persist -->
    <!-- Alpine Plugins -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/anchor@3.x.x/dist/cdn.min.js"></script>

    <!-- Alpine Core -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: "#1967D2",
                            50: "#E9F0FD",
                            100: "#D3E2FB",
                            600: "#1967D2",
                        },
                        secondary: {
                            DEFAULT: "#0A65C2",
                            50: "#E6F0F9",
                            100: "#CCE0F4",
                        },
                        success: {
                            DEFAULT: "#34A853",
                            50: "#E6F4EA",
                            100: "#CEEAD6",
                        },
                        danger: {
                            DEFAULT: "#EA4335",
                            50: "#FCEBE9",
                            100: "#F8D7D5",
                        },
                        warning: {
                            DEFAULT: "#FBBC05",
                            50: "#FEF7E0",
                            100: "#FDEFCD",
                        },
                        blue: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            600: '#2563eb'
                        },
                        red: {
                            50: '#fef2f2',
                            100: '#fee2e2',
                            600: '#dc2626'
                        },
                        yellow: {
                            50: '#fefce8',
                            100: '#fef9c3',
                            600: '#ca8a04'
                        },
                        green: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            600: '#16a34a'
                        },
                        indigo: {
                            500: '#6366f1'
                        },
                        gray: {
                            50: '#f9fafb',
                            100: '#f3f4f6',
                            200: '#e5e7eb',
                            300: '#d1d5db',
                            400: '#9ca3af',
                            500: '#6b7280',
                            600: '#4b5563',
                            700: '#374151',
                            800: '#1f2937',
                            900: '#111827'
                        },
                        blue2: {
                            100: '#e3ebfa',
                        },
                        bluemenu: {
                            100: '#143a90',
                        }
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-50 text-gray-800 <?php echo $bodyClassName ?? ''; ?>" data-spy="scroll" data-offset="80">
    <!-- Toast notification -->
    <div id="toast" class="toast">
        <div class="flex items-center">
            <i data-lucide="check-circle" class="w-5 h-5 mr-2"></i>
            <span id="toast-message">Success message here</span>
        </div>
    </div>
    <div class="min-h-screen flex flex-col bg-gray-50 text-gray-800 ">
        <div class="md:hidden bg-bluemenu-100 flex justify-between">
            <div class="logo-box">
                <div class="logo pl-2 pt-2 pb-1">
                    <a href="<?php echo SYSTEM_BASE_DIR ?>">
                        <img alt="brand" class="cover w-24"
                            style="color:transparent" src="<?php echo SYSTEM_BASE_DIR ?>assets/img/logo2.png">
                    </a>
                </div>
            </div>
            <button id="mobile-menu-toggle" class="text-gray-500 hover:text-gray-900 pt-2 pl-4 text-white pr-4">
                <i data-lucide="menu" class="w-8 h-8"></i>
            </button>
        </div>
        <header class="main-header header-style-two alternate bg-blue-800 shadow-sm">
            <div class="auto-container">
                <div class="main-box">
                    <div class="nav-outer">
                        <div class="logo-box">
                            <div class="logo">
                                <a href="<?php echo SYSTEM_BASE_DIR ?>">
                                    <img alt="brand" loading="lazy" width="154" height="50" decoding="async" data-nimg="1"
                                        style="color:transparent" src="<?php echo SYSTEM_BASE_DIR ?>assets/img/logo2.png">
                                </a>
                            </div>
                        </div>
                        <nav class="nav main-menu">
                            <ul class="navigation" id="navbar">
                                <li class="current">
                                    <a href="<?php echo SYSTEM_BASE_DIR ?>">
                                        <span data-translate-es="Buscar trabajos" data-translate-en="Find Jobs">Find Jobs</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo SYSTEM_BASE_DIR ?>companies">
                                        <span data-translate-es="Empresas" data-translate-en="Employers">Employers</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo SYSTEM_BASE_DIR ?>blog">
                                        <span data-translate-es="Blog" data-translate-en="Blog">Blog</span>
                                    </a>
                                </li>

                                <li class="language-item">
                                    <span data-translate="es">
                                        <img src="<?php echo SYSTEM_BASE_DIR ?>assets/img/flag/espanol.png" alt="es" width="30" height="20">
                                    </span>
                                </li>
                                <li class="language-item">
                                    <span data-translate="en">
                                        <img src="<?php echo SYSTEM_BASE_DIR ?>assets/img/flag/usa.png" alt="es" width="30" height="20">
                                    </span>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="outer-box text-white">

                        <div class="dropdown dashboard-option">
                            <a class="dropdown-toggle" role="button" data-bs-toggle="dropdown"
                                aria-expanded="true">
                                <img alt="avatar" 
                                    class="rounded-full h-12 w-12 object-cover"
                                    src="<?php echo $_SESSION['avatar'] ?>"
                                    style="color: transparent;">
                                <span class="name text-white" data-translate-es="Mi Cuenta" data-translate-en="My Account">My Account</span>
                                <i data-lucide="chevron-down" class="w-5 h-5"></i>
                            </a>

                            <ul
                                x-data="{ currentPath: window.location.pathname }"
                                class="dropdown-menu"
                                data-popper-placement="bottom-start"
                                style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(-71px, 52px);">
                                <li>
                                    <a href="<?php echo SYSTEM_BASE_DIR ?>dashboard/candidate/dashboard" 
                                        x-bind:class="{ 'bg-blue-50 text-blue-600': currentPath === '/dashboard/candidate/dashboard' }"
                                        class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-md">
                                        <i data-lucide="home" class="w-5 h-5"></i>
                                        Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo SYSTEM_BASE_DIR ?>dashboard/candidate/myprofile"
                                        x-bind:class="{ 'bg-blue-50 text-blue-600': currentPath === '/dashboard/candidate/myprofile' }"
                                        class="flex items-center gap-3 px-4 py-3 text-sm font-medium hover:bg-gray-50 rounded-md">
                                        <i data-lucide="user" class="w-5 h-5"></i>
                                        My Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo SYSTEM_BASE_DIR ?>dashboard/candidate/myresume" 
                                        x-bind:class="{ 'bg-blue-50 text-blue-600': currentPath === '/dashboard/candidate/myresume' }"
                                        class="flex items-center gap-3 px-4 py-3 text-sm font-medium hover:bg-gray-50 rounded-md">
                                        <i data-lucide="file-text" class="w-5 h-5"></i>
                                        My Resume
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo SYSTEM_BASE_DIR ?>dashboard/candidate/mycvmanager" 
                                        x-bind:class="{ 'bg-blue-50 text-blue-600': currentPath === '/dashboard/candidate/mycvmanager' }"
                                        class="flex items-center gap-3 px-4 py-3 text-sm font-medium hover:bg-gray-50 rounded-md">
                                        <i data-lucide="file-text" class="w-5 h-5"></i>
                                        CV Manager
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo SYSTEM_BASE_DIR ?>dashboard/candidate/appliedjobs" 
                                        x-bind:class="{ 'bg-blue-50 text-blue-600': currentPath === '/dashboard/candidate/appliedjobs' }"
                                        class="flex items-center gap-3 px-4 py-3 text-sm font-medium hover:bg-gray-50 rounded-md">
                                        <i data-lucide="briefcase" class="w-5 h-5"></i>
                                        Applied Jobs
                                    </a>
                                </li>

                                <li>
                                    <a href="<?php echo SYSTEM_BASE_DIR ?>dashboard/candidate/shorlistedjobs" 
                                        x-bind:class="{ 'bg-blue-50 text-blue-600': currentPath === '/dashboard/candidate/shorlistedjobs' }"
                                        class="flex items-center gap-3 px-4 py-3 text-sm font-medium hover:bg-gray-50 rounded-md">
                                        <i data-lucide="bookmark" class="w-5 h-5"></i>
                                        Shortlisted Jobs
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo SYSTEM_BASE_DIR ?>changePassword" 
                                        x-bind:class="{ 'bg-blue-50 text-blue-600': currentPath === '/changePassword' }"
                                        class="flex items-center gap-3 px-4 py-3 text-sm font-medium hover:bg-gray-50 rounded-md">
                                        <i data-lucide="lock" class="w-5 h-5"></i>
                                        Change Password
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo SYSTEM_BASE_DIR ?>logout" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-md">
                                        <i data-lucide="log-out" class="w-5 h-5"></i>
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="flex flex-1 lg:pt-32">
            <!-- Sidebar -->
            <aside id="sidebar" class="sidebar w-64 bg-white h-screen md:h-auto border-r z-30 overflow-y-auto fixed w-full md:w-auto">
                <div class="flex flex-col h-full">
                    <div class="flex-1 py-4">
                        <ul class="px-4 space-y-1" x-data="{ currentPath: window.location.pathname }">
                            <li>
                                <a href="<?php echo SYSTEM_BASE_DIR ?>dashboard/candidate/dashboard" 
                                    x-bind:class="{ 'bg-blue-50 text-blue-600': currentPath === '/dashboard/candidate/dashboard' }"
                                    class="flex items-center gap-3 px-4 py-3 text-sm font-medium hover:bg-gray-50 rounded-md">
                                    <i data-lucide="home" class="w-5 h-5"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo SYSTEM_BASE_DIR ?>dashboard/candidate/myprofile" 
                                    x-bind:class="{ 'bg-blue-50 text-blue-600': currentPath === '/dashboard/candidate/myprofile' }"
                                    class="flex items-center gap-3 px-4 py-3 text-sm font-medium hover:bg-gray-50 rounded-md">
                                    <i data-lucide="user" class="w-5 h-5"></i>
                                    Mi perfil
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo SYSTEM_BASE_DIR ?>dashboard/candidate/myresume" 
                                    x-bind:class="{ 'bg-blue-50 text-blue-600': currentPath === '/dashboard/candidate/myresume' }"
                                    class="flex items-center gap-3 px-4 py-3 text-sm font-medium hover:bg-gray-50 rounded-md">
                                    <i data-lucide="file-text" class="w-5 h-5"></i>
                                    Mi currículum
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo SYSTEM_BASE_DIR ?>dashboard/candidate/mycvmanager" 
                                    x-bind:class="{ 'bg-blue-50 text-blue-600': currentPath === '/dashboard/candidate/mycvmanager' }"
                                    class="flex items-center gap-3 px-4 py-3 text-sm font-medium hover:bg-gray-50 rounded-md">
                                    <i data-lucide="file-text" class="w-5 h-5"></i>
                                    Mis hojas de vida
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo SYSTEM_BASE_DIR ?>dashboard/candidate/appliedjobs" 
                                    x-bind:class="{ 'bg-blue-50 text-blue-600': currentPath === '/dashboard/candidate/appliedjobs' }"
                                    class="flex items-center gap-3 px-4 py-3 text-sm font-medium hover:bg-gray-50 rounded-md">
                                    <i data-lucide="briefcase" class="w-5 h-5"></i>
                                    Trabajos aplicados
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo SYSTEM_BASE_DIR ?>dashboard/candidate/shorlistedjobs" 
                                    x-bind:class="{ 'bg-blue-50 text-blue-600': currentPath === '/dashboard/candidate/shorlistedjobs' }"
                                    class="flex items-center gap-3 px-4 py-3 text-sm font-medium hover:bg-gray-50 rounded-md">
                                    <i data-lucide="bookmark" class="w-5 h-5"></i>
                                    Favoritos
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo SYSTEM_BASE_DIR ?>changePassword" 
                                    x-bind:class="{ 'bg-blue-50 text-blue-600': currentPath === '/changePassword' }"
                                    class="flex items-center gap-3 px-4 py-3 text-sm font-medium hover:bg-gray-50 rounded-md">
                                    <i data-lucide="lock" class="w-5 h-5"></i>
                                    Cambiar contraseña
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo SYSTEM_BASE_DIR ?>logout" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-md">
                                    <i data-lucide="log-out" class="w-5 h-5"></i>
                                    Cerrar sesión
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </aside>
        </div>