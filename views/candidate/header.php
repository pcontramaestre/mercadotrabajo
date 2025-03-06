<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MercadoTrabajo - My Profile</title>
    <link href="<?php echo SYSTEM_BASE_DIR; ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo SYSTEM_BASE_DIR; ?>assets/css/style.css">
    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Tailwind CSS desde CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

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
                        }
                    }
                }
            }
        }
    </script>

    <style>
        /* Estilos adicionales */
        .custom-select {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
        }

        .education-item {
            transition: all 0.3s ease;
        }

        .education-item:hover {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .modal {
            transition: opacity 0.3s ease;
        }

        .form-select {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        .theme-btn {
            transition: all 0.3s ease;
        }

        .btn-style-one {
            background-color: #1967d2;
            color: white;
            border-radius: 0.375rem;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
        }

        .btn-style-one:hover {
            background-color: #1558b6;
        }

        .btn-style-three {
            background-color: #e9f0fd;
            color: #1967d2;
            border-radius: 0.375rem;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
        }

        .btn-style-three:hover {
            background-color: #d3e2fb;
        }

        .widget-title {
            position: relative;
            margin-bottom: 20px;
        }

        .widget-title:after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -10px;
            height: 2px;
            width: 40px;
            background-color: #1967d2;
        }

        .uploading-outer {
            position: relative;
            margin-bottom: 30px;
        }

        .uploadButton {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .uploadButton-input {
            display: none;
        }

        .uploadButton-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #e9f0fd;
            color: #1967d2;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .uploadButton-button:hover {
            background-color: #d3e2fb;
        }

        .uploadButton-file-name {
            margin-left: 10px;
            color: #6b7280;
        }

        .tag-container {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            padding: 4px;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            min-height: 42px;
        }

        .tag {
            display: flex;
            align-items: center;
            background-color: #e9f0fd;
            color: #1967d2;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 0.875rem;
        }

        .tag-remove {
            margin-left: 4px;
            cursor: pointer;
        }

        .tag-input {
            flex: 1;
            border: none;
            outline: none;
            padding: 4px;
            min-width: 60px;
        }

        .image-upload-area {
            border: 2px dashed #d1d5db;
            transition: all 0.3s ease;
        }

        .image-upload-area:hover {
            border-color: #2563eb;
        }

        /* Toast notification */
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 16px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            z-index: 9999;
            transform: translateY(-100px);
            opacity: 0;
            transition: all 0.3s ease;
        }

        .toast.show {
            transform: translateY(0);
            opacity: 1;
        }

        .toast-success {
            background-color: #34a853;
            color: white;
        }

        .toast-error {
            background-color: #ea4335;
            color: white;
        }
        /* Estilos adicionales */
        .sidebar {
        transition: transform 0.3s ease;
        }
        
        .sidebar.hidden {
        transform: translateX(-100%);
        }
        
        @media (min-width: 768px) {
        .sidebar.hidden {
            transform: translateX(0);
        }
        }
        
        .progress-ring-circle {
        transition: stroke-dashoffset 0.35s;
        transform: rotate(-90deg);
        transform-origin: 50% 50%;
        }
        
        /* Estilos para el scrollbar */
        ::-webkit-scrollbar {
        width: 6px;
        }
        
        ::-webkit-scrollbar-track {
        background: #f1f1f1;
        }
        
        ::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 3px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
        background: #a1a1a1;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 <?php echo $bodyClassName ?? ''; ?>" data-spy="scroll" data-offset="80">
    <!-- Toast notification -->
    <div id="toast" class="toast">
        <div class="flex items-center">
            <i data-lucide="check-circle" class="w-5 h-5 mr-2"></i>
            <span id="toast-message">Success message here</span>
        </div>
    </div>
    <div class="min-h-screen flex flex-col">
    <button id="mobile-menu-toggle" class="md:hidden text-gray-500 hover:text-gray-900">
                            <i data-lucide="menu" class="w-6 h-6"></i>
                        </button>
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
                        <button class="menu-btn text-white">
                            <span class="count">1</span>
                            <i data-lucide="mail" class="w-6 h-6"></i>
                        </button>
                        <button class="menu-btn text-white">
                            <i data-lucide="bell" class="w-6 h-6"></i>
                        </button>
                        <div class="dropdown dashboard-option">
                            <a class="dropdown-toggle" role="button" data-bs-toggle="dropdown"
                                aria-expanded="true">
                                <img alt="avatar" loading="lazy" width="50" height="50" decoding="async" data-nimg="1"
                                    class=""
                                    src="<?php echo $dataUserProfile[0]['logo_path'] ?>"
                                    style="color: transparent;">
                                <span class="name text-white">My Account</span>
                                <i data-lucide="chevron-down" class="w-5 h-5"></i>
                            </a>
                            
                            <ul
                                x-data="{ currentPath: window.location.pathname }"
                                class="dropdown-menu"
                                data-popper-placement="bottom-start"
                                style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(-71px, 52px);">
                                <li>
                                    <a href="<?php echo SYSTEM_BASE_DIR ?>dashboard/candidate/dashboard" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-blue-600 bg-blue-50 rounded-md">
                                        <i data-lucide="home" class="w-5 h-5"></i>
                                        Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo SYSTEM_BASE_DIR ?>dashboard/candidate/myprofile"
                                        x-bind:class="{ 'bg-blue-50': currentPath === '/dashboard/candidate/myprofile' }"
                                        class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-md">
                                        <i data-lucide="user" class="w-5 h-5"></i>
                                        My Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo SYSTEM_BASE_DIR ?>dashboard/candidate/myresume" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-md">
                                        <i data-lucide="file-text" class="w-5 h-5"></i>
                                        My Resume
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-md">
                                        <i data-lucide="file-text" class="w-5 h-5"></i>
                                        CV Manager
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-md">
                                        <i data-lucide="briefcase" class="w-5 h-5"></i>
                                        Applied Jobs
                                    </a>
                                </li>

                                <li>
                                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-md">
                                        <i data-lucide="bookmark" class="w-5 h-5"></i>
                                        Shortlisted Jobs
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-md">
                                        <i data-lucide="lock" class="w-5 h-5"></i>
                                        Change Password
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-md">
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
            <aside id="sidebar" class="sidebar w-64 bg-white h-screen md:h-auto border-r z-30 overflow-y-auto fixed">
                <div class="flex flex-col h-full">
                    <div class="flex-1 py-4">
                        <ul class="px-4 space-y-1">
                            <li>
                                <a href="<?php echo SYSTEM_BASE_DIR ?>dashboard/candidate/dashboard" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-blue-600 bg-blue-50 rounded-md">
                                    <i data-lucide="home" class="w-5 h-5"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo SYSTEM_BASE_DIR ?>dashboard/candidate/myprofile" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-md">
                                    <i data-lucide="user" class="w-5 h-5"></i>
                                    My Profile
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo SYSTEM_BASE_DIR ?>dashboard/candidate/myresume" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-md">
                                    <i data-lucide="file-text" class="w-5 h-5"></i>
                                    My Resume
                                </a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-md">
                                    <i data-lucide="briefcase" class="w-5 h-5"></i>
                                    Applied Jobs
                                </a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-md">
                                    <i data-lucide="bookmark" class="w-5 h-5"></i>
                                    Shortlisted Jobs
                                </a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-md">
                                    <i data-lucide="file-text" class="w-5 h-5"></i>
                                    CV Manager
                                </a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-md">
                                    <i data-lucide="lock" class="w-5 h-5"></i>
                                    Change Password
                                </a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-md">
                                    <i data-lucide="log-out" class="w-5 h-5"></i>
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </aside>
                