function initSelectAutocomplete(selectElement, options = {}) {
  const {
    placeholder = "Selecciona o busca...",
    notFoundText = "No se encontraron resultados",
    inputClass = "w-full relative px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#27C195]",
    listClass = "absolute w-full bg-white border border-gray-300 rounded-md mt-1 max-h-48 overflow-y-auto z-10",
    itemClass = "px-3 py-2 cursor-pointer hover:bg-gray-100",
  } = options;

  // Ocultamos el <select> original
  selectElement.style.display = "none";

  // Contenedor
  const container = document.createElement("div");
  container.classList.add("select-autocomplete-container", "relative", "w-full");

  // Input de búsqueda
  const input = document.createElement("input");
  input.type = "text";
  input.placeholder = placeholder;
  input.className = inputClass;
  container.appendChild(input);

  // Lista desplegable
  const list = document.createElement("div");
  list.className = listClass;
  list.style.display = "none";
  container.appendChild(list);

  // Insertar el contenedor después del select
  selectElement.parentNode.insertBefore(container, selectElement.nextSibling);

  // Función para renderizar opciones
  function renderOptions(filter = "") {
    list.innerHTML = "";
    const filtered = Array.from(selectElement.options).filter(opt =>
      opt.text.toLowerCase().includes(filter.toLowerCase())
    );

    if (filtered.length === 0) {
      const notFound = document.createElement("div");
      notFound.className = itemClass + " text-gray-500 italic";
      notFound.textContent = notFoundText;
      list.appendChild(notFound);
      return;
    }

    filtered.forEach(option => {
      const item = document.createElement("div");
      item.className = itemClass;
      item.textContent = option.text;

      item.addEventListener("click", () => {
        input.value = option.text;
        selectElement.value = option.value;
        list.style.display = "none";

        // Disparar evento change del select original
        selectElement.dispatchEvent(new Event("change"));
      });

      list.appendChild(item);
    });
  }

  // Eventos del input
  input.addEventListener("focus", () => {
    renderOptions(input.value);
    list.style.display = "block";
  });

  input.addEventListener("input", () => {
    renderOptions(input.value);
    list.style.display = "block";
  });

  input.addEventListener("blur", () => {
    setTimeout(() => (list.style.display = "none"), 200);
  });

  // Inicializar valor si ya hay seleccionado
  const selected = selectElement.options[selectElement.selectedIndex];
  if (selected && selected.value) {
    input.value = selected.text;
  }
}

// 🔧 Asignar al prototipo del select
HTMLSelectElement.prototype.initAutocomplete = function (options) {
  initSelectAutocomplete(this, options);
};
  