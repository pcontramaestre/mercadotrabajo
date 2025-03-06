<footer class="main-footer style-three" style="background-image: url(<?php echo SYSTEM_BASE_DIR ?>assets/img/bg-footer.webp);">
    <div class="auto-container">
        <div class="widgets-section aos-init aos-animate" data-aos="fade-up">
            <div class="newsletter-form wow fadeInUp">
                <div class="sec-title light text-center">
                    <h2 data-translate-en="Subscribe Our Newsletter" data-translate-es="Suscríbete a nuestro boletín">Subscribe Our Newsletter</h2>
                    <div class="text" data-translate-en="We don’t send spam so don’t worry." data-translate-es="No enviamos spam así que no te preocupes.">
                        We don’t send spam so don’t worry.
                    </div>
                </div>
                <form>
                    <div class="form-group">
                        <div class="response"></div>
                    </div>
                    <div class="form-group">
                        <input class="email" placeholder="Your e-mail" required="" data-translate-en="Your e-mail" data-translate-es="Tu correo" type="email" name="email"><button type="button" id="subscribe-newslatters" class="theme-btn btn-style-two">
                            <span data-translate-en="Susbcribe" data-translate-es="Suscribirse">Subscribe</span>
                        </button>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="big-column col-xl-3 col-lg-3 col-md-12">
                    <div class="footer-column about-widget">
                        <div class="logo"><a href="<?php echo SYSTEM_BASE_DIR ?>"><img alt="brand" loading="lazy" width="154" height="50" decoding="async" data-nimg="1" src="<?php ?>assets/img/logo2.png" style="color: transparent;"></a></div>
                        <p class="phone-num">
                            <span data-translate-en="Call us" data-translate-es="Llámanos">Call us </span>
                            <a href="thebeehost@support.com">123 456 7890</a>
                        </p>
                        <p class="address">329 FL Street, North Melbourne VIC<br> 3051, USA. <br><a href="mailto:support@mercadotrabajo.com" class="email">support@mercadotrabajo.com</a></p>
                    </div>
                </div>
                <div class="big-column col-xl-9 col-lg-9 col-md-12">
                    <div class="row">
                        <div class="footer-column col-lg-3 col-md-6 col-sm-12">
                            <div class="footer-widget links-widget">
                                <h4 class="widget-title" data-translate-en="For Candidates" data-translate-es="Para Candidatos">For Candidates</h4>
                                <div class="widget-content">
                                    <ul class="list">
                                        <li><a href="<?php echo SYSTEM_BASE_DIR ?>">Browse Jobs</a></li>
                                        <li><a href="#">Browse Categories</a></li>
                                        <li><a href="#">Browse Employers</a></li>
                                        <li><a href="#">Candidate Dashboard</a></li>
                                        <li><a href="#">Job Alerts</a></li>
                                        <li><a href="#">My Bookmarks</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="footer-column col-lg-3 col-md-6 col-sm-12">
                            <div class="footer-widget links-widget">
                                <h4 class="widget-title" data-translate-en="For Employers" data-translate-es="Para empresas">For Employers</h4>
                                <div class="widget-content">
                                    <ul class="list">
                                        <li><a href="#">Browse Candidates</a></li>
                                        <li><a href="#">Employer Dashboard</a></li>
                                        <li><a href="#">Add Job</a></li>
                                        <li><a href="#">Job Packages</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="footer-column col-lg-3 col-md-6 col-sm-12">
                            <div class="footer-widget links-widget">
                                <h4 class="widget-title" data-translate-en="About Us" data-translate-es="Sobre nosotros">About Us</h4>
                                <div class="widget-content">
                                    <ul class="list">
                                        <li><a href="#">About Us</a></li>
                                        <li><a href="#">Terms Page</a></li>
                                        <li><a href="#">Blog</a></li>
                                        <li><a href="#">Contact</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="footer-column col-lg-3 col-md-6 col-sm-12">
                            <div class="footer-widget">
                                <h4 class="widget-title">Mobile Apps</h4>
                                <div class="widget-content">
                                    <div class="download-btns">
                                        <div class="text">Click and Get started in seconds</div><a href="#" class="app-btn">
                                            <div class="app-icon"><i class="fab fa-apple"></i></div>
                                            <div class="inner">
                                                <div class="sub">Download on the</div>
                                                <div class="name-app">Apple Store</div>
                                            </div>
                                        </a><a href="#" class="app-btn">
                                            <div class="app-icon"><i class="fab fa-apple"></i></div>
                                            <div class="inner">
                                                <div class="sub">Get in on</div>
                                                <div class="name-app">Google Play</div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="auto-container">
            <div class="outer-box">
                <div class="copyright-text">© 2025 Mercadotrabajo by <a href="https://mercadotrabajo.com" target="_blank" rel="noopener noreferrer">MercadoTrabajo</a>. All Right Reserved.</div>
                <div class="social-links">
                    <a href="https://www.facebook.com/" target="_blank" rel="noopener noreferrer">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://www.twitter.com/" target="_blank" rel="noopener noreferrer">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://www.linkedin.com/" target="_blank" rel="noopener noreferrer">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>



<script>
    // Initialize Lucide icons
    lucide.createIcons();

    // Toast notification function
    function showToast(message, type = "success") {
        const toast = document.getElementById("toast");
        const toastMessage = document.getElementById("toast-message");

        // Set message and type
        toastMessage.textContent = message;
        toast.className = "toast";
        toast.classList.add(`toast-${type}`);

        // Show toast
        setTimeout(() => {
          toast.classList.add("show");
        }, 100);

        // Hide toast after 3 seconds
        setTimeout(() => {
          toast.classList.remove("show");
        }, 3000);
      }
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>

</html>