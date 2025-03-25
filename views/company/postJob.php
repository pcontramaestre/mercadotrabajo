<?php
  if (empty($_SESSION['company_id']) || $_SESSION['role_id'] != 3) {
    echo "Acceso denegado. Por favor, inicia sesión.";
    die(); // Detener la ejecución del script";
  }
  
  include_once 'config/config.php';
  include_once 'views/company/header.php';
?>

<!-- Main Content -->
<main class="flex-1 md:ml-64 md:pl-0 pl-0 pt-16 md:pt-0">
    <section class="p-6">
      <div class="max-w-6xl mx-auto">
        <div class="mb-8">
          <h1 class="text-2xl font-bold text-gray-800" data-translate-es="Publicar Nuevo Trabajo" data-translate-en="Post New Job">Publicar Nuevo Trabajo</h1>
          <p class="text-gray-500 mt-1" data-translate-es="Completa el formulario para publicar una nueva oferta de trabajo" data-translate-en="Complete the form to post a new job offer">Completa el formulario para publicar una nueva oferta de trabajo</p>
        </div>

        <!-- Job Form Content -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6 border border-gray-200">
          <div class="widget-title mb-6">
            <h4 class="text-lg font-medium text-gray-700" data-translate-es="Detalles del Trabajo" data-translate-en="Job Details">Detalles del Trabajo</h4>
          </div>

          <form id="job-form" class="default-form">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <!-- Título del trabajo -->
              <div class="form-group">
                <label class="block text-sm font-medium text-gray-700 mb-1" data-translate-es="Título del Trabajo <span class='text-red-500'>*</span>" data-translate-en="Job Title <span class='text-red-500'>*</span>">
                  Título del Trabajo <span class="text-red-500">*</span> 
                </label>
                <input
                  placeholder="Ej: Desarrollador Web Senior"
                  required
                  type="text"
                  name="title"
                  id="title"
                  required
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                />
              </div>

              <!-- Categoría -->
              <div class="form-group">
                <label class="block text-sm font-medium text-gray-700 mb-1" data-translate-es="Categoría <span class='text-red-500'>*</span>" data-translate-en="Category <span class='text-red-500'>*</span>">
                  Categoría <span class="text-red-500">*</span>
                </label>
                <select
                  class="form-select w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                  name="category_id"
                  id="category_id"
                  required
                >
                  <option value="">Seleccione una categoría</option>
                  <!-- Las categorías se cargarán desde la base de datos -->
                </select>
              </div>

              <!-- Tipo de trabajo -->
              <div class="form-group">
                <label class="block text-sm font-medium text-gray-700 mb-1" data-translate-es="Tipo de Trabajo <span class='text-red-500'>*</span>" data-translate-en="Job Type <span class='text-red-500'>*</span>">
                  Tipo de Trabajo <span class="text-red-500">*</span>
                </label>
                <select
                  class="form-select w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                  name="job_type_id"
                  id="job_type_id"
                  required
                >
                  <option value="">Seleccione un tipo</option>
                  <!-- Los tipos de trabajo se cargarán desde la base de datos -->
                </select>
              </div>

              <!-- Tipo de empleo -->
              <div class="form-group">
                <label class="block text-sm font-medium text-gray-700 mb-1" data-translate-es="Tipo de Empleo <span class='text-red-500'>*</span>" data-translate-en="Employment Type <span class='text-red-500'>*</span>">
                  Tipo de Empleo <span class="text-red-500">*</span>
                </label>
                <select
                  class="form-select w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                  name="employment_type_id"
                  id="employment_type_id"
                  required
                >
                  <option value="">Seleccione un tipo de empleo</option>
                  <!-- Los tipos de empleo se cargarán desde la base de datos -->
                </select>
              </div>

              <!-- Ciudad -->
              <div class="form-group">
                <label class="block text-sm font-medium text-gray-700 mb-1" data-translate-es="Ciudad <span class='text-red-500'>*</span>" data-translate-en="City <span class='text-red-500'>*</span>">
                  Ciudad <span class="text-red-500">*</span>
                </label>
                <input
                  placeholder="Ej: Caracas"
                  type="text"
                  name="city"
                  id="city"
                  required
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                />
              </div>

              <!-- Prioridad -->
              <div class="form-group">
                <label class="block text-sm font-medium text-gray-700 mb-1" data-translate-es="Prioridad <span class='text-red-500'>*</span>" data-translate-en="Priority <span class='text-red-500'>*</span>">
                  Prioridad <span class="text-red-500">*</span>
                </label>
                <select
                  class="form-select w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                  name="priority"
                  id="priority"
                  required
                >
                  <option value="Normal">Normal</option>
                  <option value="Low">Baja</option>
                  <option value="High">Alta</option>
                  <option value="Urgent">Urgente</option>
                </select>
              </div>
            </div>

            <!-- Sección de salario -->
            <div class="mt-6 mb-6">
              <div class="flex items-center mb-4">
                <input type="checkbox" id="show_salary" name="show_salary" class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                <label for="show_salary" class="ml-2 block text-sm text-gray-700" data-translate-es="Mostrar salario en la publicación" data-translate-en="Show salary in posting">
                  Mostrar salario en la publicación
                </label>
              </div>
              
              <div id="salary-fields" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="form-group">
                  <label class="block text-sm font-medium text-gray-700 mb-1" data-translate-es="Salario Mínimo" data-translate-en="Minimum Salary">
                    Salario Mínimo expresado en dólares
                  </label>
                  <input
                    placeholder="Ej: 1000.00"
                    type="number"
                    step="0.01"
                    name="salary_min"
                    id="salary_min"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                  />
                </div>
                
                <div class="form-group">
                  <label class="block text-sm font-medium text-gray-700 mb-1" data-translate-es="Salario Máximo" data-translate-en="Maximum Salary">
                    Salario Máximo expresado en dólares
                  </label>
                  <input
                    placeholder="Ej: 2000.00"
                    type="number"
                    step="0.01"
                    name="salary_max"
                    id="salary_max"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                  />
                </div>
              </div>
            </div>

            <!-- URL Externa -->
            <div class="form-group mb-6">
              <label class="block text-sm font-medium text-gray-700 mb-1" data-translate-es="URL Externa (opcional)" data-translate-en="External URL (optional)">
                URL Externa (opcional)
              </label>
              <input
                placeholder="https://ejemplo.com/trabajo"
                type="url"
                name="external_url"
                id="external_url"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
              />
              <p class="text-xs text-gray-500 mt-1" data-translate-es="Si deseas que los candidatos apliquen a través de un sitio externo" data-translate-en="If you want candidates to apply through an external site">
                Si deseas que los candidatos apliquen a través de un sitio externo
              </p>
            </div>

            <!-- Descripción del trabajo -->
            <div class="form-group mb-6">
              <label class="block text-sm font-medium text-gray-700 mb-1" data-translate-es="Descripción del Trabajo <span class='text-red-500'>*</span>" data-translate-en="Job Description <span class='text-red-500'>*</span>">
                Descripción del Trabajo <span class="text-red-500">*</span>
              </label>
              <textarea
                placeholder="Describe detalladamente el puesto de trabajo..."
                name="job_description"
                id="job_description"
                rows="6"
                required
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
              ></textarea>
            </div>

            <!-- Responsabilidades clave -->
            <div class="form-group mb-6">
              <label class="block text-sm font-medium text-gray-700 mb-1" data-translate-es="Responsabilidades Clave (una por línea)" data-translate-en="Key Responsibilities">
                Responsabilidades Clave, una por línea
              </label>
              <textarea
                placeholder="Lista las principales responsabilidades del puesto... Una por línea.
