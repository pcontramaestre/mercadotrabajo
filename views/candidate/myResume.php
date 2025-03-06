
<?php
  include_once 'config/config.php';
  include_once 'views/candidate/header.php';
?>
  
  <!-- Main Content -->
<main class="flex-1 md:ml-64 md:pl-0 pl-0 pt-16 md:pt-0">
    <div class="max-w-6xl mx-auto">
      <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800">My Resume!</h1>
        <p class="text-gray-500 mt-1">Ready to jump back in?</p>
      </div>
      
      <!-- Resume Content -->
      <div>
        <!-- <h2 class="text-lg font-semibold mb-6">My profile</h2> -->
        
        <!-- CV Selection -->
        <!-- <div class="mb-6">
          <label for="cv-select" class="block text-sm font-medium text-gray-700 mb-1">Select Your CV</label>
          <div class="relative">
            <select 
              id="cv-select" 
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 bg-gray-50 appearance-none custom-select"
            >
              <option>My CV</option>
              <option>Professional CV</option>
              <option>Creative CV</option>
            </select>
          </div>
        </div> -->
        
        <!-- Description -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6 shadow border">
          <div class="mb-8">
          <h3 class="text-lg font-medium text-gray-700 flex flex-row items-center"><i data-lucide="user-round-pen" class="w-5 h-5 mr-2"></i> Resume Summary</h3>
            <div class="bg-gray-50 p-4 rounded-md">
              <textarea 
                id="resume-description"
                placeholder="Resume Summary, enter here a summary of your skills, abilities and why you are good at your job"
                class="w-full bg-gray-50 text-sm text-gray-600 leading-relaxed border-0 focus:ring-0 p-0"
                rows="6"
              ></textarea>
            </div>
            <!-- Save Button -->
            <div class="mt-8">
              <button 
                id="save-changes-btn" 
                type="button" 
                class="px-6 py-3 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
              >
                Save resume summary
              </button>
            </div>
          </div>
        </div>
        
        <!-- Education Section -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6 shadow border">
          <div class="mb-8">
            <div class="flex justify-between items-center mb-4">
              <h3 class="text-lg font-medium text-gray-700 flex flex-row items-center"><i data-lucide="book-open-text" class="w-5 h-5 mr-2"></i> Education</h3>
              <button id="add-education-btn" class="flex items-center text-sm font-medium text-blue-600 hover:text-blue-700">
                <i data-lucide="plus-circle" class="w-5 h-5 mr-1"></i>
                Add Education
              </button>
            </div>
            
            <div id="education-list">
              <!-- Education Item -->
              
            </div>
          </div>
          </div>
        <!-- Work & Experience Section -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6 shadow border">
          <div class="mb-8">
            <div class="flex justify-between items-center mb-4">
              <h3 class="text-lg font-medium text-gray-700 flex flex-row items-center"><i data-lucide="briefcase" class="w-5 h-5 mr-2"></i> Work & Experience</h3>
              <button id="add-experience-btn" class="flex items-center text-sm font-medium text-blue-600 hover:text-blue-700">
                <i data-lucide="plus-circle" class="w-5 h-5 mr-1"></i>
                Add Experience
              </button>
            </div>
            
            <div id="experience-list">
              <!-- Will be populated with experience items -->
            </div>
          </div>
        </div>
        
        <!-- Awards Section -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6 shadow border">
          <div class="mb-8">
            <div class="flex justify-between items-center mb-4">
              <h3 class="text-lg font-medium text-gray-700 flex flex-row items-center"><i data-lucide="award" class="w-5 h-5 mr-2"></i> Awards</h3>
              <h3 class="text-md font-medium text-gray-700">Awards</h3>
              <button id="add-award-btn" class="flex items-center text-sm font-medium text-blue-600 hover:text-blue-700">
                <i data-lucide="plus-circle" class="w-5 h-5 mr-1"></i>
                Add Award
              </button>
            </div>
            
            <div id="awards-list">
              <!-- Will be populated with award items -->
            </div>
          </div>
        </div>
        <!-- Skills Section -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6 shadow border">
          <div class="mb-8">
            <div class="flex justify-between items-center mb-4">
              <h3 class="text-lg font-medium text-gray-700 flex flex-row items-center"><i data-lucide="clipboard-check" class="w-5 h-5 mr-2"></i> Skills</h3>
              <button id="add-skill-btn" class="flex items-center text-sm font-medium text-blue-600 hover:text-blue-700">
                <i data-lucide="plus-circle" class="w-5 h-5 mr-1"></i>
                Add Skill
              </button>
            </div>
            
            <div id="skills-list">
              <!-- Will be populated with skill items -->
            </div>
          </div>
        </div>
        
        
      </div>
    </div>
  </main>
  
  <!-- Education Modal -->
  <div id="education-modal" class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md mx-4">
      <div class="p-6">
        <div class="flex justify-between items-center mb-4">
          <h3 class="text-lg font-medium text-gray-900">Add Education</h3>
          <button id="close-education-modal" class="text-gray-400 hover:text-gray-500">
            <i data-lucide="x" class="w-5 h-5"></i>
          </button>
        </div>
        
        <form id="education-form">
          <input type="hidden" id="education-id" value="">
          
          <div class="mb-4">
            <label for="degree" class="block text-sm font-medium text-gray-700 mb-1">Degree</label>
            <input 
              type="text" 
              id="degree" 
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
              placeholder="e.g. Bachelor of Science"
              required
            >
          </div>
          
          <div class="mb-4">
            <label for="institution" class="block text-sm font-medium text-gray-700 mb-1">Institution</label>
            <input 
              type="text" 
              id="institution" 
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
              placeholder="e.g. Harvard University"
              required
            >
          </div>
          
          <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
              <label for="start-year" class="block text-sm font-medium text-gray-700 mb-1">Start Year</label>
              <input 
                type="text" 
                id="start-year" 
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                placeholder="e.g. 2010"
                required
              >
            </div>
            <div>
              <label for="end-year" class="block text-sm font-medium text-gray-700 mb-1">End Year</label>
              <input 
                type="text" 
                id="end-year" 
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                placeholder="e.g. 2014"
                required
              >
            </div>
          </div>
          
          <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea 
              id="description" 
              rows="3" 
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
              placeholder="Brief description of your studies and achievements"
            ></textarea>
          </div>
          
          <div class="flex justify-end mt-6">
            <button 
              type="button" 
              id="cancel-education-btn"
              class="px-4 py-2 bg-gray-100 text-gray-700 font-medium rounded-md mr-2 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
            >
              Cancel
            </button>
            <button 
              type="submit" 
              class="px-4 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
            >
              Save
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  
  <!-- Experience Modal -->
  <div id="experience-modal" class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md mx-4">
      <div class="p-6">
        <div class="flex justify-between items-center mb-4">
          <h3 class="text-lg font-medium text-gray-900">Add Experience</h3>
          <button id="close-experience-modal" class="text-gray-400 hover:text-gray-500">
            <i data-lucide="x" class="w-5 h-5"></i>
          </button>
        </div>
        
        <form id="experience-form">
          <input type="hidden" id="experience-id" value="">
          
          <div class="mb-4">
            <label for="job-title" class="block text-sm font-medium text-gray-700 mb-1">Job Title</label>
            <input 
              type="text" 
              id="job-title" 
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
              placeholder="e.g. Software Engineer"
              required
            >
          </div>
          
          <div class="mb-4">
            <label for="company" class="block text-sm font-medium text-gray-700 mb-1">Company</label>
            <input 
              type="text" 
              id="company" 
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
              placeholder="e.g. Google"
              required
            >
          </div>
          
          <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
              <label for="exp-start-date" class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
              <input 
                type="text" 
                id="exp-start-date" 
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                placeholder="e.g. Jan 2018"
                required
              >
            </div>
            <div>
              <label for="exp-end-date" class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
              <input 
                type="text" 
                id="exp-end-date" 
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                placeholder="e.g. Present"
                required
              >
            </div>
          </div>
          
          <div class="mb-4">
            <label for="exp-description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea 
              id="exp-description" 
              rows="3" 
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
              placeholder="Brief description of your responsibilities and achievements"
            ></textarea>
          </div>
          
          <div class="flex justify-end mt-6">
            <button 
              type="button" 
              id="cancel-experience-btn"
              class="px-4 py-2 bg-gray-100 text-gray-700 font-medium rounded-md mr-2 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
            >
              Cancel
            </button>
            <button 
              type="submit" 
              class="px-4 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
            >
              Save
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  
  <!-- Award Modal -->
  <div id="award-modal" class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md mx-4">
      <div class="p-6">
        <div class="flex justify-between items-center mb-4">
          <h3 class="text-lg font-medium text-gray-900">Add Award</h3>
          <button id="close-award-modal" class="text-gray-400 hover:text-gray-500">
            <i data-lucide="x" class="w-5 h-5"></i>
          </button>
        </div>
        
        <form id="award-form">
          <input type="hidden" id="award-id" value="">
          
          <div class="mb-4">
            <label for="award-title" class="block text-sm font-medium text-gray-700 mb-1">Award Title</label>
            <input 
              type="text" 
              id="award-title" 
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
              placeholder="e.g. Best Developer Award"
              required
            >
          </div>
          
          <div class="mb-4">
            <label for="award-organization" class="block text-sm font-medium text-gray-700 mb-1">Organization</label>
            <input 
              type="text" 
              id="award-organization" 
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
              placeholder="e.g. Tech Conference"
              required
            >
          </div>
          
          <div class="mb-4">
            <label for="award-year" class="block text-sm font-medium text-gray-700 mb-1">Year</label>
            <input 
              type="text" 
              id="award-year" 
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
              placeholder="e.g. 2020"
              required
            >
          </div>
          
          <div class="mb-4">
            <label for="award-description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea 
              id="award-description" 
              rows="3" 
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
              placeholder="Brief description of the award and its significance"
            ></textarea>
          </div>
          
          <div class="flex justify-end mt-6">
            <button 
              type="button" 
              id="cancel-award-btn"
              class="px-4 py-2 bg-gray-100 text-gray-700 font-medium rounded-md mr-2 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
            >
              Cancel
            </button>
            <button 
              type="submit" 
              class="px-4 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
            >
              Save
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  
  <!-- Skill Modal -->
  <div id="skill-modal" class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md mx-4">
      <div class="p-6">
        <div class="flex justify-between items-center mb-4">
          <h3 class="text-lg font-medium text-gray-900">Add Skill</h3>
          <button id="close-skill-modal" class="text-gray-400 hover:text-gray-500">
            <i data-lucide="x" class="w-5 h-5"></i>
          </button>
        </div>
        
        <form id="skill-form">
          <input type="hidden" id="skill-id" value="">
          
          <div class="mb-4">
            <label for="skill-name" class="block text-sm font-medium text-gray-700 mb-1">Skill Name</label>
            <input 
              type="text" 
              id="skill-name" 
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
              placeholder="e.g. JavaScript"
              required
            >
          </div>
          
          <div class="mb-4">
            <label for="skill-level" class="block text-sm font-medium text-gray-700 mb-1">Skill Level (%)</label>
            <input 
              type="range" 
              id="skill-level" 
              min="0" 
              max="100" 
              value="75" 
              class="w-full"
            >
            <div class="flex justify-between text-xs text-gray-500">
              <span>Beginner</span>
              <span id="skill-level-value">75%</span>
              <span>Expert</span>
            </div>
          </div>
          
          <div class="flex justify-end mt-6">
            <button 
              type="button" 
              id="cancel-skill-btn"
              class="px-4 py-2 bg-gray-100 text-gray-700 font-medium rounded-md mr-2 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
            >
              Cancel
            </button>
            <button 
              type="submit" 
              class="px-4 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
            >
              Save
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  
  <!-- Delete Confirmation Modal -->
  <div id="delete-modal" class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md mx-4">
      <div class="p-6">
        <div class="flex justify-between items-center mb-4">
          <h3 class="text-lg font-medium text-gray-900">Confirm Delete</h3>
          <button id="close-delete-modal" class="text-gray-400 hover:text-gray-500">
            <i data-lucide="x" class="w-5 h-5"></i>
          </button>
        </div>
        
        <p class="text-gray-600 mb-6">Are you sure you want to delete this item? This action cannot be undone.</p>
        
        <div class="flex justify-end">
          <button 
            type="button" 
            id="cancel-delete-btn"
            class="px-4 py-2 bg-gray-100 text-gray-700 font-medium rounded-md mr-2 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
          >
            Cancel
          </button>
          <button 
            type="button" 
            id="confirm-delete-btn"
            class="px-4 py-2 bg-red-600 text-white font-medium rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
          >
            Delete
          </button>
        </div>
      </div>
    </div>
  </div>
  
  <script>
    // Inicializar los iconos de Lucide
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

    // Datos de ejemplo
    let educationData = [];
    let experienceData = [];
    let awardsData = [];
    let skillsData = [];
    
    // Variables para el seguimiento de elementos a eliminar
    let currentDeleteType = '';
    let currentDeleteId = null;
    
    // Funciones para mostrar/ocultar modales
    function showModal(modalId) {
      document.getElementById(modalId).classList.remove('hidden');
      document.body.style.overflow = 'hidden';
    }
    
    function hideModal(modalId) {
      document.getElementById(modalId).classList.add('hidden');
      document.body.style.overflow = 'auto';
    }
    
    // Función para generar iniciales
    function getInitials(name) {
      //return name.split(' ').map(word => word[0]).join('').toUpperCase();
    return name.split(' ').map(word => word[0]).join('').toUpperCase().substring(0, 3);
    }
    
    // Función para generar un color aleatorio para los avatares
    function getRandomColor() {
      const colors = [
        'bg-red-100 text-red-600',
        'bg-blue-100 text-blue-600',
        'bg-green-100 text-green-600',
        'bg-yellow-100 text-yellow-600',
        'bg-purple-100 text-purple-600',
        'bg-indigo-100 text-indigo-600'
      ];
      return colors[Math.floor(Math.random() * colors.length)];
    }
    
    // Renderizar elementos de educación
    function renderEducationItems() {
      const educationList = document.getElementById('education-list');
      educationList.innerHTML = '';
      
      educationData.forEach(item => {
        const initials = getInitials(item.institution);
        const colorClass = getRandomColor();
        
        const educationItem = document.createElement('div');
        educationItem.className = 'education-item border border-gray-200 rounded-md p-4 mb-4 relative';
        educationItem.innerHTML = `
          <div class="flex items-start">
            <div class="w-10 h-10 ${colorClass} rounded-full flex items-center justify-center font-medium mr-4">
              ${initials}
            </div>
            <div class="flex-1">
              <div class="flex flex-wrap justify-between mb-2">
                <div>
                  <h4 class="text-md font-medium">${item.degree}</h4>
                  <p class="text-sm text-gray-500">${item.institution}</p>
                </div>
                <div>
                  <span class="bg-red-50 text-red-600 text-xs font-medium px-2 py-1 rounded">${item.start_year} - ${item.end_year}</span>
                </div>
              </div>
              <p class="text-sm text-gray-600 mb-2">
                ${item.description}
              </p>
              <div class="flex space-x-2">
                <button class="edit-education-btn p-1 text-blue-600 hover:text-blue-800" data-id="${item.id}">
                  <i data-lucide="edit-2" class="w-4 h-4"></i>
                </button>
                <button class="delete-education-btn p-1 text-gray-600 hover:text-gray-800" data-id="${item.id}">
                  <i data-lucide="trash-2" class="w-4 h-4"></i>
                </button>
              </div>
            </div>
          </div>
        `;
        
        educationList.appendChild(educationItem);
        
        // Reinicializar los iconos de Lucide para los nuevos elementos
        lucide.createIcons({
          icons: {
            'edit-2': educationItem.querySelectorAll('[data-lucide="edit-2"]'),
            'trash-2': educationItem.querySelectorAll('[data-lucide="trash-2"]')
          }
        });
      });
      
      // Agregar event listeners a los botones de editar y eliminar
      document.querySelectorAll('.edit-education-btn').forEach(btn => {
        btn.addEventListener('click', function() {
          const id = parseInt(this.getAttribute('data-id'));
          editEducation(id);
        });
      });
      
      document.querySelectorAll('.delete-education-btn').forEach(btn => {
        btn.addEventListener('click', function() {
          const id = parseInt(this.getAttribute('data-id'));
          confirmDelete('education', id);
        });
      });
    }
    
    // Renderizar elementos de experiencia
    function renderExperienceItems() {
      const experienceList = document.getElementById('experience-list');
      experienceList.innerHTML = '';
      
      if (experienceData.length === 0) {
        experienceList.innerHTML = '<p class="text-center text-gray-500 py-4">No experience added yet. Click "Add Experience" to add your work history.</p>';
        return;
      }
      
      experienceData.forEach(item => {
        const initials = getInitials(item.company);
        const colorClass = getRandomColor();
        
        const experienceItem = document.createElement('div');
        experienceItem.className = 'education-item border border-gray-200 rounded-md p-4 mb-4 relative';
        experienceItem.innerHTML = `
          <div class="flex items-start">
            <div class="w-10 h-10 ${colorClass} rounded-full flex items-center justify-center font-medium mr-4">
              ${initials}
            </div>
            <div class="flex-1">
              <div class="flex flex-wrap justify-between mb-2">
                <div>
                  <h4 class="text-md font-medium">${item.jobTitle}</h4>
                  <p class="text-sm text-gray-500">${item.company}</p>
                </div>
                <div>
                  <span class="bg-blue-50 text-blue-600 text-xs font-medium px-2 py-1 rounded">${item.startDate} - ${item.endDate}</span>
                </div>
              </div>
              <p class="text-sm text-gray-600 mb-2">
                ${item.description}
              </p>
              <div class="flex space-x-2">
                <button class="edit-experience-btn p-1 text-blue-600 hover:text-blue-800" data-id="${item.id}">
                  <i data-lucide="edit-2" class="w-4 h-4"></i>
                </button>
                <button class="delete-experience-btn p-1 text-gray-600 hover:text-gray-800" data-id="${item.id}">
                  <i data-lucide="trash-2" class="w-4 h-4"></i>
                </button>
              </div>
            </div>
          </div>
        `;
        
        experienceList.appendChild(experienceItem);
        
        // Reinicializar los iconos de Lucide para los nuevos elementos
        lucide.createIcons({
          icons: {
            'edit-2': experienceItem.querySelectorAll('[data-lucide="edit-2"]'),
            'trash-2': experienceItem.querySelectorAll('[data-lucide="trash-2"]')
          }
        });
      });
      
      // Agregar event listeners a los botones de editar y eliminar
      document.querySelectorAll('.edit-experience-btn').forEach(btn => {
        btn.addEventListener('click', function() {
          const id = parseInt(this.getAttribute('data-id'));
          editExperience(id);
        });
      });
      
      document.querySelectorAll('.delete-experience-btn').forEach(btn => {
        btn.addEventListener('click', function() {
          const id = parseInt(this.getAttribute('data-id'));
          confirmDelete('experience', id);
        });
      });
    }
    
    // Renderizar elementos de premios
    function renderAwardItems() {
      const awardsList = document.getElementById('awards-list');
      awardsList.innerHTML = '';
      
      if (awardsData.length === 0) {
        awardsList.innerHTML = '<p class="text-center text-gray-500 py-4">No awards added yet. Click "Add Award" to add your achievements.</p>';
        return;
      }
      
      awardsData.forEach(item => {
        const initials = getInitials(item.title);
        const colorClass = getRandomColor();
        
        const awardItem = document.createElement('div');
        awardItem.className = 'education-item border border-gray-200 rounded-md p-4 mb-4 relative';
        awardItem.innerHTML = `
          <div class="flex items-start">
            <div class="w-10 h-10 ${colorClass} rounded-full flex items-center justify-center font-medium mr-4">
              ${initials}
            </div>
            <div class="flex-1">
              <div class="flex flex-wrap justify-between mb-2">
                <div>
                  <h4 class="text-md font-medium">${item.title}</h4>
                  <p class="text-sm text-gray-500">${item.organization}</p>
                </div>
                <div>
                  <span class="bg-yellow-50 text-yellow-600 text-xs font-medium px-2 py-1 rounded">${item.year}</span>
                </div>
              </div>
              <p class="text-sm text-gray-600 mb-2">
                ${item.description}
              </p>
              <div class="flex space-x-2">
                <button class="edit-award-btn p-1 text-blue-600 hover:text-blue-800" data-id="${item.id}">
                  <i data-lucide="edit-2" class="w-4 h-4"></i>
                </button>
                <button class="delete-award-btn p-1 text-gray-600 hover:text-gray-800" data-id="${item.id}">
                  <i data-lucide="trash-2" class="w-4 h-4"></i>
                </button>
              </div>
            </div>
          </div>
        `;
        
        awardsList.appendChild(awardItem);
        
        // Reinicializar los iconos de Lucide para los nuevos elementos
        lucide.createIcons({
          icons: {
            'edit-2': awardItem.querySelectorAll('[data-lucide="edit-2"]'),
            'trash-2': awardItem.querySelectorAll('[data-lucide="trash-2"]')
          }
        });
      });
      
      // Agregar event listeners a los botones de editar y eliminar
      document.querySelectorAll('.edit-award-btn').forEach(btn => {
        btn.addEventListener('click', function() {
          const id = parseInt(this.getAttribute('data-id'));
          editAward(id);
        });
      });
      
      document.querySelectorAll('.delete-award-btn').forEach(btn => {
        btn.addEventListener('click', function() {
          const id = parseInt(this.getAttribute('data-id'));
          confirmDelete('award', id);
        });
      });
    }
    
    // Renderizar elementos de habilidades
    function renderSkillItems() {
      const skillsList = document.getElementById('skills-list');
      skillsList.innerHTML = '';
      
      if (skillsData.length === 0) {
        skillsList.innerHTML = '<p class="text-center text-gray-500 py-4">No skills added yet. Click "Add Skill" to add your skills.</p>';
        return;
      }
      
      const skillsContainer = document.createElement('div');
      skillsContainer.className = 'grid grid-cols-1 md:grid-cols-2 gap-4';
      
      skillsData.forEach(item => {
        const skillItem = document.createElement('div');
        skillItem.className = 'border border-gray-200 rounded-md p-4 relative';
        skillItem.innerHTML = `
          <div class="flex justify-between items-center mb-2">
            <h4 class="text-md font-medium">${item.name}</h4>
            <div class="flex space-x-2">
              <button class="edit-skill-btn p-1 text-blue-600 hover:text-blue-800" data-id="${item.id}">
                <i data-lucide="edit-2" class="w-4 h-4"></i>
              </button>
              <button class="delete-skill-btn p-1 text-gray-600 hover:text-gray-800" data-id="${item.id}">
                <i data-lucide="trash-2" class="w-4 h-4"></i>
              </button>
            </div>
          </div>
          <div class="w-full bg-gray-200 rounded h-2.5">
            <div class="bg-gradient-to-r from-amber-300 to-emerald-900 h-2.5 rounded" style="width: ${item.level}%"></div>
          </div>
          <div class="flex justify-between mt-1">
            <span class="text-xs text-gray-500">Beginner</span>
            <span class="text-xs font-medium">${item.level}%</span>
            <span class="text-xs text-gray-500">Expert</span>
          </div>
        `;
        
        skillsContainer.appendChild(skillItem);
      });
      
      skillsList.appendChild(skillsContainer);
      
      // Reinicializar los iconos de Lucide para los nuevos elementos
      lucide.createIcons();
      
      // Agregar event listeners a los botones de editar y eliminar
      document.querySelectorAll('.edit-skill-btn').forEach(btn => {
        btn.addEventListener('click', function() {
          const id = parseInt(this.getAttribute('data-id'));
          editSkill(id);
        });
      });
      
      document.querySelectorAll('.delete-skill-btn').forEach(btn => {
        btn.addEventListener('click', function() {
          const id = parseInt(this.getAttribute('data-id'));
          confirmDelete('skill', id);
        });
      });
    }
    
    // Renderizar description
    function renderDescription(){
      const resumeDescription = document.getElementById('resume-description');
      resumeDescription.innerHTML = '';
      if (descriptionData.length === 0) {
        return;
      } else {
        descriptionData.forEach(item => {
            resumeDescription.innerHTML = item.description;
        });
      }
    }

    // Funciones para editar elementos
    function editEducation(id) {
      const education = educationData.find(item => item.id === id);
      if (!education) return;
      
      document.getElementById('education-id').value = education.id;
      document.getElementById('degree').value = education.degree;
      document.getElementById('institution').value = education.institution;
      document.getElementById('start-year').value = education.start_year;
      document.getElementById('end-year').value = education.end_year;
      document.getElementById('description').value = education.description;
      
      showModal('education-modal');
    }
    
    function editExperience(id) {
      const experience = experienceData.find(item => item.id === id);
      if (!experience) return;
      
      document.getElementById('experience-id').value = experience.id;
      document.getElementById('job-title').value = experience.jobTitle;
      document.getElementById('company').value = experience.company;
      document.getElementById('exp-start-date').value = experience.startDate;
      document.getElementById('exp-end-date').value = experience.endDate;
      document.getElementById('exp-description').value = experience.description;
      
      showModal('experience-modal');
    }
    
    function editAward(id) {
      const award = awardsData.find(item => item.id === id);
      if (!award) return;
      
      document.getElementById('award-id').value = award.id;
      document.getElementById('award-title').value = award.title;
      document.getElementById('award-organization').value = award.organization;
      document.getElementById('award-year').value = award.year;
      document.getElementById('award-description').value = award.description;
      
      showModal('award-modal');
    }
    
    function editSkill(id) {
      const skill = skillsData.find(item => item.id === id);
      if (!skill) return;
      
      document.getElementById('skill-id').value = skill.id;
      document.getElementById('skill-name').value = skill.name;
      document.getElementById('skill-level').value = skill.level;
      document.getElementById('skill-level-value').textContent = skill.level + '%';
      
      showModal('skill-modal');
    }
    
    // Función para confirmar eliminación
    function confirmDelete(type, id) {
      currentDeleteType = type;
      currentDeleteId = id;
      console.log(currentDeleteType);
      console.log(currentDeleteId)
      showModal('delete-modal');

    }
    
    // Función para eliminar elemento
    function deleteItem() {
      if (!currentDeleteType || !currentDeleteId) return;
      
      // Mostrar indicador de carga
      const deleteBtn = document.getElementById('confirm-delete-btn');
      const originalText = deleteBtn.textContent;
      deleteBtn.textContent = 'Deleting...';
      deleteBtn.disabled = true;
      
      deleteItemFromServer(currentDeleteType, currentDeleteId)
        .then(response => {
          if (response.success) {
            // Actualizar la interfaz de usuario después de eliminar en el servidor
            switch (currentDeleteType) {
              case 'education':
                //educationData = educationData.filter(item => item.id !== currentDeleteId);
                //renderEducationItems();
                loadResumeData();
                break;
              case 'experience':
                //experienceData = experienceData.filter(item => item.id !== currentDeleteId);
                //renderExperienceItems();
                loadResumeData();
                break;
              case 'award':
                //awardsData = awardsData.filter(item => item.id !== currentDeleteId);
                //renderAwardItems();
                loadResumeData();
                break;
              case 'skill':
                //skillsData = skillsData.filter(item => item.id !== currentDeleteId);
                //renderSkillItems();
                loadResumeData();
                break;
            }
            
            hideModal('delete-modal');
            showToast("Item "+currentDeleteType+" deleted");
            currentDeleteType = '';
            currentDeleteId = null;
          } else {
            showToast('Error deleting item:' + (response.message || 'Unknown error'), "error");
            //alert('Error deleting item: ' + (response.message || 'Unknown error'));
          }
        })
        .catch(error => {
          console.error('Error:', error);
          showToast("Error deleting item. Please try again.", "error");
          //alert('Error deleting item. Please try again.');
        })
        .finally(() => {
          // Restaurar el botón
          deleteBtn.textContent = originalText;
          deleteBtn.disabled = false;
        });
    }
    
    // Función para generar un ID único
    function generateId(array) {
      if (array.length === 0) return 1;
      return Math.max(...array.map(item => item.id)) + 1;
    }
    
    // Event Listeners
    document.addEventListener('DOMContentLoaded', function() {
      // Cargar datos desde el servidor
      loadResumeData();
      
      // Botones para mostrar modales
      document.getElementById('add-education-btn').addEventListener('click', function() {
        document.getElementById('education-form').reset();
        document.getElementById('education-id').value = '';
        showModal('education-modal');
      });
      
      document.getElementById('add-experience-btn').addEventListener('click', function() {
        document.getElementById('experience-form').reset();
        document.getElementById('experience-id').value = '';
        showModal('experience-modal');
      });
      
      document.getElementById('add-award-btn').addEventListener('click', function() {
        document.getElementById('award-form').reset();
        document.getElementById('award-id').value = '';
        showModal('award-modal');
      });
      
      document.getElementById('add-skill-btn').addEventListener('click', function() {
        document.getElementById('skill-form').reset();
        document.getElementById('skill-id').value = '';
        document.getElementById('skill-level').value = 75;
        document.getElementById('skill-level-value').textContent = '75%';
        showModal('skill-modal');
      });
      
      // Botones para cerrar modales
      document.getElementById('close-education-modal').addEventListener('click', function() {
        hideModal('education-modal');
      });
      
      document.getElementById('cancel-education-btn').addEventListener('click', function() {
        hideModal('education-modal');
      });
      
      document.getElementById('close-experience-modal').addEventListener('click', function() {
        hideModal('experience-modal');
      });
      
      document.getElementById('cancel-experience-btn').addEventListener('click', function() {
        hideModal('experience-modal');
      });
      
      document.getElementById('close-award-modal').addEventListener('click', function() {
        hideModal('award-modal');
      });
      
      document.getElementById('cancel-award-btn').addEventListener('click', function() {
        hideModal('award-modal');
      });
      
      document.getElementById('close-skill-modal').addEventListener('click', function() {
        hideModal('skill-modal');
      });
      
      document.getElementById('cancel-skill-btn').addEventListener('click', function() {
        hideModal('skill-modal');
      });
      
      document.getElementById('close-delete-modal').addEventListener('click', function() {
        hideModal('delete-modal');
      });
      
      document.getElementById('cancel-delete-btn').addEventListener('click', function() {
        hideModal('delete-modal');
      });
      
      document.getElementById('confirm-delete-btn').addEventListener('click', deleteItem);
      
      // Actualizar valor del nivel de habilidad en tiempo real
      document.getElementById('skill-level').addEventListener('input', function() {
        document.getElementById('skill-level-value').textContent = this.value + '%';
      });
      
      // Manejar envío de formularios
      document.getElementById('education-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;
        submitBtn.textContent = 'Saving...';
        submitBtn.disabled = true;
        
        const id = document.getElementById('education-id').value;
        const newEducation = {
          id: id ? parseInt(id) : null,
          degree: document.getElementById('degree').value,
          institution: document.getElementById('institution').value,
          startYear: document.getElementById('start-year').value,
          endYear: document.getElementById('end-year').value,
          description: document.getElementById('description').value
        };
        
        saveEducation(newEducation)
          .then(response => {
            if (response.success) {
              if (id) {
                // Actualizar educación existente
                const index = educationData.findIndex(item => item.id === parseInt(id));
                if (index !== -1) {
                  educationData[index] = { ...newEducation, id: parseInt(id) };
                }
              } else {
                // Agregar nueva educación con el ID generado por el servidor
                educationData.push({
                  ...newEducation,
                  id: response.id
                });
              }
              
              //renderEducationItems();
              loadResumeData();
              hideModal('education-modal');
              showToast("Education item added or edit");
            } else {
              showToast('Error saving education: ' + (response.message || 'Unknown error'), "error");
              //alert('Error saving education: ' + (response.message || 'Unknown error'));
            }
          })
          .catch(error => {
            console.error('Error:', error);
            showToast("Error saving education. Please try again.", "error");
            //alert('Error saving education. Please try again.');
          })
          .finally(() => {
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;
          });
      });
      
      document.getElementById('experience-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;
        submitBtn.textContent = 'Saving...';
        submitBtn.disabled = true;
        
        const id = document.getElementById('experience-id').value;
        const newExperience = {
          id: id ? parseInt(id) : null,
          jobTitle: document.getElementById('job-title').value,
          company: document.getElementById('company').value,
          startDate: document.getElementById('exp-start-date').value,
          endDate: document.getElementById('exp-end-date').value,
          description: document.getElementById('exp-description').value
        };
        
        saveExperience(newExperience)
          .then(response => {
            if (response.success) {
              if (id) {
                // Actualizar experiencia existente
                const index = experienceData.findIndex(item => item.id === parseInt(id));
                if (index !== -1) {
                  experienceData[index] = { ...newExperience, id: parseInt(id) };
                }
              } else {
                // Agregar nueva experiencia con el ID generado por el servidor
                experienceData.push({
                  ...newExperience,
                  id: response.id
                });
              }
              
              //renderExperienceItems();
              loadResumeData();
              hideModal('experience-modal');
              showToast("Expecience item added or edit");
            } else {
              showToast('Error saving education: ' + (response.message || 'Unknown error'), "error");
              //alert('Error saving experience: ' + (response.message || 'Unknown error'));
            }
          })
          .catch(error => {
            console.error('Error:', error);
            showToast("Error saving experience. Please try again.", "error");
            //alert('Error saving experience. Please try again.');
          })
          .finally(() => {
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;
          });
      });
      
      document.getElementById('award-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;
        submitBtn.textContent = 'Saving...';
        submitBtn.disabled = true;
        
        const id = document.getElementById('award-id').value;
        const newAward = {
          id: id ? parseInt(id) : null,
          title: document.getElementById('award-title').value,
          organization: document.getElementById('award-organization').value,
          year: document.getElementById('award-year').value,
          description: document.getElementById('award-description').value
        };
        
        saveAward(newAward)
          .then(response => {
            if (response.success) {
              if (id) {
                // Actualizar premio existente
                const index = awardsData.findIndex(item => item.id === parseInt(id));
                if (index !== -1) {
                  awardsData[index] = { ...newAward, id: parseInt(id) };
                }
              } else {
                // Agregar nuevo premio con el ID generado por el servidor
                awardsData.push({
                  ...newAward,
                  id: response.id
                });
              }
              
              //renderAwardItems();
              loadResumeData();
              hideModal('award-modal');
              showToast("Award item added or edit");
            } else {
              alert('Error saving award: ' + (response.message || 'Unknown error'));
            }
          })
          .catch(error => {
            console.error('Error:', error);
            alert('Error saving award. Please try again.');
          })
          .finally(() => {
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;
          });
      });
      
      document.getElementById('skill-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;
        submitBtn.textContent = 'Saving...';
        submitBtn.disabled = true;
        
        const id = document.getElementById('skill-id').value;
        const newSkill = {
          id: id ? parseInt(id) : null,
          name: document.getElementById('skill-name').value,
          level: document.getElementById('skill-level').value
        };
        
        saveSkill(newSkill)
          .then(response => {
            if (response.success) {
              if (id) {
                // Actualizar habilidad existente
                const index = skillsData.findIndex(item => item.id === parseInt(id));
                if (index !== -1) {
                  skillsData[index] = { ...newSkill, id: parseInt(id) };
                }
              } else {
                // Agregar nueva habilidad con el ID generado por el servidor
                skillsData.push({
                  ...newSkill,
                  id: response.id
                });
              }
              
              renderSkillItems();
              hideModal('skill-modal');
              showToast("Skill item added or edit");
            } else {
              alert('Error saving skill: ' + (response.message || 'Unknown error'));
            }
          })
          .catch(error => {
            console.error('Error:', error);
            alert('Error saving skill. Please try again.');
          })
          .finally(() => {
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;
          });
      });
    });
    
    // Agregar estas funciones para cargar datos desde el servidor PHP:
    // Función para cargar todos los datos del CV desde el servidor
    function loadResumeData() {
      fetch('<?php echo SYSTEM_BASE_DIR ?>api/v1/getdatacandidate')
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }
          return response.json();
        })
        .then(data => {
          // Actualizar los arrays de datos con la información del servidor
          educationData = data.education || [];
          experienceData = data.experience || [];
          awardsData = data.awards || [];
          skillsData = data.skills || [];
          descriptionData = data.user_profile || [];
          
          // Renderizar todos los elementos
          renderEducationItems();
          renderExperienceItems();
          renderAwardItems();
          renderSkillItems();
          renderDescription();
        })
        .catch(error => {
          console.error('Error loading resume data:', error);
          // Si hay un error, mostrar un mensaje al usuario
          alert('Error loading your resume data. Please try refreshing the page.');
        });
    }
    
    // Función para guardar un elemento de educación
    function saveEducation(educationItem) {
      // Validar datos antes de enviar
      if (!educationItem || !educationItem.institution) {
        return Promise.reject(new Error('Datos de educación incompletos'));
      }

      const formData = new FormData();
      formData.append('action', 'save_education');
      formData.append('data', JSON.stringify(educationItem));
      
      // Configuración de la petición con timeout
      const controller = new AbortController();
      const timeoutId = setTimeout(() => controller.abort(), 15000); // 15 segundos de timeout
      
      // Función para reintentar la petición
      const fetchWithRetry = (url, options, retries = 3, delay = 1000) => {
        return fetch(url, options)
          .then(response => {
            clearTimeout(timeoutId);
            
            // Manejar diferentes tipos de errores HTTP
            if (!response.ok) {
              const statusCode = response.status;
              
              // Manejar errores específicos según el código de estado
              if (statusCode === 401) {
                throw new Error('No autorizado. Por favor inicie sesión nuevamente.');
              } else if (statusCode === 403) {
                throw new Error('No tiene permisos para realizar esta acción.');
              } else if (statusCode === 404) {
                throw new Error('El recurso solicitado no existe.');
              } else if (statusCode === 500) {
                throw new Error('Error interno del servidor. Intente más tarde.');
              } else {
                throw new Error(`Error en la respuesta del servidor: ${statusCode}`);
              }
            }
            
            // Verificar que la respuesta sea JSON válido
            return response.json().catch(() => {
              throw new Error('La respuesta no es un JSON válido');
            });
          })
          .then(data => {
            // Verificar si hay errores en la respuesta del servidor
            if (data.error) {
              throw new Error(data.error);
            }
            return data;
          })
          .catch(error => {
            // Si es un error de timeout, abortar
            if (error.name === 'AbortError') {
              throw new Error('La solicitud ha excedido el tiempo de espera');
            }
            
            // Para errores de red, reintentar si quedan reintentos
            if ((error.message.includes('network') || error.message.includes('failed')) && retries > 0) {
              return new Promise(resolve => {
                setTimeout(() => resolve(fetchWithRetry(url, options, retries - 1, delay * 1.5)), delay);
              });
            }
            
            throw error;
          });
      };
      
      return fetchWithRetry('<?php echo SYSTEM_BASE_DIR ?>api/v1/setdatacandidate', {
        method: 'POST',
        body: formData,
        signal: controller.signal
      })
      .then(data => {
        // Mostrar mensaje de éxito si es necesario
        console.log('Datos guardados correctamente:', data);
        return data;
      })
      .catch(error => {
        // Registrar el error y relanzarlo para que se maneje en el nivel superior
        console.error('Error al guardar datos de educación:', error);
        
        // Mostrar mensaje de error al usuario si es necesario
        // Ejemplo: mostrarNotificacion(error.message, 'error');
        
        throw error; // Relanzar para manejo adicional en el nivel superior
      });
    }
    
    // Función para guardar un elemento de experiencia
    function saveExperience(experienceItem) {
      const formData = new FormData();
      formData.append('action', 'save_experience');
      formData.append('data', JSON.stringify(experienceItem));
      
      return fetch('<?php echo SYSTEM_BASE_DIR ?>api/v1/setdatacandidate', {
        method: 'POST',
        body: formData
      })
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      });
    }
    
    // Función para guardar un premio
    function saveAward(awardItem) {
      const formData = new FormData();
      formData.append('action', 'save_award');
      formData.append('data', JSON.stringify(awardItem));
      
      return fetch('<?php echo SYSTEM_BASE_DIR ?>api/v1/setdatacandidate', {
        method: 'POST',
        body: formData
      })
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      });
    }
    
    // Función para guardar una habilidad
    function saveSkill(skillItem) {
      const formData = new FormData();
      formData.append('action', 'save_skill');
      formData.append('data', JSON.stringify(skillItem));
      
      return fetch('<?php echo SYSTEM_BASE_DIR ?>api/v1/setdatacandidate', {
        method: 'POST',
        body: formData
      })
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      });
    }
    
    // Función para eliminar un elemento
    function deleteItemFromServer(type, id) {
      const formData = new FormData();
      formData.append('action', 'delete_item');
      formData.append('type', type);
      formData.append('id', id);
      return fetch('<?php echo SYSTEM_BASE_DIR ?>api/v1/setdatacandidate', {
        method: 'POST',
        body: formData
      })
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      });
    }
    
    // Función para guardar la descripción general
    function saveDescription(description) {
      const formData = new FormData();
      formData.append('action', 'save_description');
      formData.append('description', description);
      
      return fetch('<?php echo SYSTEM_BASE_DIR ?>api/v1/setdatacandidate', {
        method: 'POST',
        body: formData
      })
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      });
    }
    
    // Agregar un event listener para guardar la descripción
    document.getElementById('save-changes-btn').addEventListener('click', function() {
      const description = document.getElementById('resume-description').value;
      console.log("Esto es una prueba");
      console.log(description)
      this.textContent = 'Saving...';
      this.disabled = true;
      
      saveDescription(description)
        .then(response => {
          if (response.success) {
            alert('Resume saved successfully!');
          } else {
            alert('Error saving resume: ' + (response.message || 'Unknown error'));
          }
        })
        .catch(error => {
          console.error('Error:', error);
          alert('Error saving resume. Please try again.');
        })
        .finally(() => {
          this.textContent = 'Save Changes';
          this.disabled = false;
        });
    });
    
  </script>

<?php
  include_once 'views/candidate/footer.php';
?>