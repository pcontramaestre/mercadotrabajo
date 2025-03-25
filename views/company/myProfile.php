<?php
//print_r($_SESSION);
  if (empty($_SESSION['company_id']) || $_SESSION['role_id'] != 3) {
    echo "Acceso denegado. Por favor, inicia sesión.";
    die(); // Detener la ejecución del script";
  }
  /**
   * Data recibied
   * 
   * @param array $dataUserProfile
   * @param array $dataCompanyProfile
   */


  $dataCompanyProfile = $dataCompanyProfile[0];
  $founded_since = $dataCompanyProfile['founded_since'] === null ? '' : $dataCompanyProfile['founded_since'];
  
  include_once 'config/config.php';
  include_once 'views/company/header.php';
?>

<!-- Main Content -->
<main class="flex-1 md:ml-64 md:pl-0 pl-0 pt-16 md:pt-0">
    <section class="p-6">
      <div class="max-w-6xl mx-auto">
        <div class="mb-8">
          <h1 class="text-2xl font-bold text-gray-800" data-translate-es="Perfil de la Empresa" data-translate-en="Company Profile!">Company Profile!</h1>
          <p class="text-gray-500 mt-1">Ready to jump back in?</p>
        </div>

        <!-- Profile Content -->
        <div
          class="bg-white rounded-lg shadow-sm p-6 mb-6 border border-gray-200"
        >
          <div class="widget-title mb-6">
            <h4 class="text-lg font-medium text-gray-700" data-translate-es="Perfil de la Empresa" data-translate-en="My Profile">Perfil de la Empresa</h4>
          </div>

          <form id="profile-form" class="default-form" enctype="multipart/form-data">
            <!-- Logo Upload -->
            <div class="mb-6">
              <div
                class="image-upload-area flex flex-col items-center justify-center rounded-md p-6 cursor-pointer"
                data-image="<?php echo $dataCompanyProfile['logo_url']; ?>"
              >
                <input
                  type="file"
                  name="logo"
                  id="logo-upload"
                  class="hidden"
                  accept="image/jpeg, image/png, image/webp"
                />
                <i data-lucide="upload" class="w-8 h-8 text-gray-400 mb-2"></i>
                <p class="text-sm text-gray-500 font-medium" data-translate-es="Seleccionar Logo" data-translate-en="Browse Logo">Seleccionar Logo</p>
              </div>
              <p class="text-xs text-gray-500 mt-2" data-translate-es="Max file size is 1MB, Minimum dimension: 330x300 And Suitable files are .jpg & .png" data-translate-en="Max file size is 1MB, Minimum dimension: 330x300 And Suitable files are .jpg & .png">
                Max file size is 1MB, Minimum dimension: 330x300 And Suitable
                files are .jpg & .png
              </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div class="form-group">
                <label class="block text-sm font-medium text-gray-700 mb-1" data-translate-es="Nombre de la Empresa" data-translate-en="Company Name">
                  Nombre de la Empresa
                </label>
                <input
                  placeholder="Company Name"
                  required
                  type="text"
                  value="<?php echo $dataCompanyProfile['name']; ?>"
                  name="company_name"
                  id="company_name"
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                />
              </div>

              <div class="form-group">
                <label class="block text-sm font-medium text-gray-700 mb-1" data-translate-es="Email address" data-translate-en="Email address">
                  Email address
                </label>
                <input
                  placeholder="empresa@empresa.com"
                  required
                  type="email"
                  value="<?php echo $dataCompanyProfile['mail']; ?>"
                  name="email_address"
                  id="email_address"
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                />
              </div>

              <div class="form-group">
                <label class="block text-sm font-medium text-gray-700 mb-1" data-translate-es="Teléfono" data-translate-en="Phone">
                  Teléfono
                </label>
                <input
                  placeholder="0412 4444444"
                  type="text"
                  value="<?php echo $dataCompanyProfile['Phone'] ?? ''; ?>"
                  name="phone"
                  id="phone"
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                />
              </div>

              <div class="form-group">
                <label class="block text-sm font-medium text-gray-700 mb-1" data-translate-es="Website" data-translate-en="Website">
                  Website
                </label>
                <input
                  placeholder="https://www.mercadotrabajo.org"
                  type="url"
                  value="<?php echo $dataCompanyProfile['website'] ?? ''; ?>"
                  name="website"
                  id="website"
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                />
              </div>

              <div class="form-group">
                <label class="block text-sm font-medium text-gray-700 mb-1" data-translate-es="Fundada desde" data-translate-en="Founded since">
                  Fundada desde
                </label>
                <input
                  placeholder="2010"
                  type="text"
                  value="<?php echo $founded_since; ?>"
                  name="founded_since"
                  id="founded_since"
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                />
              </div>

              <div class="form-group">
                <label class="block text-sm font-medium text-gray-700 mb-1" data-translate-es="Tamaño de la Empresa" data-translate-en="Company size">
                  Tamaño de la Empresa
                </label>
                <select
                  class="form-select w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                  name="company_size"
                  id="company_size"
                  required
                >
                  <option value="1-10 empleados" <?php echo $dataCompanyProfile['company_size'] === '1-10 empleados' ? 'selected' : ''; ?>>1-10 empleados</option>
                  <option value="11-50 empleados" <?php echo $dataCompanyProfile['company_size'] === '11-50 empleados' ? 'selected' : ''; ?>>11-50 empleados</option>
                  <option value="51-100 empleados" <?php echo $dataCompanyProfile['company_size'] === '51-100 empleados' ? 'selected' : ''; ?>>51-100 empleados</option>
                  <option value="101-500 empleados" <?php echo $dataCompanyProfile['company_size'] === '101-500 empleados' ? 'selected' : ''; ?>>101-500 empleados</option>
                  <option value="> 500 empleados" <?php echo $dataCompanyProfile['company_size'] === '> 500 empleados' ? 'selected' : ''; ?>>> 500 empleados</option>
                </select>
              </div>

              <div class="form-group">
                <label class="block text-sm font-medium text-gray-700 mb-1" data-translate-es="Sector principal" data-translate-en="Primary industry">
                  Sector principal
                </label>
                <select
                  class="form-select w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                  name="primary_industry"
                  id="primary_industry"
                  required
                >
                  <option value="">Seleccione un sector</option>
                  <option value="Agricultura" <?php echo $dataCompanyProfile['primary_industry'] === 'Agricultura' ? 'selected' : ''; ?>>Agricultura</option>
                  <option value="Arquitectura" <?php echo $dataCompanyProfile['primary_industry'] === 'Arquitectura' ? 'selected' : ''; ?>>Arquitectura</option>
                  <option value="Artesanía" <?php echo $dataCompanyProfile['primary_industry'] === 'Artesanía' ? 'selected' : ''; ?>>Artesanía</option>
                  <option value="Tecnología" <?php echo $dataCompanyProfile['primary_industry'] === 'Tecnología' ? 'selected' : ''; ?>>Tecnología</option>
                  <option value="Desarrollo de software" <?php echo $dataCompanyProfile['primary_industry'] === 'Desarrollo de software' ? 'selected' : ''; ?>>Desarrollo de software</option>
                  <option value="Educación" <?php echo $dataCompanyProfile['primary_industry'] === 'Educación' ? 'selected' : ''; ?>>Educación</option>
                  <option value="Finanzas" <?php echo $dataCompanyProfile['primary_industry'] === 'Finanzas' ? 'selected' : ''; ?>>Finanzas</option>
                  <option value="Diseño gráfico" <?php echo $dataCompanyProfile['primary_industry'] === 'Diseño gráfico' ? 'selected' : ''; ?>>Diseño gráfico</option>
                  <option value="Marketing digital" <?php echo $dataCompanyProfile['primary_industry'] === 'Marketing digital' ? 'selected' : ''; ?>>Marketing digital</option>
                  <option value="Ventas" <?php echo $dataCompanyProfile['primary_industry'] === 'Ventas' ? 'selected' : ''; ?>>Ventas</option>
                  <option value="Contabilidad" <?php echo $dataCompanyProfile['primary_industry'] === 'Contabilidad' ? 'selected' : ''; ?>>Contabilidad</option>
                  <option value="Recursos humanos" <?php echo $dataCompanyProfile['primary_industry'] === 'Recursos humanos' ? 'selected' : ''; ?>>Recursos humanos</option>
                  <option value="Administración" <?php echo $dataCompanyProfile['primary_industry'] === 'Administración' ? 'selected' : ''; ?>>Administración</option>
                  <option value="Otro" <?php echo $dataCompanyProfile['primary_industry'] === 'Otro' ? 'selected' : ''; ?>>Otro</option>
                </select>
              </div>

              <div class="form-group">
                <label class="block text-sm font-medium text-gray-700 mb-1" data-translate-es="Permitido en Búsqueda y Listado" data-translate-en="Allow In Search & Listing">
                  Permitido en Búsqueda y Listado
                </label>
                <select
                  class="form-select w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                  name="allow_in_search_listing"
                  id="allow_in_search_listing"
                  required
                >
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                </select>
              </div>

              <div class="form-group col-span-1 md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1" data-translate-es="Descripción de la Empresa" data-translate-en="Company Description">
                  Descripción de la Empresa
                </label>
                <?php 
                  $description = htmlspecialchars(strip_tags(trim($dataCompanyProfile['description'] ?? '')), ENT_QUOTES, 'UTF-8');
                  ?>
                <textarea
                  data-translate-es="Agregar aquí la descripción de la empresa"
                  data-translate-en="Add company description here"
                  placeholder="Agregar descripción de la empresa"
                  rows="6"
                  name="description"
                  id="description"
                  class="company-description w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                ><?php echo $description; ?></textarea>
              </div>

              <div class="form-group">
                <button type="submit" class="theme-btn btn-style-one save-btn" data-translate-es="Guardar" data-translate-en="Save">
                  Save
                </button>
              </div>
            </div>
          </form>
        </div>

        <!-- Contact Information Section -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6 border border-gray-200">
          <div class="widget-title mb-6">
            <h4 class="text-lg font-medium text-gray-700" data-translate-es="Dirección de la Empresa" data-translate-en="Company Address">
              Dirección de la Empresa
            </h4>
          </div>

          <form id="contact-form" class="default-form" x-data="{ isVenezuela : '<?php echo $dataCompanyProfile['is_venezuela'] ? 'true' : 'false'; ?>' }">
            <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
              <div class="form-group mb-4">
                  <label class="block text-sm font-medium text-gray-700 mb-1" data-translate-es="¿Dónde se encuentra la empresa?" data-translate-en="Where is the company located?">
                      ¿Dónde se encuentra la empresa?
                  </label>
                  <div class="flex items-center">
                      <!-- Radio button para Venezuela -->
                      <input
                        type="radio" class="mr-2" id="isVenezuela" x-bind:value="true" x-model="isVenezuela" name="donde_empresa" <?php echo $dataCompanyProfile['is_venezuela'] ? 'checked' : ''; ?>>
                      <label class="text-sm font-medium text-gray-700 mr-4" for="isVenezuela" data-translate-es="Venezuela" data-translate-en="Venezuela">Venezuela</label>

                      <!-- Radio button para Extranjero -->
                      <input 
                        type="radio" class="mr-2" id="isNotVenezuela" x-bind:value="false" x-model="isVenezuela" name="donde_empresa" <?php echo !$dataCompanyProfile['is_venezuela'] ? 'checked' : ''; ?>>
                      <label class="text-sm font-medium text-gray-700" for="isNotVenezuela" data-translate-es="Extranjero" data-translate-en="Abroad">Extranjero</label>
                  </div>
              </div>
            </div>
            <div x-show=" isVenezuela == 'true' " x-transition>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- State -->
                <div class="form-group">
                  <label class="block text-sm font-medium text-gray-700 mb-1" data-translate-es="Estado" data-translate-en="State">
                    Estado
                  </label>
                  <select
                    class="form-select w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                    name="id_estado"
                    id="state_id"
                    x-bind:required="isVenezuela == 'true'">
                  </select>
                </div>

                <!-- Municipality -->
                <div class="form-group">
                  <label class="block text-sm font-medium text-gray-700 mb-1" data-translate-es="Municipio" data-translate-en="Municipality">
                    Municipio
                  </label>
                  <select
                    class="form-select w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                    name="id_municipio"
                    id="municipality_id"
                    x-bind:required="isVenezuela == 'true'">
                  </select>
                </div>

                <!-- PARROQUIAS -->
                <div class="form-group">
                  <label class="block text-sm font-medium text-gray-700 mb-1" data-translate-es="Parroquia" data-translate-en="Parroquia">
                    Parroquia
                  </label>
                  <select
                    class="form-select w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                    name="id_parroquia"
                    id="parroquia_id"
                    x-bind:required="isVenezuela == 'true'">
                  </select>
                </div>

                <!-- City o localidad --> 
                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700 mb-1" data-translate-es="Ciudad o localidad" data-translate-en="City or locality">
                      Ciudad o localidad
                    </label>
                    <input
                      type="text"
                      class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                      name="ciudad"
                      id="ciudad"
                      value="<?php echo $dataCompanyProfile['ciudad']; ?>"
                      x-bind:required="isVenezuela == 'true'">
                    </input>
                </div>
              </div>
            </div>

            <div x-show=" isVenezuela == 'false' " x-transition>
              <div class="form-group">
                <label class="block text-sm font-medium text-gray-700 mb-1" data-translate-es="Localidad, País" data-translate-en="Locality, Country">
                  Localidad, País
                </label>
                <input
                  type="text"
                  placeholder="Ejm: San Francisco, USA"
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                  name="localidad"
                  id="localidad"
                  value="<?php echo $dataCompanyProfile['location']; ?>"
                  x-bind:required="isVenezuela == 'false'">
                </input>
              </div>
            </div>

            <div class="form-group col-span-1 md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1" data-translate-es="Dirección Completa" data-translate-en="Complete Address">
                  Dirección Completa</label
                >
                <textarea
                    placeholder="Ingrese la dirección completa de la empresa"
                    required
                    name="complete_address"
                    id="complete_address"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                    ><?php echo htmlspecialchars(trim($dataCompanyProfile['complete_address'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></textarea>
              </div>

              <div class="form-group col-span-1 md:col-span-2">
                <button type="submit" class="theme-btn btn-style-one save-btn" data-translate-es="Guardar" data-translate-en="Save" id="save-address">
                  Guardar
                </button>
              </div>
          </form>
        </div>

        <!-- Social Network Section -->
        <div
          class="bg-white rounded-lg shadow-sm p-6 mb-6 border border-gray-200"
        >
          <div class="widget-title mb-6">
            <h4 class="text-lg font-medium text-gray-700" data-translate-es="Redes Sociales" data-translate-en="Social Network">Redes Sociales</h4>
          </div>

          <form id="social-form" class="default-form">
            <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-2 gap-6">
              <div class="form-group col-span-1">
                <label class="block text-sm font-medium text-gray-700 mb-1"
                  >Facebook</label
                >
                <input
                  placeholder="https://www.facebook.com/mercadotrabajo"
                  type="url"
                  name="facebook"
                  id="facebook"
                  value="<?php echo htmlspecialchars(trim($dataCompanyProfile['social_facebook'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>"
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                />
              </div>

              <div class="form-group col-span-1">
                <label class="block text-sm font-medium text-gray-700 mb-1"
                  >Twitter (X.com)</label
                >
                <input
                  placeholder="https://x.com/mercadotrabajo"
                  type="url"
                  name="twitter"
                  id="twitter"
                  value="<?php echo htmlspecialchars(trim($dataCompanyProfile['social_x'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>"
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                />
              </div>

              <div class="form-group col-span-1">
                <label class="block text-sm font-medium text-gray-700 mb-1"
                  >LinkedIn</label
                >
                <input
                  placeholder="https://www.linkedin.com/company/mercadotrabajo"
                  type="url"
                  name="linkedin"
                  id="linkedin"
                  value="<?php echo htmlspecialchars(trim($dataCompanyProfile['social_linkedin'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>"
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                />
              </div>
            </div>
            <div class="form-group mt-4">
              <button type="submit" class="theme-btn btn-style-one save-btn" >
                Save
              </button>
            </div>
          </form>
        </div>
      </div>
    </section>
</main>

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

      //Load data estados from api: /api/v1/getestados
      async function loadEstados(){
        const response = await fetch('<?php echo SYSTEM_BASE_DIR ?>api/v1/getestados');
        const data = await response.json();
        const select = document.getElementById('state_id');

        if (data.success){
          const option = document.createElement('option');
            option.value = "";
            option.textContent = "Seleccionar estado";
            select.appendChild(option);

          data.estados.forEach(state => {
            const option = document.createElement('option');
            option.value = state.id_estado;
            option.textContent = state.estado;
            select.appendChild(option);

            if (state.id_estado == <?php echo $dataCompanyProfile['id_estado']; ?>) {
              option.selected = true;
              loadMunicipios(state.id_estado);
            }
          });
        } else {
          const option = document.createElement('option');
          option.value = "";
          option.textContent = "Error al cargar los estados";
          select.appendChild(option);
        }
      }


      //load data municipios
      async function loadMunicipios(id_estado) {
        const response = await fetch('<?php echo SYSTEM_BASE_DIR ?>api/v1/getmunicipios/'+id_estado);
        const data = await response.json();
        const select = document.getElementById('municipality_id');

        if (data.success){
          const option = document.createElement('option');
            option.value = "";
            option.textContent = "Seleccionar municipio";
            select.appendChild(option);

          data.municipios.forEach(municipio => {
            const option = document.createElement('option');
            option.value = municipio.id_municipio;
            option.textContent = municipio.municipio;
            select.appendChild(option);

            if (municipio.id_municipio == <?php echo $dataCompanyProfile['id_municipio']; ?>) {
              option.selected = true;
              loadParroquias(municipio.id_municipio);
            }
          });
        } else {
          const option = document.createElement('option');
          option.value = "";
          option.textContent = "Error al cargar los municipios";
          select.appendChild(option);
        }
      }

      //load data parroquias
      async function loadParroquias(id_municipio) {
        const response = await fetch('<?php echo SYSTEM_BASE_DIR ?>api/v1/getparroquias/'+id_municipio);
        const data = await response.json();
        const select = document.getElementById('parroquia_id');

        if (data.success){
          const option = document.createElement('option');
            option.value = "";
            option.textContent = "Seleccionar parroquia";
            select.appendChild(option);

          data.parroquias.forEach(parroquia => {
            const option = document.createElement('option');
            option.value = parroquia.id_parroquia;
            option.textContent = parroquia.parroquia;
            select.appendChild(option);

            if (parroquia.id_parroquia == <?php echo $dataCompanyProfile['id_parroquia']; ?>) {
              option.selected = true;
            }
          });
        } else {
          const option = document.createElement('option');
          option.value = "";
          option.textContent = "Error al cargar las parroquias";
          select.appendChild(option);
        }
      }


      //Carga de municipios dependiendo del id del estado
      const selectEstado = document.getElementById('state_id');
      selectEstado.addEventListener("change", async function(){
        const id_estado = selectEstado.value;
        const selectMunicipio = document.getElementById('municipality_id');
        const selectParroquia = document.getElementById('parroquia_id');
        selectMunicipio.innerHTML = "";
        selectParroquia.innerHTML = "";
        await loadMunicipios(id_estado);
      })

      //Carga de parroquias dependiendo del id del municipio
      const selectMunicipio = document.getElementById('municipality_id');
      selectMunicipio.addEventListener("change", async function(){
        const id_municipio = selectMunicipio.value;
        const selectParroquia = document.getElementById('parroquia_id');
        selectParroquia.innerHTML = "";
        await loadParroquias(id_municipio);
      })
      
      // Manejo del área de carga de imagen
      const imageUploadArea = document.querySelector(".image-upload-area");
      const fileInput = document.getElementById("logo-upload");
      let uploadedFile = null;

      imageUploadArea.addEventListener("click", function () {
        fileInput.click();
      });

      fileInput.addEventListener("change", function (e) {
        if (e.target.files.length > 0) {
          const file = e.target.files[0];
          uploadedFile = file;
          const reader = new FileReader();

          reader.onload = function (e) {
            // Crear una vista previa de la imagen
            const preview = document.createElement("img");
            preview.src = e.target.result;
            preview.classList.add("w-32", "h-32", "object-cover", "rounded-md");

            // Limpiar el área de carga y agregar la vista previa
            imageUploadArea.innerHTML = "";
            imageUploadArea.appendChild(preview);

            // Agregar botón para eliminar la imagen
            const removeButton = document.createElement("p");
            removeButton.innerHTML = 'Hacer clic sobre la imagen para cambiar';
            removeButton.classList.add(
              "absolute",
              "top-2",
              "right-2",
              "bg-white",
              "rounded-full",
              "p-1",
              "shadow-sm",
              "text-gray-500",
              "hover:text-gray-700"
            );

            removeButton.addEventListener("click", function (e) {
              e.stopPropagation();
              fileInput.value = "";
              uploadedFile = null;
              resetImageUploadArea();
            });

            imageUploadArea.classList.add("relative");
            imageUploadArea.appendChild(removeButton);
            lucide.createIcons(); // Reinicializar iconos para el nuevo botón
          };

          reader.readAsDataURL(file);
        }
      });

      function resetImageUploadArea() {
        imageUploadArea.innerHTML = `
        <i data-lucide="upload" class="w-8 h-8 text-gray-400 mb-2"></i>
        <p class="text-sm text-gray-500 font-medium">Browse Logo</p>
      `;
        imageUploadArea.classList.remove("relative");
        lucide.createIcons();
      }

      // Function to save profile data
      async function saveProfileData(formId) {
        const form = document.getElementById(formId);
        const submitBtn = form.querySelector(".save-btn");
        const originalText = submitBtn.textContent;
        const action = "save_" + formId;

        submitBtn.textContent = "Sending information...";
        submitBtn.disabled = true;

        try {
          const profileData = {};

          // Collect form data
          const formData = new FormData(form);
          for (const [key, value] of formData.entries()) {
            profileData[key] = value;
          }

          

          // Crear un nuevo FormData para enviar la acción y los datos
          const finalFormData = new FormData();
          finalFormData.append("action", action);
          finalFormData.append("data", JSON.stringify(profileData));
          // Add logo if uploaded
          if (uploadedFile) {
            //profileData.logo_path = `/uploads/${uploadedFile.name}`;
            finalFormData.append("logo", uploadedFile);
          }

          const response = await fetch(
            "<?php echo SYSTEM_BASE_DIR ?>api/v1/setdataprofilecompany",
            {
              method: "POST",
              body: finalFormData, // Enviar el FormData final
            }
          );

          if (!response.ok) {
            const errorData = await response.json();
            throw new Error(
              errorData.message ||
                `Failed to save profile data. Status: ${response.status}`
            );
          }

          const result = await response.json();
          console.log(result);

          if (result.success) {
            showToast("Profile data saved successfully");
          } else {
            throw new Error(result.message || "Failed to save profile data");
          }
        } catch (error) {
          console.error("Error saving profile data:", error);
          showToast("Failed to save profile data: " + error.message, "error");
        } finally {
          submitBtn.textContent = originalText;
          submitBtn.disabled = false;
        }
      }
      

      // Load logo image company
      function loadLogoImage() {
        const imageUploadArea = document.querySelector(".image-upload-area");
        const image = imageUploadArea.getAttribute("data-image");
        if (image) {
          const img = document.createElement("img");
          img.src = image;
          img.classList.add("w-32", "h-32", "object-cover", "rounded-md");
          imageUploadArea.innerHTML = "";
          imageUploadArea.appendChild(img);
          imageUploadArea.classList.add("relative");
          const removeButton = document.createElement("p");
          removeButton.innerHTML = 'Hacer clic sobre la imagen para cambiar';
          removeButton.classList.add(
            "absolute",
            "top-2",
            "right-2",
            "bg-white",
            "rounded-full",
            "p-1",
            "shadow-sm",
            "text-gray-500",
            "hover:text-gray-700",
            "z-1"
          );
          removeButton.addEventListener("click", function (e) {
            e.stopPropagation();
            document.getElementById("logo-upload").value = "";
            resetImageUploadArea();
          });
          imageUploadArea.appendChild(removeButton);
        }
      }

      // Form submission handlers
      document.addEventListener("DOMContentLoaded", function () {

        //Cargar estados
        loadEstados();

        // Load logo image company
        loadLogoImage();

        // Profile form submission
        document
          .getElementById("profile-form")
          .addEventListener("submit", function (e) {
            e.preventDefault();
            saveProfileData("profile-form");
          });

        // Contact form submission
        document
          .getElementById("contact-form")
          .addEventListener("submit", function (e) {
            e.preventDefault();
            saveProfileData("contact-form");
          });

        // Social form submission
        document
          .getElementById("social-form")
          .addEventListener("submit", function (e) {
            e.preventDefault();
            saveProfileData("social-form");
          });
      });
    </script>

<?php
  include_once 'views/company/footer.php';
?>
