<style>
  .dashboard-option .dropdown-toggle::after {
    content: unset;
  }
</style>

<header class="main-header header-style-two alternate  ">
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
      <!-- <div class="outer-box">
        <div class="d-flex align-items-center btn-box2">
          <a href="#" class="theme-btn btn-style-six call-modal" data-bs-toggle="modal" data-bs-target="#loginPopupModal" data-translate-es="Login / Registrarse" data-translate-en="Login / Register">Login / Register</a>
        </div>
      </div> -->
      <div class="outer-box text-white">
        <button class="menu-btn text-white">
          <span class="count">1</span>
          <i data-lucide="mail" class="w-6 h-6"></i>
        </button>
        <button class="menu-btn text-white">
          <i data-lucide="bell" class="w-6 h-6"></i>
        </button>
        <div class="dropdown dashboard-option">
          <a class="dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="true">
            <img alt="avatar" loading="lazy" width="50" height="50" decoding="async" data-nimg="1" class=""
              src="<?php echo SYSTEM_BASE_DIR ?>uploads/candidates/candidate-1.webp" style="color: transparent;">
            <span class="name text-white">My Account</span>
            <i data-lucide="chevron-down" class="w-5 h-5"></i>
          </a>
          <ul x-data="{ currentPath: window.location.pathname }" class="dropdown-menu"
            data-popper-placement="bottom-start"
            style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(-71px, 52px);">

            <li>
              <a href="<?php echo SYSTEM_BASE_DIR ?>dashboard/candidate/dashboard"
                class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-blue-600 bg-blue-50 rounded-md">
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
              <a href="<?php echo SYSTEM_BASE_DIR ?>dashboard/candidate/myresume"
                class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-md">
                <i data-lucide="file-text" class="w-5 h-5"></i>
                My Resume
              </a>
            </li>
            <li>
              <a href="<?php echo SYSTEM_BASE_DIR ?>dashboard/candidate/mycvmanager"
                class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-md">
                <i data-lucide="file-text" class="w-5 h-5"></i>
                CV Manager
              </a>
            </li>
            <li>
              <a href="<?php echo SYSTEM_BASE_DIR ?>dashboard/candidate/appliedjobs"
                class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-md">
                <i data-lucide="briefcase" class="w-5 h-5"></i>
                Applied Jobs
              </a>
            </li>

            <li>
              <a href="<?php echo SYSTEM_BASE_DIR ?>dashboard/candidate/shorlistedjobs"
                class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-md">
                <i data-lucide="bookmark" class="w-5 h-5"></i>
                Shortlisted Jobs
              </a>
            </li>

            <li>
              <a href="#"
                class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-md">
                <i data-lucide="lock" class="w-5 h-5"></i>
                Change Password
              </a>
            </li>
            <li>
              <a href="#"
                class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-md">
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



<header class="main-header main-header-mobile bg-bluemenu-100">
  <div class="auto-container">
    <div class="inner-box">
      <div class="nav-outer">
        <div class="logo-box">
          <div class="logo"><a href="<?php echo SYSTEM_BASE_DIR ?>">
            <img alt="brand" class="cover"
            style="color:transparent" src="<?php echo SYSTEM_BASE_DIR ?>assets/img/logo2.png">
              </a>
          </div>
        </div>
        <div class="offcanvas offcanvas-start mobile_menu-contnet" tabindex="-1" id="offcanvasMenu"
          data-bs-scroll="true">
          <div class="pro-header bg-bluemenu-100">
            <a href="<?php echo SYSTEM_BASE_DIR ?>">
              <img alt="brand" class="cover w-24 h-auto" src="<?php echo SYSTEM_BASE_DIR ?>assets/img/logo2.png">
            </a>
            <div class="fix-icon text-white" data-bs-dismiss="offcanvas" aria-label="Close">
                <i data-lucide="x"></i>
            </div>
          </div>
          <aside class="ps-sidebar-root">
            <div class="ps-sidebar-container p-4">
              <nav class="ps-menu-root">
                <ul class="navigation flex flex-col gap-2" id="navbar">
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

                  <div class="flex gap-2">
                    <li class="language-item">
                      <span data-translate="es">
                        <img src="<?php echo SYSTEM_BASE_DIR ?>assets/img/flag/espanol.png" alt="es" width="30"
                          height="20">
                      </span>
                    </li>
                    <li class="language-item">
                      <span data-translate="en">
                        <img src="<?php echo SYSTEM_BASE_DIR ?>assets/img/flag/usa.png" alt="es" width="30" height="20">
                      </span>
                    </li>
                  </div>

                  
                </ul>
              </nav>
            </div>
          </aside>
          <div class="mm-add-listing mm-listitem pro-footer">
            <div class="social-links px-2">
                <a href="https://www.facebook.com/" target="_blank" rel="noopener noreferrer"><i
                    class="fab fa-facebook-f"></i></a>
                <a href="https://www.twitter.com/" target="_blank" rel="noopener noreferrer"><i
                    class="fab fa-twitter"></i></a>
                <a href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer"><i
                    class="fab fa-instagram"></i></a>
                <a href="https://www.linkedin.com/" target="_blank" rel="noopener noreferrer"><i
                    class="fab fa-linkedin-in"></i></a>
            </div>
          </div>
        </div>
      </div>
      <div class="outer-box">
        <div class="login-box">
          <a href="#" class="call-modal" data-bs-toggle="modal"
            data-bs-target="#loginPopupModal"><span class="icon icon-user"></span>
          </a>
        </div>
        <a href="#" class="mobile-nav-toggler" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu">
          <i class="fa fa-bars text-white"></i>
        </a>
      </div>
    </div>
  </div>
</header>