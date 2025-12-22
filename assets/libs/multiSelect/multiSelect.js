function initMultiSelect(selectElement,options = {}) {
    const { 
      inputClass = "w-full relative px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#27C195]",
      optionsContinerClass = "hidden border border-gray-300 bg-white absolute w-full z-[1] rounded-b-[10px] p-[10px]",
      labelInputClass = "peer-focus:font-medium absolute text-sm text-[#526270] duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-[#4D4E8D] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6",
      errorLabelInputClass = "text_error pl-2 italic",
      placeholder = "",
      labelText = "",
      noResults  = "Sin resultados",
      placeholderSearch = "",
      onChange = null, // function(value, checked, optionElement, checkboxElement, selectElement)
    } = options;
  
    const id = selectElement.id;
    selectElement.style.display = 'none'; 
  
    // Crear el contenedor principal
    const container = document.createElement('div');
    container.classList.add('multiselect-container','w-full','relative');
  
    // Crear el campo de búsqueda
    const inputShow = document.createElement('input');
    
    inputShow.type = 'text';
    inputShow.placeholder = placeholder;
    inputShow.classList = `search-input ${inputClass}`;
    inputShow.readOnly = "readOnly";
    container.appendChild(inputShow);
  
    const labelInput = document.createElement('label');
    const errorLabelInput = document.createElement('small');
  
    labelInput.textContent = labelText;
  
    labelInput.classList = labelInputClass;
  
    errorLabelInput.classList = errorLabelInputClass; 
    errorLabelInput.id = `${id}_message`;
  
    container.appendChild(labelInput);
    container.appendChild(errorLabelInput);
   
    const optionsContainer = document.createElement('div');
    const listOptions = document.createElement('div');
    listOptions.classList = "max-h-[200px] overflow-y-auto";
    optionsContainer.classList= `options ${optionsContinerClass}`;
    optionsContainer.appendChild(listOptions);
    container.appendChild(optionsContainer);
  
    const searchInput = document.createElement('input');
    searchInput.placeholder = placeholder;
    listOptions.appendChild(searchInput);
    
    searchInput.className = "w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:outline-none block px-2 py-1 border-2 border-[#125FBA] rounded-2xl p-2";
    
    Array.from(selectElement.options).filter(option => option.value != "").forEach(option => { 
      const label = document.createElement('label');
      const checkbox = document.createElement('input');
      label.classList = "px-2 pt-2 flex gap-4 cursor-pointer";
      checkbox.type = 'checkbox';
      checkbox.value = option.value; 
    
      checkbox.checked = option.selected; 
      // Sincronizar el valor seleccionado con el <select> original
      checkbox.addEventListener('change', () => {
        option.selected = checkbox.checked; 
        updateContent(selectElement,inputShow);
        // Llamada al callback con el valor nuevo y el estado (true = seleccionado, false = deseleccionado).
        if (typeof onChange === 'function') {
          try {
            onChange(checkbox.value, checkbox.checked, option, checkbox, selectElement);
          } catch (e) {
            // evitar que un error en el callback rompa el control
            console.error('multiSelect onChange callback error:', e);
          }
        }
      });
  
      label.appendChild(checkbox);
      label.appendChild(document.createTextNode(option.textContent));
      listOptions.appendChild(label); 
    });
  
    const label = document.createElement('label');
    label.innerHTML = noResults;
    label.id = "noResults";
    label.classList = "px-2 py-6 text-center block text-gray-500";
    label.style.display = "none";
  
    listOptions.appendChild(label); 
    // Insertar el contenedor del multiselect después del <select> original
    selectElement.parentNode.insertBefore(container, selectElement.nextSibling);
  
    // Mostrar y ocultar el menú desplegable
    inputShow.addEventListener('focus', () => {
      optionsContainer.style.display = 'block';
    });
  
    document.addEventListener('click', (event) => {
      if (!container.contains(event.target)) {
        optionsContainer.style.display = 'none';
      }
    });
    // Filtrar opciones según la búsqueda
    searchInput.addEventListener('input', () => {
      const filter = searchInput.value.toLowerCase();
      // iterar sobre los hijos reales (labels) dentro de listOptions
      Array.from(listOptions.children).forEach(child => {
        // omitir el input de búsqueda
        if (child.tagName && child.tagName.toLowerCase() === 'input') return;
        // omitir el label de "noResults" al mostrar/ocultar opciones
        if (child.id === 'noResults') return;
        const text = child.textContent.toLowerCase();
        child.style.display = text.includes(filter) ? 'block' : 'none';
      });
  
      // comprobar si hay opciones visibles (excluyendo input y noResults)
      const anyVisible = Array.from(listOptions.children).some(child => {
        if (child.tagName && child.tagName.toLowerCase() === 'input') return false;
        if (child.id === 'noResults') return false;
        return child.style.display !== 'none';
      });
   
      container.querySelector("#noResults").style.display = anyVisible ? 'none' : 'block';
    });
  
    updateContent(selectElement,inputShow);
}
  
function updateContent(selectElement,content){
  const selected = [];

  Array.from(selectElement.options).filter(option => option.value != "").forEach(option => { 
      if(option.selected){
      selected.push(option.textContent.trim()); 
      }
  });

  content.value = selected.join(", ");
}
    
HTMLSelectElement.prototype.initMultiSelect = function(options) {
  initMultiSelect(this,options); 
};

HTMLSelectElement.prototype.getSelectedValues = function() {
  return Array.from(this.options)
      .filter(option => option.selected)
      .map(option => option.value);
};