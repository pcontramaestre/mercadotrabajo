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
            <!-- <li>
              <a href="<?php //echo SYSTEM_BASE_DIR 
              ?>post-jobs">
                <span data-translate-es=" Publicar una vacante" data-translate-en="Post a Job">Post a Job</span>
              </a>
            </li> -->
            <!-- <li class=" dropdown">
              <span data-translate-es="Candidatos" data-translate-en="Candidates">Candidates</span>
              <ul>
                <li>
                  <a href="<?php echo SYSTEM_BASE_DIR ?>dashboard/candidate/myprofile">
                    <span data-translate-es="Mi perfil" data-translate-en="My profile">My profile</span>
                  </a>
                </li>
                <li>
                  <a href="<?php echo SYSTEM_BASE_DIR ?>dashboard/candidate/myresume">
                    <span data-translate-es="Curriculum" data-translate-en="My resume">My resume</span>
                  </a>
                </li>
              </ul>
            </li> -->
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
          <a class="dropdown-toggle" role="button" data-bs-toggle="dropdown"
            aria-expanded="true">
            <img alt="avatar" loading="lazy" width="50" height="50" decoding="async" data-nimg="1"
              class=""
              src="<?php echo SYSTEM_BASE_DIR ?>uploads/candidates/candidate-1.webp"
              style="color: transparent;">
            <span class="name text-white">My Account</span>
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
              <!-- <li>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-md">
                  <i data-lucide="bell" class="w-5 h-5"></i>
                  Job Alerts
                </a>
              </li> -->
              <li>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-md">
                  <i data-lucide="bookmark" class="w-5 h-5"></i>
                  Shortlisted Jobs
                </a>
              </li>
<!--               
              <li>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-md">
                  <i data-lucide="package" class="w-5 h-5"></i>
                  Packages
                </a>
              </li>
              <li>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-md">
                  <i data-lucide="message-square" class="w-5 h-5"></i>
                  Messages
                </a>
              </li> -->
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
              <!-- <li>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-red-500 hover:bg-gray-50 rounded-md">
                  <i data-lucide="trash-2" class="w-5 h-5"></i>
                  Delete Profile
                </a>
              </li> -->

          </ul>
        </div>
      </div>
    </div>
  </div>
</header>



