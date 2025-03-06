document.addEventListener('DOMContentLoaded', function () {
  // Inicializar AOS (Animate On Scroll)
  AOS.init();
  

  // Detectar el idioma del navegador
  let userLang = navigator.language || navigator.userLanguage;
  let isSpanish = userLang.startsWith('es');


  changeLanguage();
  // Seleccionar los elementos <li> de los idiomas
  const languageItems = document.querySelectorAll('.language-item'); // Asegúrate de añadir la clase language-item a tus <li>

  // Agregar un evento de clic a cada elemento
  languageItems.forEach(item => {
    item.addEventListener('click', function () {
      // Obtener el valor del atributo data-translate
      const language = this.querySelector('span').dataset.translate;

      // Guardar el idioma en localStorage
      localStorage.setItem('selectedLanguage', language);

      // Opcional: Recargar la página o aplicar la traducción inmediatamente
      // location.reload(); // Recargar la página para aplicar la traducción
      applyLanguage(language); // Función para aplicar la traducción sin recargar
    });
  });

    // Función para aplicar la traducción (opcional)
    function applyLanguage(lang) {
      // Aquí puedes implementar la lógica para aplicar la traducción según el idioma seleccionado
      console.log('Idioma seleccionado:', lang);
      // Por ejemplo, puedes llamar a la función changeLanguage() que tienes
      changeLanguage(lang);
    }

      // Función para obtener el idioma guardado en localStorage al cargar la página
    function getStoredLanguage() {
      const storedLanguage = localStorage.getItem('selectedLanguage');
      if (storedLanguage) {
        applyLanguage(storedLanguage); // Aplicar el idioma guardado
      }
    }

    getStoredLanguage(); // Llamar a la función al cargar la página



  function changeLanguage(lang) {
    if (lang) {
      userLang = lang;
      isSpanish = userLang.startsWith('es');
    }
    // Seleccionar todos los elementos con atributos de traducción
    const elements = document.querySelectorAll('[data-translate-es], [data-translate-en]');

    // Iterar sobre cada elemento para aplicar la traducción
    elements.forEach(element => {
      // Determinar el texto a usar según el idioma
      const translationKey = isSpanish ? 'data-translate-es' : 'data-translate-en';
      const translation = element.getAttribute(translationKey);

      // Aplicar la traducción según el tipo de elemento
      if (element.tagName === 'INPUT' || element.tagName === 'TEXTAREA') {
        element.placeholder = translation; // Para campos de entrada y áreas de texto
      } else {
        element.textContent = translation; // Para cualquier otro tipo de elemento
      }
    });
  }
});


document.addEventListener('scroll', function() {
  const header = document.querySelector('.main-header.header-style-two.alternate');
  
  if (window.scrollY > 0) {
      // Si el scroll es mayor a 0, agregamos las clases
      header.classList.add('fixed-header', 'animated', 'slideInDown');
  } else {
      // Si el scroll está en el top, eliminamos las clases
      header.classList.remove('fixed-header', 'animated', 'slideInDown');
  }
});