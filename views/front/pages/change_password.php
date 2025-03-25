<?php
  if (empty($_SESSION['user_id'])) {
    echo "Acceso denegado. Por favor, inicia sesión.";
    die(); // Detener la ejecución del script
  }

  include_once 'config/config.php';
  if ($_SESSION['role_id'] == 2) {
    include_once 'views/candidate/header.php';
  } else if ($_SESSION['role_id'] == 3) {
    include_once 'views/company/header.php';
  }
?>

<!-- Main Content -->
<main class="flex-1 md:ml-64 md:pl-0 pl-0 pt-16 md:pt-0">
    <section class="p-6">
      <div class="max-w-6xl mx-auto">
        <div class="mb-8">
          <h1 class="text-2xl font-bold text-gray-800" data-translate-es="Cambiar Contraseña" data-translate-en="Change Password">
            Cambiar Contraseña
          </h1>
          <p class="text-gray-500 mt-1" data-translate-es="Actualiza tu contraseña para mantener tu cuenta segura" data-translate-en="Update your password to keep your account secure">Actualiza tu contraseña para mantener tu cuenta segura</p>
        </div>

        <!-- Password Change Content -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6 border border-gray-200">
          <div class="widget-title mb-6">
            <h4 class="text-lg font-medium text-gray-700" data-translate-es="Cambiar Contraseña" data-translate-en="Change Password">
              Cambiar Contraseña
            </h4>
          </div>

          <form id="change-password-form" class="default-form">
            <div class="grid grid-cols-1 gap-6 max-w-md">
              <!-- Current Password -->
              <div class="form-group">
                <label class="block text-sm font-medium text-gray-700 mb-1" data-translate-es="Contraseña Actual *" data-translate-en="Current Password *">
                  Contraseña Actual *
                </label>
                <div class="relative">
                  <input
                    placeholder="••••••••"
                    required
                    type="password"
                    name="current_password"
                    id="current_password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                  />
                  <button type="button" class="password-toggle absolute inset-y-0 right-0 pr-3 flex items-center">
                    <i data-lucide="eye" class="password-toggle-icon w-5 h-5 text-gray-400"></i>
                  </button>
                </div>
              </div>

              <!-- New Password -->
              <div class="form-group">
                <label class="block text-sm font-medium text-gray-700 mb-1" data-translate-es="Nueva Contraseña *" data-translate-en="New Password *">
                  Nueva Contraseña *
                </label>
                <div class="relative">
                  <input
                    placeholder="••••••••"
                    required
                    type="password"
                    name="new_password"
                    id="new_password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                  />
                  <button type="button" class="password-toggle absolute inset-y-0 right-0 pr-3 flex items-center">
                    <i data-lucide="eye" class="password-toggle-icon w-5 h-5 text-gray-400"></i>
                  </button>
                </div>
                <p class="text-xs text-gray-500 mt-1" data-translate-es="La contraseña debe tener al menos 8 caracteres" data-translate-en="Password must be at least 8 characters long">
                  La contraseña debe tener al menos 8 caracteres
                </p>
              </div>

              <!-- Confirm New Password -->
              <div class="form-group">
                <label class="block text-sm font-medium text-gray-700 mb-1" data-translate-es="Confirmar Nueva Contraseña *" data-translate-en="Confirm New Password *">
                  Confirmar Nueva Contraseña *
                </label>
                <div class="relative">
                  <input
                    placeholder="••••••••"
                    required
                    type="password"
                    name="confirm_password"
                    id="confirm_password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                  />
                  <button type="button" class="password-toggle absolute inset-y-0 right-0 pr-3 flex items-center">
                    <i data-lucide="eye" class="password-toggle-icon w-5 h-5 text-gray-400"></i>
                  </button>
                </div>
              </div>

              <div class="form-group">
                <button
                  type="submit"
                  id="change_password_button"
                  class="btn bg-primary hover:bg-primary-600 text-white px-6 py-2 rounded-md transition-all"
                  data-translate-es="Actualizar Contraseña" data-translate-en="Update Password"
                >
                  Actualizar Contraseña
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>
</main>

<!-- JavaScript for password toggle functionality -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Initialize Lucide icons
    lucide.createIcons();
    
    // Password toggle functionality
    const toggleButtons = document.querySelectorAll('.password-toggle');
    
    toggleButtons.forEach(button => {
      button.addEventListener('click', function() {
        const input = this.parentElement.querySelector('input');
        const icon = this.querySelector('.password-toggle-icon');
        
        // Toggle password visibility
        if (input.type === 'password') {
          input.type = 'text';
          icon.setAttribute('name', 'eye-off');
        } else {
          input.type = 'password';
          icon.setAttribute('name', 'eye');
        }
        
        // Re-initialize the icon
        lucide.createIcons({
          icons: {
            'eye': icon.getAttribute('name') === 'eye',
            'eye-off': icon.getAttribute('name') === 'eye-off'
          },
          nameAttr: 'data-lucide'
        });
      });
    });
    
    // Form submission
    const form = document.getElementById('change-password-form');
    
    form.addEventListener('submit', function(e) {
      e.preventDefault();
      
      const currentPassword = document.getElementById('current_password').value;
      const newPassword = document.getElementById('new_password').value;
      const confirmPassword = document.getElementById('confirm_password').value;
      const submitButton = document.getElementById('change_password_button');

      submitButton.disabled = true;
      submitButton.textContent = 'Actualizando...';
      

      
      
      // Basic validation
      if (!currentPassword || !newPassword || !confirmPassword) {
        showToast('Por favor complete todos los campos', 'error');
        return;
      }
      
      if (newPassword !== confirmPassword) {
        showToast('Las contraseñas nuevas no coinciden', 'error');
        return;
      }
      
      if (newPassword.length < 8) {
        showToast('La contraseña debe tener al menos 8 caracteres', 'error');
        return;
      }
      
      // Here you would normally send the data to the server
      // For now, we'll just show a success message
      const formData = new FormData();
      
      formData.append('current_password', currentPassword);
      formData.append('new_password', newPassword);
      
      fetch('<?php echo SYSTEM_BASE_DIR ?>api/v1/changepassword', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          showToast('Contraseña actualizada correctamente', 'success');
          submitButton.disabled = false;
          submitButton.textContent = 'Cambiar Contraseña';
          form.reset();
        } else {
          showToast(data.message, 'error');
          submitButton.disabled = false;
          submitButton.textContent = 'Cambiar Contraseña';
        }
      })
      .catch(error => {
        console.error('Error al cambiar la contraseña:', error);
        showToast('Error al cambiar la contraseña: ' + error, 'error');
        submitButton.disabled = false;
        submitButton.textContent = 'Cambiar Contraseña';
      });
    });
    
    // // Toast notification function
    // function showToast(message, type = 'success') {
    //   const toast = document.getElementById('toast');
    //   const toastMessage = document.getElementById('toast-message');
      
    //   toastMessage.textContent = message;
      
    //   // Set toast type (success/error)
    //   if (type === 'error') {
    //     toast.classList.add('error');
    //   } else {
    //     toast.classList.remove('error');
    //   }
      
    //   // Show toast
    //   toast.classList.add('show');
      
    //   // Hide toast after 3 seconds
    //   setTimeout(() => {
    //     toast.classList.remove('show');
    //   }, 3000);
    // }
  });
</script>

<?php
  include_once 'views/candidate/footer.php';
?>