Responsabilidad 1
Responsabilidad 2
                "
                name="key_responsibilities"
                id="key_responsibilities"
                rows="4"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
              ></textarea>
            </div>

            <!-- Habilidades y experiencia -->
            <div class="form-group mb-6">
              <label class="block text-sm font-medium text-gray-700 mb-1" data-translate-es="Habilidades y Experiencia Requeridas (una por línea)" data-translate-en="Required Skills and Experience">
                Habilidades y Experiencia Requeridas, una por línea
              </label>
              <textarea
                placeholder="Detalla las habilidades y experiencia necesarias... Una por línea
Habilidad 1
Habilidad 2"
                name="skills_experience"
                id="skills_experience"
                rows="4"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
              ></textarea>
            </div>

            <!-- Botones de acción -->
            <div class="flex justify-end space-x-4 mt-6">
              <button type="button" class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50" data-translate-es="Cancelar" data-translate-en="Cancel">
                Cancelar
              </button>
              <button type="submit" id="submit-button" class="px-6 py-2 bg-primary text-white rounded-md hover:bg-primary-dark" data-translate-es="Publicar Trabajo" data-translate-en="Post Job">
                Publicar Trabajo
              </button>
            </div>
          </form>
        </div>
      </div>
    </section>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Cargar categorías, tipos de trabajo y tipos de empleo
  loadCategories();
  loadJobTypes();
  loadEmploymentTypes();
  
  // Manejar el envío del formulario
  const jobForm = document.getElementById('job-form');
  const button = document.getElementById('submit-button');
  if (jobForm) {
    jobForm.addEventListener('submit', function(e) {
      e.preventDefault();
      button.disabled = true;
      button.textContent = 'Guardando...';
      submitJobForm();
    });
  }
  
  // Manejar la visibilidad de los campos de salario
  const salaryFields = document.getElementById('salary-fields');
  if (salaryFields) {
    salaryFields.classList.add('hidden');
  }
  const showSalaryCheckbox = document.getElementById('show_salary');
  if (showSalaryCheckbox) {
    showSalaryCheckbox.addEventListener('change', function() {
      if (this.checked) {
        salaryFields.classList.remove('hidden');
      } else {
        salaryFields.classList.add('hidden');
      }
    });
  }
});

