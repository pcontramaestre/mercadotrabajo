            </div>
        </div>
        <script>
            lucide.createIcons();
            
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
            // Toggle del menú móvil
            document.getElementById('mobile-menu-toggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('hidden');
            });
            
            // Cerrar el sidebar en móvil cuando se hace clic fuera de él
            document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
            
            if (window.innerWidth < 768 && 
                !sidebar.contains(event.target) && 
                !mobileMenuToggle.contains(event.target)) {
                sidebar.classList.add('hidden');
            }
            });
            // Ajustar el sidebar en cambios de tamaño de ventana
            window.addEventListener('resize', function() {
            const sidebar = document.getElementById('sidebar');
            if (window.innerWidth >= 768) {
                sidebar.classList.remove('hidden');
            } else {
                sidebar.classList.add('hidden');
            }
            });
            
            // Inicializar el sidebar como oculto en móvil al cargar
            if (window.innerWidth < 768) {
            document.getElementById('sidebar').classList.add('hidden');
            }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    </body>  
</html>