<header class="main-header main-header-mobile">
  <div class="auto-container">
    <div class="inner-box">
      <div class="nav-outer">
        <div class="logo-box">
          <div class="logo"><a href="/"><img alt="brand" loading="lazy" width="154" height="50" decoding="async"
                data-nimg="1" style="color:transparent" src="/images/logo.svg"></a></div>
        </div>
        <div class="offcanvas offcanvas-start mobile_menu-contnet" tabindex="-1" id="offcanvasMenu"
          data-bs-scroll="true">
          <div class="pro-header"><a href="/"><img alt="brand" loading="lazy" width="154" height="50" decoding="async"
                data-nimg="1" style="color:transparent" src="/images/logo.svg"></a>
            <div class="fix-icon" data-bs-dismiss="offcanvas" aria-label="Close"><span class="flaticon-close"></span>
            </div>
          </div>
          <aside data-testid="ps-sidebar-root-test-id" width="250px" class="ps-sidebar-root css-1wvake5">
            <div data-testid="ps-sidebar-container-test-id" class="ps-sidebar-container css-dip3t8">
              <nav class="ps-menu-root css-vj11vy">
                <ul class="css-ewdv3l">
                  <li class="ps-menuitem-root ps-submenu-root menu-active css-16jesut"><a class="ps-menu-button"
                      data-testid="ps-menu-button-test-id" tabindex="0"><span
                        class="ps-menu-label css-12w9als">Home</span><span
                        class="ps-submenu-expand-icon css-1cuxlhl"><span class="css-honxw6"></span></span></a>
                    <div data-testid="ps-submenu-content-test-id" class="ps-submenu-content css-z5rm24">
                      <ul class="css-ewdv3l">
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Home Page 01</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Home Page 02</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Home Page 03</span></a></li>
                        <li class="ps-menuitem-root menu-active-link css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Home Page 04</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Home Page 05</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Home Page 06</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Home Page 07</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Home Page 08</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Home Page 09</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Home Page 10</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Home Page 11</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Home Page 12</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Home Page 13</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Home Page 14</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Home Page 15</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Home Page 16</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Home Page 17</span></a></li>
                      </ul>
                    </div>
                  </li>
                  <li class="ps-menuitem-root ps-submenu-root css-16jesut"><a class="ps-menu-button"
                      data-testid="ps-menu-button-test-id" tabindex="0"><span class="ps-menu-label css-12w9als">Job
                        Listing</span><span class="ps-submenu-expand-icon css-1cuxlhl"><span
                          class="css-honxw6"></span></span></a>
                    <div data-testid="ps-submenu-content-test-id" class="ps-submenu-content css-z5rm24">
                      <ul class="css-ewdv3l">
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Job List V1</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Job List V2</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Job List V3</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Job List V4</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Job List V5</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Job List V6</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Job List V7</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Job List V8</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Job List V9</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Job List V10</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Job List V11</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Job List V12</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Job List V13</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Job List V14</span></a></li>
                      </ul>
                    </div>
                  </li>
                  <li class="ps-menuitem-root ps-submenu-root css-16jesut"><a class="ps-menu-button"
                      data-testid="ps-menu-button-test-id" tabindex="0"><span class="ps-menu-label css-12w9als">Job
                        Single</span><span class="ps-submenu-expand-icon css-1cuxlhl"><span
                          class="css-honxw6"></span></span></a>
                    <div data-testid="ps-submenu-content-test-id" class="ps-submenu-content css-z5rm24">
                      <ul class="css-ewdv3l">
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Job Single V1</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Job Single V2</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Job Single V3</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Job Single V4</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Job Single V5</span></a></li>
                      </ul>
                    </div>
                  </li>
                  <li class="ps-menuitem-root ps-submenu-root css-16jesut"><a class="ps-menu-button"
                      data-testid="ps-menu-button-test-id" tabindex="0"><span
                        class="ps-menu-label css-12w9als">Employers List</span><span
                        class="ps-submenu-expand-icon css-1cuxlhl"><span class="css-honxw6"></span></span></a>
                    <div data-testid="ps-submenu-content-test-id" class="ps-submenu-content css-z5rm24">
                      <ul class="css-ewdv3l">
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Employers List V1</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Employers List V2</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Employers List V3</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Employers List V4</span></a></li>
                      </ul>
                    </div>
                  </li>
                  <li class="ps-menuitem-root ps-submenu-root css-16jesut"><a class="ps-menu-button"
                      data-testid="ps-menu-button-test-id" tabindex="0"><span
                        class="ps-menu-label css-12w9als">Employers Single</span><span
                        class="ps-submenu-expand-icon css-1cuxlhl"><span class="css-honxw6"></span></span></a>
                    <div data-testid="ps-submenu-content-test-id" class="ps-submenu-content css-z5rm24">
                      <ul class="css-ewdv3l">
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Employers Single V1</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Employers Single V2</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Employers Single V3</span></a></li>
                      </ul>
                    </div>
                  </li>
                  <li class="ps-menuitem-root ps-submenu-root css-16jesut"><a class="ps-menu-button"
                      data-testid="ps-menu-button-test-id" tabindex="0"><span
                        class="ps-menu-label css-12w9als">Candidates List</span><span
                        class="ps-submenu-expand-icon css-1cuxlhl"><span class="css-honxw6"></span></span></a>
                    <div data-testid="ps-submenu-content-test-id" class="ps-submenu-content css-z5rm24">
                      <ul class="css-ewdv3l">
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Candidates List V1</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Candidates List V2</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Candidates List V3</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Candidates List V4</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Candidates List V5</span></a></li>
                      </ul>
                    </div>
                  </li>
                  <li class="ps-menuitem-root ps-submenu-root css-16jesut"><a class="ps-menu-button"
                      data-testid="ps-menu-button-test-id" tabindex="0"><span
                        class="ps-menu-label css-12w9als">Candidates Single</span><span
                        class="ps-submenu-expand-icon css-1cuxlhl"><span class="css-honxw6"></span></span></a>
                    <div data-testid="ps-submenu-content-test-id" class="ps-submenu-content css-z5rm24">
                      <ul class="css-ewdv3l">
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Candidates Single V1</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Candidates Single V2</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Candidates Single V3</span></a></li>
                      </ul>
                    </div>
                  </li>
                  <li class="ps-menuitem-root ps-submenu-root css-16jesut"><a class="ps-menu-button"
                      data-testid="ps-menu-button-test-id" tabindex="0"><span
                        class="ps-menu-label css-12w9als">Blog</span><span
                        class="ps-submenu-expand-icon css-1cuxlhl"><span class="css-honxw6"></span></span></a>
                    <div data-testid="ps-submenu-content-test-id" class="ps-submenu-content css-z5rm24">
                      <ul class="css-ewdv3l">
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Blog List V1</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Blog List V2</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Blog List V3</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Blog Details</span></a></li>
                      </ul>
                    </div>
                  </li>
                  <li class="ps-menuitem-root ps-submenu-root css-16jesut"><a class="ps-menu-button"
                      data-testid="ps-menu-button-test-id" tabindex="0"><span
                        class="ps-menu-label css-12w9als">Pages</span><span
                        class="ps-submenu-expand-icon css-1cuxlhl"><span class="css-honxw6"></span></span></a>
                    <div data-testid="ps-submenu-content-test-id" class="ps-submenu-content css-z5rm24">
                      <ul class="css-ewdv3l">
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">About</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Pricing</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">FAQ's</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Terms</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Invoice</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Contact</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">404</span></a></li>
                      </ul>
                    </div>
                  </li>
                  <li class="ps-menuitem-root ps-submenu-root css-16jesut"><a class="ps-menu-button"
                      data-testid="ps-menu-button-test-id" tabindex="0"><span
                        class="ps-menu-label css-12w9als">Shop</span><span
                        class="ps-submenu-expand-icon css-1cuxlhl"><span class="css-honxw6"></span></span></a>
                    <div data-testid="ps-submenu-content-test-id" class="ps-submenu-content css-z5rm24">
                      <ul class="css-ewdv3l">
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Shop List</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Shop Single</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span class="ps-menu-label css-12w9als">
                              Cart</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Checkout</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Order Completed</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Login</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Register</span></a></li>
                      </ul>
                    </div>
                  </li>
                  <li class="ps-menuitem-root ps-submenu-root css-16jesut"><a class="ps-menu-button"
                      data-testid="ps-menu-button-test-id" tabindex="0"><span
                        class="ps-menu-label css-12w9als">Dashboard</span><span
                        class="ps-submenu-expand-icon css-1cuxlhl"><span class="css-honxw6"></span></span></a>
                    <div data-testid="ps-submenu-content-test-id" class="ps-submenu-content css-z5rm24">
                      <ul class="css-ewdv3l">
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Employers Dashboard</span></a></li>
                        <li class="ps-menuitem-root css-1tqrhto"><a class="ps-menu-button"
                            data-testid="ps-menu-button-test-id" tabindex="0"><span
                              class="ps-menu-label css-12w9als">Candidates Dashboard</span></a></li>
                      </ul>
                    </div>
                  </li>
                </ul>
              </nav>
            </div>
          </aside>
          <div class="mm-add-listing mm-listitem pro-footer"><a href="#"
              class="theme-btn btn-style-one mm-listitem__text">Job Post</a>
            <div class="mm-listitem__text">
              <div class="contact-info"><span class="phone-num"><span>Call us</span><a href="tel:1234567890">123 456
                    7890</a></span><span class="address">329 Queensberry Street, North Melbourne VIC <br>3051,
                  Australia.</span><a href="mailto:support@superio.com" class="email">support@superio.com</a></div>
              <div class="social-links"><a href="https://www.facebook.com/" target="_blank" rel="noopener noreferrer"><i
                    class="fab fa-facebook-f"></i></a><a href="https://www.twitter.com/" target="_blank"
                  rel="noopener noreferrer"><i class="fab fa-twitter"></i></a><a href="https://www.instagram.com/"
                  target="_blank" rel="noopener noreferrer"><i class="fab fa-instagram"></i></a><a
                  href="https://www.linkedin.com/" target="_blank" rel="noopener noreferrer"><i
                    class="fab fa-linkedin-in"></i></a></div>
            </div>
          </div>
        </div>
      </div>
      <div class="outer-box">
        <div class="login-box"><a href="#" class="call-modal" data-bs-toggle="modal"
            data-bs-target="#loginPopupModal"><span class="icon icon-user"></span></a></div><a href="#"
          class="mobile-nav-toggler" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu"><span
            class="flaticon-menu-1"></span></a>
      </div>
    </div>
  </div>
</header>