// Función para cargar las categorías desde la base de datos
function loadCategories() {
  fetch('<?php echo SYSTEM_BASE_DIR ?>api/v1/getdatacompany?action=getCategories')
    .then(response => response.json())
    .then(data => {
      const categorySelect = document.getElementById('category_id');
      data.forEach(category => {
        const option = document.createElement('option');
        option.setAttribute('data-translate-es', category.name_es);
        option.setAttribute('data-translate-en', category.name);
        option.value = category.id;
        option.textContent = category.name_es;
        categorySelect.appendChild(option);
      });
    })
    .catch(error => console.error('Error cargando categorías:', error));
}

// Función para cargar los tipos de trabajo desde la base de datos
function loadJobTypes() {
  fetch('<?php echo SYSTEM_BASE_DIR ?>api/v1/getdatacompany?action=getJobTypes')
    .then(response => response.json())
    .then(data => {
      const jobTypeSelect = document.getElementById('job_type_id');
      data.forEach(jobType => {
        const option = document.createElement('option');
        option.value = jobType.id;
        option.textContent = jobType.name_es;
        jobTypeSelect.appendChild(option);
      });
    })
    .catch(error => console.error('Error cargando tipos de trabajo:', error));
}

// Función para cargar los tipos de empleo desde la base de datos
function loadEmploymentTypes() {
  fetch('<?php echo SYSTEM_BASE_DIR ?>api/v1/getdatacompany?action=getEmploymentTypes')
    .then(response => response.json())
    .then(data => {
      const employmentTypeSelect = document.getElementById('employment_type_id');
      data.forEach(employmentType => {
        const option = document.createElement('option');
        option.value = employmentType.id;
        option.textContent = employmentType.name_es;
        employmentTypeSelect.appendChild(option);
      });
    })
    .catch(error => console.error('Error cargando tipos de empleo:', error));
}

// Función para enviar el formulario
function submitJobForm() {
  const button = document.getElementById('submit-button');
  button.disabled = true;
  button.textContent = 'Guardando...';
  
  const action = 'createJob';
  const jobData = {};

  // Collect form data
  const formData = new FormData(document.getElementById('job-form'));
  for (const [key, value] of formData.entries()) {
    jobData[key] = value;
  }
  
  formData.append("action", action);
  formData.append("data", JSON.stringify(jobData));
  
  fetch('<?php echo SYSTEM_BASE_DIR ?>api/v1/setdatajob', {
    method: 'POST',
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    console.log(data);
    if (data.success) {
      showToast('Trabajo publicado exitosamente');
      //esperar 2 segundos
      setTimeout(() => {
        button.disabled = false;
        button.textContent = 'Publicar Trabajo';
        window.location.href = '<?php echo SYSTEM_BASE_DIR ?>dashboard/company/dashboard';
      }, 2000);
    } else {
      showToast('Error al publicar el trabajo: ' + data.message, 'error');
      button.disabled = false;
      button.textContent = 'Publicar Trabajo';
    }
  })
  .catch(error => {
    console.error('Error:', error);
    showToast('Ha ocurrido un error al enviar el formulario', 'error');
    button.disabled = false;
    button.textContent = 'Publicar Trabajo';
  });
}
</script>

<?php
  include_once 'views/company/footer.php';
?>
