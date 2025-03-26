<style>
    .process-block .icon-box:before {
        background-image: url(<?php echo SYSTEM_BASE_DIR. 'assets/img/shape-3.png' ?>);
    }
</style>
<section class="process-section pt-0">
    <div class="auto-container">
        <div class="sec-title text-center">
            <h2 data-translate-en="How It Works?" data-translate-es="¿Cómo funciona?">How It Works?</h2>
            <div class="text" data-translate-en="Job for anyone, anywhere" data-translate-es="Trabajo para cualquiera, en cualquier lugar">Job for anyone, anywhere</div>
        </div>
        <div class="row">
            <div class="process-block col-lg-4 col-md-6 col-sm-12">
                <div class="icon-box">
                    <?php
                        if (empty($_SESSION['user_id'])) {
                    ?>
                        <a href="<?php echo SYSTEM_BASE_DIR ?>login">
                            <img alt="how it works" loading="lazy" width="50" height="61" decoding="async" data-nimg="1" 
                            src="<?php  echo SYSTEM_BASE_DIR . 'assets/img/process-1.webp' ?>"style="color: transparent;">
                        </a>
                    <?php
                        } else {
                    ?>
                        <img alt="how it works" loading="lazy" width="50" height="61" decoding="async" data-nimg="1" 
                        src="<?php  echo SYSTEM_BASE_DIR . 'assets/img/process-1.webp' ?>"style="color: transparent;">
                    <?php
                        }
                    ?>
                </div>
                <h4 data-translate-en="Register an account" data-translate-es="Registre una cuenta">Register an account 
                    <br> 
                </h4>
                <h4 data-translate-en="to start" data-translate-es="para comenzar" class="">to start</h4>
            </div>
            <div class="process-block col-lg-4 col-md-6 col-sm-12">
                <div class="icon-box">
                    <img alt="how it works" loading="lazy" width="50" height="61" decoding="async" data-nimg="1" 
                    src="<?php  echo SYSTEM_BASE_DIR . 'assets/img/process-2.webp' ?>" style="color: transparent;">
                </div>

                <h4 data-translate-en="Explore over thousands" data-translate-es="Explora más de miles">Explore over thousands 
                    <br>
                </h4>
                <h4 data-translate-en="of resumes" data-translate-es="de currículums">
                    of resumes
                </h4>

            </div>
            <div class="process-block col-lg-4 col-md-6 col-sm-12">
                <div class="icon-box">
                <img alt="how it works" loading="lazy" width="50" height="61" decoding="async" data-nimg="1" 
                src="<?php  echo SYSTEM_BASE_DIR . 'assets/img/process-2.webp' ?>" style="color: transparent;">    
                </div>
                <h4 data-translate-en="Find the most suitable" data-translate-es="Encuentra el candidato más">
                    Find the most suitable <br>
                </h4>
                <h4 data-translate-en="candidate" data-translate-es="adecuado">
                candidate
                </h4>
            </div>
        </div>
    </div>
</section>