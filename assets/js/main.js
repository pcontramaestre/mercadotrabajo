document.addEventListener('DOMContentLoaded', function () {
  // Inicializar AOS (Animate On Scroll)
  applyAos();
  
  // Detectar el idioma del navegador
  let userLang = navigator.language || navigator.userLanguage;
  let isSpanish = userLang.startsWith('es');

  const languageItems = document.querySelectorAll('.language-item'); 
  languageItems.forEach(item => {
    item.addEventListener('click', function () {
      // Obtener el valor del atributo data-translate
      const language = this.querySelector('span').dataset.translate;

      // Guardar el idioma en localStorage
      localStorage.setItem('selectedLanguage', language);

      applyLanguage(language); 
    });
  });

  // Función para aplicar la traducción (opcional)
  function applyLanguage(lang) {
    changeLanguage(lang);
  }

  // Función para obtener el idioma guardado en localStorage al cargar la página
  function getStoredLanguage() {
    const storedLanguage = localStorage.getItem('selectedLanguage');
    if (storedLanguage) {
      applyLanguage(storedLanguage); // Aplicar el idioma guardado
    } else {
      changeLanguage();
    }
  }

  getStoredLanguage(); 

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

      // Aplicar la traducción al atributo value para los select
      if (element.tagName === 'SELECT') {
        element.options.forEach(option => {
          const translationKey = isSpanish ? 'data-translate-es' : 'data-translate-en';
          const translation = option.getAttribute(translationKey);
          option.textContent = translation;
        });
      }
    });
  }

  // Función para inicializar AOS
  function applyAos() {
    if (typeof AOS !== 'undefined') {
      //detectar si el tamańio de la pantalla es menor a 768px, si es menor, no inicializar AOS
      if (window.innerWidth < 768) {
        //buscar todos los elemento con data-aos y eliminar el atributo
        const elements = document.querySelectorAll('[data-aos]');
        elements.forEach(element => {
          element.removeAttribute('data-aos');
        });
        //buscar elementos con las clases de AOS y eliminarlas
        const aosElements = document.querySelectorAll('.aos-init, .aos-animate');
        aosElements.forEach(element => {
          element.classList.remove('aos-init', 'aos-animate');
        });
        return;
      }
      AOS.init();
    }
  }
});

document.addEventListener('scroll', function() {
  const header = document.querySelector('.main-header.header-style-two.alternate');
  
  if (window.scrollY > 0) {
      // Si el scroll es mayor a 0, agregamos las clases
      header.classList.add('fixed-header', 'animated', 'fadeIn');
  } else {
      // Si el scroll está en el top, eliminamos las clases
      header.classList.remove('fixed-header', 'animated', 'fadeIn');
  }
});