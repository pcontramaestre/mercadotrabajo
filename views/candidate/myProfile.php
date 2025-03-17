<?php
  if (empty($_SESSION['user_id'])) {
    echo "Acceso denegado. Por favor, inicia sesión.";
    die(); // Detener la ejecución del script
  }

  include_once 'config/config.php';
  include_once 'views/candidate/header.php';
?>

<!-- Main Content -->
<main class="flex-1 md:ml-64 md:pl-0 pl-0 pt-16 md:pt-0">
    <section class="p-6">
      <div class="max-w-6xl mx-auto">
        <div class="mb-8">
          <h1 class="text-2xl font-bold text-gray-800" data-translate-es="Mi Perfil" data-translate-en="My Profile">
            Mi Perfil
          </h1>
          <p class="text-gray-500 mt-1" data-translate-es="¡Hola, bienvenido de vuelta!" data-translate-en="Ready to jump back in?">¡Hola, bienvenido de vuelta!</p>
        </div>

        <!-- Profile Content -->
        <div
          class="bg-white rounded-lg shadow-sm p-6 mb-6 border border-gray-200"
        >
          <div class="widget-title mb-6">
            <h4 class="text-lg font-medium text-gray-700" data-translate-es="Mi Perfil" data-translate-en="My Profile">
              Mi Perfil
            </h4>
          </div>

          <form id="profile-form" class="default-form" enctype="multipart/form-data">
            <!-- Logo Upload -->
            <div class="mb-6">
              <div
                class="image-upload-area flex flex-col items-center justify-center rounded-md p-6 cursor-pointer"
              >
                <input
                  type="file"
                  name="logo"
                  id="logo-upload"
                  class="hidden"
                  accept="image/jpeg, image/png, image/webp"
                />
                <i data-lucide="upload" class="w-8 h-8 text-gray-400 mb-2"></i>
                <p class="text-sm text-gray-500 font-medium" data-translate-es="Sube tu logo" data-translate-en="Upload Logo">Sube tu logo</p>
              </div>
              <p class="text-xs text-gray-500 mt-2">
                Max file size is 1MB, Minimum dimension: 330x300 And Suitable
                files are .jpg & .png
              </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div class="form-group">
                <label class="block text-sm font-medium text-gray-700 mb-1" data-translate-es="Nombre completo *" data-translate-en="Full Name *">
                  Nombre completo *
                </label>
                <input
                  placeholder="Jerome"
                  required
                  type="text"
                  name="full_name"
                  id="full_name"
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                />
              </div>

              <div class="form-group">
                <label class="block text-sm font-medium text-gray-700 mb-1" data-translate-es="Tu titulo de trabajo" data-translate-en="Job Title">
                  Tu titulo de trabajo
                </label>
                <input
                  placeholder="UI Designer"
                  required
                  type="text"
                  name="job_title"
                  id="job_title"
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                />
              </div>

              <div class="form-group">
                <label class="block text-sm font-medium text-gray-700 mb-1" data-translate-es="Teléfono" data-translate-en="Phone">
                  Teléfono
                </label>
                <input
                  placeholder="0 123 456 7890"
                  type="text"
                  name="phone"
                  id="phone"
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                />
              </div>

              <div class="form-group">
                <label class="block text-sm font-medium text-gray-700 mb-1" data-translate-es="Correo Electrónico" data-translate-en="Email address">
                Correo Electrónico *
                </label>
                <input
                  placeholder="nombre@correo.com"
                  required
                  type="email"
                  name="email_address"
                  id="email_address"
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                />
              </div>

              <div class="form-group">
                <label class="block text-sm font-medium text-gray-700 mb-1" data-translate-es="Pagina Web" data-translate-en="Website">
                  Pagina Web
                </label>
                <input
                  placeholder="https://www.mercadotrabajo.org"
                  type="url"
                  name="website"
                  id="website"
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                />
              </div>

              <div class="form-group">
                <label class="block text-sm font-medium text-gray-700 mb-1" data-translate-es="Salario Actual" data-translate-en="Current Salary">
                  Salario Actual
                </label>
                <select
                  class="form-select w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                  name="current_salary_range_id"
                  id="current_salary_range_id"
                  required
                >
                  <option value="1">0-500 K</option>
                  <option value="2">500-1000 K</option>
                  <option value="3">1000-1500 K</option>
                  <option value="4">1500-3000 K</option>
                  <option value="5">> 3000 K</option>
                </select>
              </div>

              <div class="form-group">
                <label class="block text-sm font-medium text-gray-700 mb-1" data-translate-es="Salario Esperado" data-translate-en="Expected Salary">
                  Salario Esperado
                </label>
                <select
                  class="form-select w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                  name="expected_salary_range_id"
                  id="expected_salary_range_id"
                  required
                >
                  <option value="1">0-500 K</option>
                  <option value="2">500-1000 K</option>
                  <option value="3">1000-1500 K</option>
                  <option value="4">1500-3000 K</option>
                  <option value="5">> 3000 K</option>
                </select>
              </div>

              <div class="form-group">
                <label class="block text-sm font-medium text-gray-700 mb-1" data-translate-es="Experiencia" data-translate-en="Experience">
                  Experiencia
                </label>
                <input
                  placeholder="5-10 Years"
                  required
                  type="text"
                  name="experience"
                  id="experience"
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                />
              </div>

              <div class="form-group">
                <label class="block text-sm font-medium text-gray-700 mb-1" data-translate-es="Edad" data-translate-en="Age">
                  Edad
                </label>
                <select
                  class="form-select w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                  name="age"
                  id="age"
                  required
                >
                  <option value="18-23">18 - 23 Years</option>
                  <option value="23-27">23 - 27 Years</option>
                  <option value="24-28">24 - 28 Years</option>
                  <option value="25-29">25 - 29 Years</option>
                  <option value="26-30">26 - 30 Years</option>
                  <option value="30-34">30 - 34 Years</option>
                  <option value="34-38">34 - 38 Years</option>
                  <option value=">40">> 40 Years</option>
                </select>
              </div>

              <div class="form-group">
                <label class="block text-sm font-medium text-gray-700 mb-1" data-translate-es="Niveles de Educación" data-translate-en="Education Levels">
                  Niveles de Educación
                </label>
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
                <label class="block text-sm font-medium text-gray-700 mb-1" data-translate-es="Idiomas" data-translate-en="Languages">
                  Idiomas
                </label>
                <input
                  placeholder="Español, English, Turkish"
                  required
                  type="text"
                  name="languages"
                  id="languages"
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                />
              </div>

              <!-- <div class="form-group col-span-1 md:col-span-2">
              <label class="block text-sm font-medium text-gray-700 mb-1">Categories</label>
              <div class="tag-container">
                <div class="tag">
                  <span>Digital & Creative</span>
                  <span class="tag-remove" data-value="Digital & Creative">
                    <i data-lucide="x" class="w-3 h-3"></i>
                  </span>
                </div>
                <input type="text" class="tag-input" placeholder="Add categories...">
              </div>
              <input type="hidden" name="categories" id="categories-input" value="Digital & Creative">
            </div> -->

              <div class="form-group">
                <label class="block text-sm font-medium text-gray-700 mb-1"
                  >Allow In Search & Listing</label
                >
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
                <label class="block text-sm font-medium text-gray-700 mb-1"
                  >Description</label
                >
                <textarea
                  placeholder="Insert description personal."
                  rows="6"
                  name="description"
                  id="description"
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                ></textarea>
              </div>

              <div class="form-group">
                <button type="submit" class="theme-btn btn-style-one save-btn">
                  Save
                </button>
              </div>
            </div>
          </form>
        </div>

        <!-- Contact Information Section -->
        <div
          class="bg-white rounded-lg shadow-sm p-6 mb-6 border border-gray-200"
        >
          <div class="widget-title mb-6">
            <h4 class="text-lg font-medium text-gray-700">
              Contact Information
            </h4>
          </div>

          <form id="contact-form" class="default-form">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div class="form-group">
                <label class="block text-sm font-medium text-gray-700 mb-1"
                  >Country</label
                >
                <select
                  class="form-select w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                  name="country_id"
                  id="country_id"
                  required
                >
                  <option value="1">USA</option>
                  <option value="2">Venezuela</option>
                </select>
              </div>

              <div class="form-group">
                <label class="block text-sm font-medium text-gray-700 mb-1"
                  >States</label
                >
                <select
                  class="form-select w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                  name="city_id"
                  id="city_id"
                  required
                >
                  <option value="1">Florida</option>
                  <option value="2">Tachira</option>
                </select>
              </div>

              <div class="form-group col-span-1 md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1"
                  >Complete Address</label
                >
                <input
                  placeholder="329 Queensberry Street, North Melbourne VIC 3051, Australia."
                  required
                  type="text"
                  name="complete_address"
                  id="complete_address"
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                />
              </div>

              <div class="form-group col-span-1 md:col-span-2">
                <button type="submit" class="theme-btn btn-style-one save-btn">
                  Save
                </button>
              </div>
            </div>
          </form>
        </div>

        <!-- Social Network Section -->
        <div
          class="bg-white rounded-lg shadow-sm p-6 mb-6 border border-gray-200"
        >
          <div class="widget-title mb-6">
            <h4 class="text-lg font-medium text-gray-700">Social Network</h4>
          </div>

          <form id="social-form" class="default-form">
            <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-2 gap-6">
              <div class="form-group col-span-1">
                <label class="block text-sm font-medium text-gray-700 mb-1"
                  >Facebook</label
                >
                <input
                  placeholder="https://www.facebook.com/usuario"
                  type="text"
                  name="facebook"
                  id="facebook"
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                />
              </div>

              <div class="form-group col-span-1">
                <label class="block text-sm font-medium text-gray-700 mb-1"
                  >Twitter</label
                >
                <input
                  placeholder="https://www.x.com/usuario"
                  type="text"
                  name="twitter"
                  id="twitter"
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                />
              </div>

              <div class="form-group col-span-1">
                <label class="block text-sm font-medium text-gray-700 mb-1"
                  >Linkedin</label
                >
                <input
                  placeholder="https://www.linkedin.com/in/usuario"
                  type="text"
                  name="linkedin"
                  id="linkedin"
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                />
              </div>
            </div>
            <div class="form-group mt-4">
              <button type="submit" class="theme-btn btn-style-one save-btn">
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

      // Current user ID - this would typically come from your authentication system

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

      // Function to load user profile data
      async function loadProfileData() {
        try {
          // Use the correct API endpoint
          const response = await fetch(
            `<?php echo SYSTEM_BASE_DIR ?>api/v1/getdataprofilecandidate`
          );
          if (!response.ok) {
            throw new Error("Failed to load profile data");
          }

          const data = await response.json();

          if (data.success && data.user_profile.length > 0) {
            const profile = data.user_profile[0];

            // Fill profile form
            document.getElementById("full_name").value =
              profile.full_name || "";
            document.getElementById("job_title").value =
              profile.job_title || "";
            document.getElementById("phone").value = profile.phone || "";
            document.getElementById("email_address").value =
              profile.email_address || "";
            document.getElementById("website").value = profile.website || "";
            document.getElementById("description").value =
              profile.description_profile || "";

            if (profile.current_salary_range_id) {
              document.getElementById("current_salary_range_id").value =
                profile.current_salary_range_id;
            }

            if (profile.expected_salary_range_id) {
              document.getElementById("expected_salary_range_id").value =
                profile.expected_salary_range_id;
            }

            document.getElementById("experience").value =
              profile.experience || "";

            if (profile.age) {
              document.getElementById("age").value = profile.age;
            }

            document.getElementById("education_levels").value =
              profile.education_levels || "";
            document.getElementById("languages").value =
              profile.languages || "";

            if (profile.allow_in_search_listing !== null) {
              document.getElementById("allow_in_search_listing").value =
                profile.allow_in_search_listing ? "1" : "0";
            }

            // Fill contact form
            if (profile.country_id) {
              document.getElementById("country_id").value = profile.country_id;
            }

            if (profile.city_id) {
              document.getElementById("city_id").value = profile.city_id;
            }

            document.getElementById("complete_address").value =
              profile.complete_address || "";

            // Fill social form
            document.getElementById("facebook").value = profile.facebook || "";
            document.getElementById("twitter").value = profile.twitter || "";
            document.getElementById("linkedin").value = profile.linkedin || "";

            // If there's a logo, display it
            if (profile.logo_path) {
              const imageUploadArea =
                document.querySelector(".image-upload-area");
              const preview = document.createElement("img");
              preview.src = profile.logo_path;
              preview.classList.add(
                "w-32",
                "h-32",
                "object-cover",
                "rounded-md"
              );

              imageUploadArea.innerHTML = "";
              imageUploadArea.appendChild(preview);
              imageUploadArea.classList.add("relative");

              const removeButton = document.createElement("p");
              removeButton.innerHTML =
                'Hacer clic sobre la imagen para cambiar';
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
              lucide.createIcons();
            }
          } else {
            console.warn(
              "No profile data found or error in response:",
              data.message
            );
          }
        } catch (error) {
          console.error("Error loading profile data:", error);
          showToast("Failed to load profile data", "error");
        }
      }

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
            "<?php echo SYSTEM_BASE_DIR ?>api/v1/setdataprofilecandidate",
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
      

      // Form submission handlers
      document.addEventListener("DOMContentLoaded", function () {
        // Load profile data
        loadProfileData();

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
  include_once 'views/candidate/footer.php';
?>
