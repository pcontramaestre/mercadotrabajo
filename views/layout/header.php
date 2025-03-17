<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $pageTitle ?? 'Mercado Trabajo'; ?></title>
  <link href="<?php echo SYSTEM_BASE_DIR; ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo SYSTEM_BASE_DIR; ?>assets/css/style.css">
  <link rel="stylesheet" href="<?php echo SYSTEM_BASE_DIR; ?>assets/css/dashboard.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,200..800&family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <!-- fontawesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- Tailwind -->
   <!-- Tailwind CSS desde CDN -->
   <script src="https://cdn.tailwindcss.com"></script>
  <!-- <link
    href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css"
    rel="stylesheet" /> -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  <!-- main.js -->
  <script src="<?php echo SYSTEM_BASE_DIR; ?>assets/js/main.js"></script>
  <!-- Alpine Plugins -->
  <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>
  <!-- https://alpinejs.dev/plugins/persist -->
  <!-- Alpine Plugins -->
  <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/anchor@3.x.x/dist/cdn.min.js"></script>

  <!-- Alpine Core -->
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

  <!-- Lucide Icons -->
  <!-- <script src="https://unpkg.com/lucide@latest"></script> -->
  <script src="<?php echo SYSTEM_BASE_DIR; ?>assets/js/lucide.min.js"></script>
</head>
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
<style>
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
</style>

<body class="<?php echo $bodyClassName ?? ''; ?>" data-spy="scroll" data-offset="80">
  <!-- Toast notification -->
  <div id="toast" class="toast">
        <div class="flex items-center">
            <i data-lucide="check-circle" class="w-5 h-5 mr-2"></i>
            <span id="toast-message">Success message here</span>
        </div>
    </div>