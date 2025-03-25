<?php
// views/front/pages/register_candidate.php
include_once 'views/layout/header.php';
include_once 'views/layout/navbar.php';

$titleSection = [
    'translate_es' => 'Registro de Candidato',
    'translate_en' => 'Candidate Registration'
];

require_once 'views/components/pageTitleInternal.php';
?>

<?php if ($error): ?>
    <div class="alert alert-danger mb-4 mt-4 text-center">
        <?php
            switch ($error) {
                case '1':
                    echo 'El correo electrónico ya está registrado.';
                    break;
                case '2':
                    echo 'El correo electrónico no es válido.';
                    break;
                case '3':
                    echo 'El número de teléfono no es válido.';
                    break;
                case '4':
                    echo 'El número de teléfono ya está registrado.';
                    break;
                default:
                    echo 'Ha ocurrido un error al registrar el candidato, intente de nuevo.';
                    break;
            }
        ?>
    </div>
<?php endif; ?>

<div class="register-candidate pt-8 mb-12">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto bg-white rounded-lg overflow-hidden shadow-lg p-6 mb-8">
            <form action="<?php echo SYSTEM_BASE_DIR ?>registerCandidate" method="post" class="space-y-6" id="register-form">
                <div class="pb-8 mb-8 border-b">
                    <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">Información Personal</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="form-group">
                            <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">Nombre <span class="text-red-500">*</span></label>
                            <input type="text" id="first_name" name="first_name" placeholder="Ingresa tu nombre" required 
                                   class="w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#13358a] focus:border-[#13358a]">
                        </div>
                        
                        <div class="form-group">
                            <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Apellido <span class="text-red-500">*</span></label>
                            <input type="text" id="last_name" name="last_name" placeholder="Ingresa tu apellido" required 
                                   class="w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#13358a] focus:border-[#13358a]">
                        </div>
                        
                        <div class="form-group">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Correo Electrónico <span class="text-red-500">*</span></label>
                            <input type="email" id="email" name="email" placeholder="Ingresa tu correo electrónico" required 
                                   class="w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#13358a] focus:border-[#13358a]">
                        </div>
                        
                        <div class="form-group">
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Teléfono <span class="text-red-500">*</span></label>
                            <input type="tel" id="phone" name="phone" placeholder="Ingresa tu número de teléfono" required 
                                   class="w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#13358a] focus:border-[#13358a]">
                        </div>
                    </div>
                </div>
                
                <div class="pb-8 mb-8 border-b">
                    <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">Información de Acceso</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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
                
                <div class="pb-8 mb-8 border-b">
                    <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">Información Profesional</h3>
                    
                    <div class="grid grid-cols-1 gap-6">
                        <div class="form-group">
                            <label for="profession" class="block text-sm font-medium text-gray-700 mb-1">Profesión <span class="text-red-500">*</span></label>
                            <input type="text" id="profession" name="profession" placeholder="Ingresa tu profesión" required 
                                   class="w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#13358a] focus:border-[#13358a]">
                        </div>
                        
                        <div class="form-group">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Descripción <span class="text-red-500">*</span></label>
                            <textarea id="description" name="description" rows="3" placeholder="Ingresa aquí una descripción personal" required 
                                      class="w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#13358a] focus:border-[#13358a]"></textarea>
                        </div>

                        <!-- Nivel educativo -->
                        <div class="form-group">
                            <label for="education" class="block text-sm font-medium text-gray-700 mb-1">Nivel Educativo <span class="text-red-500">*</span></label>
                            <select
                                class="form-select w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                                name="education_levels"
                                id="education_levels"
                                required
                                >
                                <option value="Bachiller" data-translate-es="Bachiller" data-translate-en="High school">Bachiller</option>
                                <option value="Técnico superior" data-translate-es="Técnico superior" data-translate-en="Associate Degree">Técnico superior</option>
                                <option value="Universitario" data-translate-es="Universitario" data-translate-en="Bachelor's Degree">Universitario</option>
                                <option value="Maestría" data-translate-es="Maestría" data-translate-en="Master's Degree">Maestría</option>
                                <option value="Doctorado" data-translate-es="Doctorado" data-translate-en="Doctorate">Doctorado</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="experience" class="block text-sm font-medium text-gray-700 mb-1">Años de Experiencia</label>
                            <select id="experience" name="experience" 
                                    class="w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#13358a] focus:border-[#13358a]">
                                <option value="">Selecciona una opción</option>
                                <option value="0-1">Menos de 1 año</option>
                                <option value="1-3">1-3 años</option>
                                <option value="3-5">3-5 años</option>
                                <option value="5-10">5-10 años</option>
                                <option value="10+">Más de 10 años</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-700 mb-1" data-translate-es="Idiomas que manejas" data-translate-en="Languages">
                            Idiomas que manejas
                            </label>
                            <input
                            placeholder="Español, English, Alemán, etc."
                            required
                            type="text"
                            name="languages"
                            id="languages"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                            />
                        </div>
                    </div>
                </div>
                
                <div class="pb-8 mb-8 border-b">
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
});
</script>

<?php
include_once 'views/layout/footer.php';
?>
