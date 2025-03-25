<?php
// views/login/login.php
include_once 'views/layout/header.php';
include_once 'views/layout/navbar.php';

$titleSection = [
    'translate_es' => 'Iniciar sesión',
    'translate_en' => 'Login'
];
require_once 'views/components/pageTitleInternal.php';

?>
<div class="login style-two pt-8 mb-8">
    <?php
        switch ($message) {
            case 1:
                echo '
                    <div class="alert alert-danger mb-4 mt-4 text-center">
                        Credenciales incorrectas
                    </div>';
                break;
            case 2:
                echo '
                    <div class="alert alert-success mb-4 mt-4 text-center">
                        Te has registrado correctamente, inicia sesión
                    </div>';
                break;
            case 3:
                echo '
                    <div class="alert alert-danger mb-4 mt-4 text-center">
                        Ha ocurrido un error, inténtalo de nuevo
                    </div>';
                break;
            default:
                break;
        }
    ?>

    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto bg-white rounded-lg overflow-hidden shadow-lg p-6 mb-8">
            <form action="<?php echo SYSTEM_BASE_DIR ?>loginUser" method="post" class="space-y-6" autocomplete="on">
                <div class="form-group">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Correo Electrónico</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input type="email" id="email" name="email" placeholder="Ingresa tu correo electrónico" required 
                               class="pl-10 w-full py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                               autocomplete="email" value="<?php echo isset($_COOKIE['user_email']) ? htmlspecialchars($_COOKIE['user_email']) : ''; ?>">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required 
                               class="pl-10 w-full py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                               autocomplete="current-password">
                    </div>
                </div>
                
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                               <?php echo isset($_COOKIE['user_email']) ? 'checked' : ''; ?>>
                        <label for="remember" class="ml-2 block text-sm text-gray-700">Recordarme</label>
                    </div>
                    <div class="text-sm">
                        <a href="#" class="font-medium text-blue-600 hover:text-blue-500">¿Olvidaste tu contraseña?</a>
                    </div>
                </div>
                
                <div>
                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Iniciar Sesión
                    </button>
                </div>
            </form>
            
            <div class="text-center mt-6">
                <p class="text-sm text-gray-600">¿No tienes una cuenta? <a href="#" class="text-lg font-medium text-blue-600 hover:text-blue-500" id="register-link">Regístrate aquí</a></p>
            </div>
        </div>
    </div>
</div>
<!-- Modal de Registro -->
<div id="registration-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50 flex items-center justify-center">
    <div class="relative mx-auto p-5 border w-11/12 md:w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-[#13358a] text-white">
                <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
            </div>
            <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">Selecciona tipo de registro</h3>
            <div class="mt-6 px-7 py-3">
                <p class="text-sm text-gray-500 mb-6">
                    Elige cómo deseas registrarte en nuestra plataforma
                </p>
                <div class="flex flex-col space-y-4">
                    <a href="<?php echo SYSTEM_BASE_DIR ?>register/company" class="flex items-center justify-center px-4 py-3 border border-transparent text-base font-medium rounded-md text-white bg-[#13358a] hover:bg-[#0f2a6e] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#13358a] transition duration-150 ease-in-out">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        Registrarse como Empresa
                    </a>
                    <a href="<?php echo SYSTEM_BASE_DIR ?>register/candidate" class="flex items-center justify-center px-4 py-3 border border-[#13358a] text-base font-medium rounded-md text-[#13358a] bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#13358a] transition duration-150 ease-in-out">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Registrarse como Candidato
                    </a>
                </div>
            </div>
            <div class="items-center px-4 py-3">
                <button id="close-modal" class="px-4 py-2 bg-gray-200 text-gray-800 text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    Cancelar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript para controlar el modal -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('registration-modal');
        const registerLink = document.getElementById('register-link');
        const closeModal = document.getElementById('close-modal');
        
        // Abrir modal
        registerLink.addEventListener('click', function(e) {
            e.preventDefault();
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Prevenir scroll
        });
        
        // Cerrar modal con el botón
        closeModal.addEventListener('click', function() {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto'; // Permitir scroll
        });
        
        // Cerrar modal al hacer clic fuera
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto'; // Permitir scroll
            }
        });
    });
</script>

<?php
include_once 'views/layout/footer.php';
?>