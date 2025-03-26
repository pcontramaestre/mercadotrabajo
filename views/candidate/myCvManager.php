<?php
if (empty($_SESSION['user_id']) || $_SESSION['role_id'] != 2) {
    echo "Acceso denegado. Por favor, inicia sesión.";
    die(); // Detener la ejecución del script
}
include_once 'config/config.php';

include_once 'views/candidate/header.php';
?>


<main class="flex-1 md:ml-64 md:pl-0 pl-0 pt-16 md:pt-0">
    <section class="user-dashboard p-6">
        <div class="dashboard-outer max-w-6xl mx-auto">
            <div class="upper-title-box">
                <h1 class="text-2xl font-bold text-gray-800">Mis hojas de vida</h1>
                <p class="text-gray-500 mt-1">En esta sección puedes gestionar tus hojas de vida, subir nuevas, eliminar o editar las existentes.</p>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-6 border border-gray-200 mt-6">
                        <div class="widget-title">
                            <h4>Subir hoja de vida</h4>
                        </div>
                        <div class="widget-content">
                            <!-- Upload Section -->
                            <div class="uploading-resume">
                                <div class="uploadButton">
                                    <input
                                        class="uploadButton-input"
                                        accept=".doc,.docx,application/pdf"
                                        id="upload"
                                        multiple
                                        type="file"
                                        name="attachments[]"
                                        style="display: none;"
                                        onchange="handleFileUpload(event)" />
                                    <label class="cv-uploadButton" for="upload">
                                        <span class="title">Subir archivos</span>
                                        <span class="text"
                                            data-translate-en="To upload file size is (Max 1MB), allowed file 
                                            types are (.doc, .docx, .pdf). Max 4 CV, The file name must be unique"
                                            data-translate-es="El tamaño del archivo a cargar es (máximo 1 MB), los tipos de archivo permitidos 
                                            son (.doc, .docx, .pdf). Máximo 4 CV, el nombre del archivo debe ser único"
                                        >El tamaño del archivo a subir es de (máximo 1 MB). Los tipos de archivo permitidos son (.doc, .docx, .pdf). Máximo 4 CV. El nombre del archivo debe ser único.</span>
                                        <span class="theme-btn btn-style-one"
                                            data-translate-en="Upload Resume"
                                            data-translate-es="Subir Curriculum"
                                        >Subir Curriculum</span>
                                    </label>
                                    <span class="uploadButton-file-name"></span>
                                </div>
                            </div>
                            <div id="upload-progress" class="hidden">
                                <div class="spinner"></div>
                                <span>Uploading files...</span>
                            </div>

                            <!-- Uploaded Files List -->
                            <div class="files-outer grid lg:grid-cols-4 gap-4 md:grid-cols-2 sm:grid-cols-2 p-4" id="uploaded-files">
                                <!-- Files will be dynamically added here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        loadFiles(); // Cargar archivos existentes
    });

    // Maximum number of files allowed
    const MAX_FILES = 4;
    // Maximum file size in bytes (1MB)
    const MAX_FILE_SIZE = 1 * 1024 * 1024;


    function loadFiles() {
        fetch('<?php echo SYSTEM_BASE_DIR ?>api/v1/getdatacandidate')
            .then(response => response.json())
            .then(data => {
                const uploadedFilesContainer = document.getElementById('uploaded-files');
                uploadedFilesContainer.innerHTML = '';
                
                if (data.success && data.cvs) {
                    data.cvs.forEach(cv => {
                        addFileToUI(cv.filename, cv.id, cv.path); // Mostrar archivos del servidor
                    });
                }
            })
            .catch(error => {
                console.error('Error loading files:', error);
                showToast('Error loading your files. Please refresh the page.', 'error');
            });
    }

    // Handle file upload
    let tempFiles = []; // Variable para almacenar archivos temporalmente

    // Modificar la función para subir archivos inmediatamente
    function handleFileUpload(event) {
        const files = event.target.files;
        const uploadedFilesContainer = document.getElementById('uploaded-files');

        // Verificar cantidad máxima de archivos (4)
        const existingFiles = uploadedFilesContainer.querySelectorAll('.file-edit-box').length;
        if (existingFiles + files.length > MAX_FILES) {
            showToast(`You can only upload up to ${MAX_FILES} files.`, 'error');
            return;
        }

        // Validar y procesar cada archivo
        const validFiles = [];
        Array.from(files).forEach((file) => {
            // Validar tipo de archivo
            const allowedTypes = [
                'application/msword',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'application/pdf'
            ];
            if (!allowedTypes.includes(file.type)) {
                showToast(`Invalid file type: ${file.name}. Only .doc, .docx, and .pdf files are allowed.`, 'error');
                return;
            }

            // Validar tamaño
            if (file.size > MAX_FILE_SIZE) {
                showToast(`File too large: ${file.name}. Maximum file size is 1MB.`, 'error');
                return;
            }

            validFiles.push(file);
        });

        if (validFiles.length === 0) {
            return; // No hay archivos válidos
        }

        // Mostrar spinner
        const uploadProgress = document.getElementById('upload-progress');
        uploadProgress.classList.remove('hidden');

        // Enviar archivos al servidor
        sendFilesToServer(validFiles);
    }

    // Add a file to the UI
    // Solo se llama desde loadFiles (archivos confirmados en el servidor)
    function addFileToUI(filename, serverId, path) {
        const uploadedFilesContainer = document.getElementById('uploaded-files');
        const fileEditBox = document.createElement('div');
        fileEditBox.classList.add('file-edit-box');
        fileEditBox.classList.add('p-4');
        fileEditBox.classList.add('w-full');
        fileEditBox.dataset.id = serverId; // ID del servidor
        pathFile = path;

        fileEditBox.innerHTML = `
            <span class="title break-all">${filename}</span>
            <div class="edit-btns">
                <a href="<?php echo SYSTEM_BASE_DIR ?>${pathFile}" target="_blank" onclick="downloadFile(this.href)">
                    <i class="fas fa-download"></i>
                </a>
                <button onclick="deleteFile(this)">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </div>
        `;

        uploadedFilesContainer.appendChild(fileEditBox);
    }

    // Download a file
    function downloadFile(path) {
        //target blank open path
        window.open(path, '_blank');
    }


    // Rename a file (placeholder for now)
    function renameFile(button) {
        const fileEditBox = button.closest('.file-edit-box');
        const fileNameElement = fileEditBox.querySelector('.title');
        const newName = prompt('Enter new file name:', fileNameElement.textContent);

        if (newName) {
            fileNameElement.textContent = newName;
        }
    }

    // Delete a file from the UI
    function deleteFile(button) {
        const fileEditBox = button.closest('.file-edit-box');
        const fileId = fileEditBox.dataset.id;

        if (!fileId) {
            // Si no hay ID, es un archivo pendiente (no subido)
            fileEditBox.remove();
            return;
        }

        const formData = new FormData();
        formData.append('action', 'delete_file');
        formData.append('file_id', fileId);

        fetch('<?php echo SYSTEM_BASE_DIR ?>api/v1/setdatacandidate', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    fileEditBox.remove();
                    showToast('File deleted successfully!', 'success');
                } else {
                    showToast('Error deleting file: ' + (data.message || 'Unknown error'), 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error deleting file. Please try again.', 'error');
            });
    }

    // Send files to the server (to be implemented later)
    function sendFilesToServer(validFiles) {
        const formData = new FormData();
        formData.append('action', 'add_file');

        validFiles.forEach((file) => {
            formData.append('attachments[]', file);
        });

        fetch('<?php echo SYSTEM_BASE_DIR ?>api/v1/setdatacandidate', {
                method: 'POST',
                body: formData,
            })
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    showToast('Resumes uploaded successfully!', 'success');
                    loadFiles(); // Actualizar la lista desde el servidor
                } else {
                    showToast('Error: ' + (data.message || 'Unknown error'), 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error uploading resumes. Please try again.', 'error');
            })
            .finally(() => {
                // Ocultar spinner y limpiar input
                document.getElementById('upload').value = '';
                document.getElementById('upload-progress').classList.add('hidden');
            });
    }
</script>

<?php
include_once 'views/candidate/footer.php';
?>