<?php
// views/front/pages/register_company.php
include_once 'views/layout/header.php';
include_once 'views/layout/navbar.php';

$titleSection = [
    'translate_es' => 'Registro de Empresa',
    'translate_en' => 'Company Registration'
];

require_once 'views/components/pageTitleInternal.php';
?>

<div class="register-company pt-8 mb-12">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto bg-white rounded-lg overflow-hidden shadow-lg p-6 mb-8">
            <form action="<?php echo SYSTEM_BASE_DIR ?>registerCompany" method="post" class="space-y-6" id="register-form" enctype="multipart/form-data">

                <?php if ($error): ?>
                    <div class="alert alert-danger">
                        <?php 
                            switch ($error) {
                                case 1:
                                    echo 'El correo electrónico ya existe';
                                    break;
                                default:
                                    echo 'Ocurrió un error al registrar la empresa';
                                    break;
                            }
                        ?>
                    </div>
                <?php endif; ?>

                <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">Información de Acceso</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-group">
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico de acceso<span class="text-red-500">*</span></label>
                        <input type="email" id="email" name="email" placeholder="Ingresa un correo electrónico para acceder a la cuenta" required 
                               class="w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#13358a] focus:border-[#13358a]">
                    </div>
                    <div class="form-group">
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Repetir correo electrónico de acceso<span class="text-red-500">*</span></label>
                        <input type="email" id="email_confirmation" name="mail_confirmation" placeholder="Ingresa un correo electrónico para acceder a la cuenta" required 
                               class="w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#13358a] focus:border-[#13358a]">
                    </div>
                        <div class="form-group">
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Contraseña <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <input type="password" id="password" name="password" placeholder="Crea tu contraseña" required 
                                       class="w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#13358a] focus:border-[#13358a]">
                                <div class="password-strength mt-1 text-xs"></div>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">La contraseña debe tener al menos 8 caracteres, incluir una letra mayúscula, un número y un carácter especial.</p>
                        </div>
                        
                        <div class="form-group">
                            <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-1">Confirmar Contraseña <span class="text-red-500">*</span></label>
                            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirma tu contraseña" required 
                                   class="w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#13358a] focus:border-[#13358a]">
                        </div>
                    </div>
                </div>
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">Información de la Empresa</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="form-group md:col-span-2">
                            <label for="company_name" class="block text-sm font-medium text-gray-700 mb-1">Nombre de la Empresa <span class="text-red-500">*</span></label>
                            <input type="text" id="company_name" name="name" placeholder="Ingresa el nombre de tu empresa" required 
                                   class="w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#13358a] focus:border-[#13358a]">
                        </div>
                        
                        <div class="form-group md:col-span-2">
                            <label for="website" class="block text-sm font-medium text-gray-700 mb-1">Sitio Web</label>
                            <input type="url" id="website" name="website" placeholder="https://www.ejemplo.com" 
                                   class="w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#13358a] focus:border-[#13358a]">
                        </div>
                        
                        <div class="form-group md:col-span-2">
                            <label for="company_description" class="block text-sm font-medium text-gray-700 mb-1">Descripción de la Empresa <span class="text-red-500">*</span></label>
                            <textarea id="company_description" name="description" rows="4" placeholder="Describe brevemente tu empresa y actividad" required 
                                      class="w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#13358a] focus:border-[#13358a]"></textarea>
                        </div>
                    </div>
                </div>
                
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">Información de Contacto</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="form-group">
                            <label for="contact_name" class="block text-sm font-medium text-gray-700 mb-1">Nombre de Contacto <span class="text-red-500">*</span></label>
                            <input type="text" id="contact_name" name="contact_name" placeholder="Nombre completo" required 
                                   class="w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#13358a] focus:border-[#13358a]">
                        </div>
                        
                        <div class="form-group">
                            <label for="contact_position" class="block text-sm font-medium text-gray-700 mb-1">Cargo <span class="text-red-500">*</span></label>
                            <input type="text" id="contact_position" name="contact_position" placeholder="Cargo en la empresa" required 
                                   class="w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#13358a] focus:border-[#13358a]">
                        </div>
                        
                        <div class="form-group">
                            <label for="contact_email" class="block text-sm font-medium text-gray-700 mb-1">Correo Electrónico <span class="text-red-500">*</span></label>
                            <input type="email" id="contact_email" name="contact_email" placeholder="correo@empresa.com" required 
                                   class="w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#13358a] focus:border-[#13358a]">
                        </div>
                        
                        <div class="form-group">
                            <label for="contact_phone" class="block text-sm font-medium text-gray-700 mb-1">Teléfono <span class="text-red-500">*</span></label>
                            <input type="tel" id="contact_phone" name="contact_phone" placeholder="Número de teléfono" required 
                                   class="w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#13358a] focus:border-[#13358a]">
                        </div>
                    </div>
                </div>
                
               
                
                <div class="mb-6">
                    <div class="form-group">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="terms" name="terms" type="checkbox" required
                                       class="h-4 w-4 text-[#13358a] focus:ring-[#13358a] border-gray-300 rounded">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="terms" class="font-medium text-gray-700">Acepto los <a href="<?php echo SYSTEM_BASE_DIR ?>terms" class="text-[#13358a] hover:underline" target="_blank">Términos y Condiciones</a> y la <a href="<?php echo SYSTEM_BASE_DIR ?>privacy" class="text-[#13358a] hover:underline" target="_blank">Política de Privacidad</a> <span class="text-red-500">*</span></label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div>
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#13358a] hover:bg-[#0f2a6e] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#13358a] transition duration-150 ease-in-out">
                        Completar Registro
                    </button>
                </div>
                
                <div class="text-center mt-4">
                    <p class="text-sm text-gray-600">¿Ya tienes una cuenta? <a href="<?php echo SYSTEM_BASE_DIR ?>login" class="font-medium text-[#13358a] hover:text-[#0f2a6e]">Inicia sesión aquí</a></p>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('register-form');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirm_password');
    const passwordStrength = document.querySelector('.password-strength');
    
    // Password strength checker
    password.addEventListener('input', function() {
        const value = password.value;
        let strength = 0;
        let message = '';
        
        if (value.length >= 8) strength += 1;
        if (value.match(/[A-Z]/)) strength += 1;
        if (value.match(/[0-9]/)) strength += 1;
        if (value.match(/[^a-zA-Z0-9]/)) strength += 1;
        
        switch (strength) {
            case 0:
                message = '';
                passwordStrength.className = 'password-strength mt-1 text-xs';
                break;
            case 1:
                message = 'Débil';
                passwordStrength.className = 'password-strength mt-1 text-xs text-red-500';
                break;
            case 2:
                message = 'Regular';
                passwordStrength.className = 'password-strength mt-1 text-xs text-orange-500';
                break;
            case 3:
                message = 'Buena';
                passwordStrength.className = 'password-strength mt-1 text-xs text-yellow-500';
                break;
            case 4:
                message = 'Fuerte';
                passwordStrength.className = 'password-strength mt-1 text-xs text-green-500';
                break;
        }
        
        passwordStrength.textContent = message;
    });
    
    // Form validation
    form.addEventListener('submit', function(e) {
        if (password.value !== confirmPassword.value) {
            e.preventDefault();
            alert('Las contraseñas no coinciden');
            confirmPassword.focus();
        }
    });
    
    // Preview logo image
    const logoInput = document.getElementById('logo');
    logoInput.addEventListener('change', function() {
        if (logoInput.files && logoInput.files[0]) {
            const file = logoInput.files[0];
            
            // Check file size (max 2MB)
            if (file.size > 2 * 1024 * 1024) {
                alert('El archivo es demasiado grande. El tamaño máximo permitido es 2MB.');
                logoInput.value = '';
                return;
            }
            
            // Check file type
            const fileType = file.type;
            if (fileType !== 'image/jpeg' && fileType !== 'image/png') {
                alert('Solo se permiten archivos JPG o PNG.');
                logoInput.value = '';
                return;
            }
        }
    });
});
</script>

<?php
include_once 'views/layout/footer.php';
?>
