function reformatDate(datetime,format = "d/m/y"){  
    let finalDate;
 
    if (typeof datetime === "string") {
        let parts = null;

        if(datetime.includes(" ")){
            parts = datetime.split(" ");
        }else if(datetime.includes("T")){ 
            parts = datetime.split("T");
        }else{
            parts = datetime.split(" ");
        }

        const dateParts = parts[0].split("-");
        if (dateParts.length === 3) {
            // Asegurarse de que los componentes de la fecha sean numéricos
            const [year, month, day] = dateParts.map(part => parseInt(part, 10));
            if(parts.length == 2){
                const [hours,min] = parts[1].split(":")
                finalDate = new Date(year, month - 1, day, hours, min);
            }else{ 
                finalDate = new Date(year, month - 1, day);
            }
        } else {
            throw new Error("El formato de fecha no es válido. Use 'YYYY-MM-DD'.");
        }
    } else if (datetime instanceof Date) {
        finalDate = datetime;
    } else {
        throw new Error("El argumento 'datetime' debe ser una cadena o un objeto Date.");
    }
 
    if (isNaN(finalDate.getTime())) {
        throw new Error("La fecha no es válida.");
    }

    let finalString = "";
    
    for(var i = 0; i < format.length; i++ ){
        switch(format[i]){
            case "y":
                finalString+= finalDate.getFullYear();
            break;
            case "Y":
                let current = new Date();
                finalString+= current.getFullYear() != finalDate.getFullYear() ? finalDate.getFullYear()  : "";
            break;
            case "m": 
                finalString+= (finalDate.getMonth()+1)  < 10 ? "0"+(finalDate.getMonth()+1) : (finalDate.getMonth()+1);
            break;
            case "M": 
                let monthsIndex = (finalDate.getMonth()+1)  < 10 ? "0"+(finalDate.getMonth()+1) : (finalDate.getMonth()+1); 
                finalString+= months[monthsIndex];
            break;
            case "d":
                finalString+= finalDate.getDate() < 10 ? "0"+finalDate.getDate() : finalDate.getDate();
            break;
            case "h": 
                finalString+= finalDate.getHours() < 10 ? "0"+finalDate.getHours() : finalDate.getHours();
            break;
            case "i":
                finalString+= finalDate.getMinutes() < 10 ? "0"+finalDate.getMinutes() : finalDate.getMinutes();
            break;
            case "s":
                finalString+= finalDate.getSeconds() < 10 ? "0"+finalDate.getSeconds() : finalDate.getSeconds();
            break;
            case "c":
                finalString+= conector;
            break;
            default:
                finalString+=format[i];
            break
        }
    }

    return finalString;
}

function createAlert(message, type = "success", persistent = false) {
    const alert = document.createElement('div');
    alert.setAttribute('role', 'alert');

    if(type == "error"){ 
        alert.className = 'rounded-bl-md shadow-[2px_2px_8px_0_#00000055] flex items-center p-4 mb-4 text-red-800 border-t-4 border-red-300 bg-red-50 opacity-0 transform scale-90 transition-all duration-500 ml-4';
        alert.innerHTML = `
            <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  fill="currentColor"  class="flex-shrink-0 w-5 h-5"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 2c5.523 0 10 4.477 10 10s-4.477 10 -10 10s-10 -4.477 -10 -10s4.477 -10 10 -10m3.6 5.2a1 1 0 0 0 -1.4 .2l-2.2 2.933l-2.2 -2.933a1 1 0 1 0 -1.6 1.2l2.55 3.4l-2.55 3.4a1 1 0 1 0 1.6 1.2l2.2 -2.933l2.2 2.933a1 1 0 0 0 1.6 -1.2l-2.55 -3.4l2.55 -3.4a1 1 0 0 0 -.2 -1.4" /></svg>
            <div class="ms-3 text-sm font-medium pr-10">${message}</div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text_error rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 aria-label="Close">
                <span class="sr-only">Dismiss</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>`;
    }else if(type == "success"){
        alert.className = 'rounded-bl-md shadow-[2px_2px_8px_0_#00000055] flex items-center p-4 mb-4 text-emerald-800 border-t-4 border-emerald-300 bg-emerald-50 opacity-0 transform scale-90 transition-all duration-500 ml-4';
        alert.innerHTML = `
            <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  fill="currentColor"  class="flex-shrink-0 w-5 h-5"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12.01 2.011a3.2 3.2 0 0 1 2.113 .797l.154 .145l.698 .698a1.2 1.2 0 0 0 .71 .341l.135 .008h1a3.2 3.2 0 0 1 3.195 3.018l.005 .182v1c0 .27 .092 .533 .258 .743l.09 .1l.697 .698a3.2 3.2 0 0 1 .147 4.382l-.145 .154l-.698 .698a1.2 1.2 0 0 0 -.341 .71l-.008 .135v1a3.2 3.2 0 0 1 -3.018 3.195l-.182 .005h-1a1.2 1.2 0 0 0 -.743 .258l-.1 .09l-.698 .697a3.2 3.2 0 0 1 -4.382 .147l-.154 -.145l-.698 -.698a1.2 1.2 0 0 0 -.71 -.341l-.135 -.008h-1a3.2 3.2 0 0 1 -3.195 -3.018l-.005 -.182v-1a1.2 1.2 0 0 0 -.258 -.743l-.09 -.1l-.697 -.698a3.2 3.2 0 0 1 -.147 -4.382l.145 -.154l.698 -.698a1.2 1.2 0 0 0 .341 -.71l.008 -.135v-1l.005 -.182a3.2 3.2 0 0 1 3.013 -3.013l.182 -.005h1a1.2 1.2 0 0 0 .743 -.258l.1 -.09l.698 -.697a3.2 3.2 0 0 1 2.269 -.944zm3.697 7.282a1 1 0 0 0 -1.414 0l-3.293 3.292l-1.293 -1.292l-.094 -.083a1 1 0 0 0 -1.32 1.497l2 2l.094 .083a1 1 0 0 0 1.32 -.083l4 -4l.083 -.094a1 1 0 0 0 -.083 -1.32z" /></svg>
            <div class="ms-3 text-sm font-medium pr-10">${message}</div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-emerald-50 text-emerald-500 rounded-lg focus:ring-2 focus:ring-emerald-400 p-1.5 hover:bg-emerald-200 inline-flex items-center justify-center h-8 w-8" aria-label="Close">
                <span class="sr-only">Dismiss</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>`;
    }else if(type == "info"){
        alert.className = 'rounded-bl-md shadow-[2px_2px_8px_0_#00000055] flex items-center p-4 mb-4 text-blue-800 border-t-4 border-blue-300 bg-blue-50 opacity-0 transform scale-90 transition-all duration-500 ml-4';
        alert.innerHTML = `
            <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  fill="currentColor"  class="flex-shrink-0 w-5 h-5"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14.897 1a4 4 0 0 1 2.664 1.016l.165 .156l4.1 4.1a4 4 0 0 1 1.168 2.605l.006 .227v5.794a4 4 0 0 1 -1.016 2.664l-.156 .165l-4.1 4.1a4 4 0 0 1 -2.603 1.168l-.227 .006h-5.795a3.999 3.999 0 0 1 -2.664 -1.017l-.165 -.156l-4.1 -4.1a4 4 0 0 1 -1.168 -2.604l-.006 -.227v-5.794a4 4 0 0 1 1.016 -2.664l.156 -.165l4.1 -4.1a4 4 0 0 1 2.605 -1.168l.227 -.006h5.793zm-2.897 10h-1l-.117 .007a1 1 0 0 0 0 1.986l.117 .007v3l.007 .117a1 1 0 0 0 .876 .876l.117 .007h1l.117 -.007a1 1 0 0 0 .876 -.876l.007 -.117l-.007 -.117a1 1 0 0 0 -.764 -.857l-.112 -.02l-.117 -.006v-3l-.007 -.117a1 1 0 0 0 -.876 -.876l-.117 -.007zm.01 -3l-.127 .007a1 1 0 0 0 0 1.986l.117 .007l.127 -.007a1 1 0 0 0 0 -1.986l-.117 -.007z" /></svg>
            <div class="ms-3 text-sm font-medium pr-10">${message}</div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8" aria-label="Close">
                <span class="sr-only">Dismiss</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>`;
    }else if(type == "warning"){
        alert.className = 'rounded-bl-md shadow-[2px_2px_8px_0_#00000055] flex items-center p-4 mb-4 text-yellow-800 border-t-4 border-yellow-300 bg-yellow-50 opacity-0 transform scale-90 transition-all duration-500 ml-4';
        alert.innerHTML = `
            <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  fill="currentColor"  class="flex-shrink-0 w-5 h-5"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 2l.642 .005l.616 .017l.299 .013l.579 .034l.553 .046c4.687 .455 6.65 2.333 7.166 6.906l.03 .29l.046 .553l.041 .727l.006 .15l.017 .617l.005 .642l-.005 .642l-.017 .616l-.013 .299l-.034 .579l-.046 .553c-.455 4.687 -2.333 6.65 -6.906 7.166l-.29 .03l-.553 .046l-.727 .041l-.15 .006l-.617 .017l-.642 .005l-.642 -.005l-.616 -.017l-.299 -.013l-.579 -.034l-.553 -.046c-4.687 -.455 -6.65 -2.333 -7.166 -6.906l-.03 -.29l-.046 -.553l-.041 -.727l-.006 -.15l-.017 -.617l-.004 -.318v-.648l.004 -.318l.017 -.616l.013 -.299l.034 -.579l.046 -.553c.455 -4.687 2.333 -6.65 6.906 -7.166l.29 -.03l.553 -.046l.727 -.041l.15 -.006l.617 -.017c.21 -.003 .424 -.005 .642 -.005zm.01 13l-.127 .007a1 1 0 0 0 0 1.986l.117 .007l.127 -.007a1 1 0 0 0 0 -1.986l-.117 -.007zm-.01 -8a1 1 0 0 0 -.993 .883l-.007 .117v4l.007 .117a1 1 0 0 0 1.986 0l.007 -.117v-4l-.007 -.117a1 1 0 0 0 -.993 -.883z" /></svg>
            <div class="ms-3 text-sm font-medium pr-10">${message}</div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-yellow-50 text-yellow-500 rounded-lg focus:ring-2 focus:ring-yellow-400 p-1.5 hover:bg-yellow-200 inline-flex items-center justify-center h-8 w-8" aria-label="Close">
                <span class="sr-only">Dismiss</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>`;
    }
 
    document.querySelector("#alert-container").appendChild(alert);
 
     // Trigger the fade-in effect
     setTimeout(() => {
        alert.classList.remove('opacity-0', 'transform', 'scale-90');
        alert.classList.add('opacity-100', 'transform', 'scale-100');
    }, 10);

    if(!persistent){
        setTimeout(() => {
            alert.classList.remove('opacity-100', 'transform', 'scale-100');
            alert.classList.add('opacity-0', 'transform', 'scale-90');
            setTimeout(() => {
                alert.remove();
            }, 500);
        }, 5000);
    } 
    // Add event listener to the close button
    alert.querySelector('button').addEventListener('click', () => {
        alert.classList.remove('opacity-100', 'transform', 'scale-100');
        alert.classList.add('opacity-0', 'transform', 'scale-90');
        setTimeout(() => {
            alert.remove();
        }, 500);
    });
}

function showLoader() {document.querySelector('#site-loader').classList.remove('hidden');}
function hideLoader() {document.querySelector('#site-loader').classList.add('hidden');}
function closeModal(modalId){document.querySelector(modalId).classList.add('hidden');}
function openModal(modalId){document.querySelector(modalId).classList.remove('hidden');}

const days = [
  'Domingo',
  'Lunes',
  'Martes',
  'Miércoles',
  'Jueves',
  'Viernes',
  'Sábado'
];

const months = [
  'Enero',
  'Febrero',
  'Marzo',
  'Abril',
  'Mayo',
  'Junio',
  'Julio',
  'Agosto',
  'Septiembre',
  'Octubre',
  'Noviembre',
  'Diciembre'
];

function showModalJoinUs(url_join_us){
    document.querySelector("#main-modal h3").innerText = "¡Únete a Dirmedal!";
    document.querySelector("#main-modal #main-modal-body").innerHTML = `
        <div class="space-y-4 p-4"> 
            <div class="text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-[#125FBA]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h4 class="mt-2 text-lg font-medium text-[#333333]">Accede a beneficios exclusivos</h4>
            </div>
            <p class="text-[#333333]">
                Forma parte de nuestra comunidad médica y obtén acceso a herramientas,
                beneficios y opciones exclusivas para profesionales de la salud.
            </p>
            <div class="grid grid-cols-2 gap-4">
                <a href="${url_join_us}" class="col-span-2 md:col-span-1 inline-flex items-center justify-center w-full px-4 py-2 bg-[#125FBA] text-white font-semibold rounded-lg hover:bg-[#09357A] transition">
                    Ver planes para unirse
                </a>

                <button onClick="dontShowAgain()" class="col-span-2 md:col-span-1 inline-flex items-center justify-center w-full px-4 py-2 bg-[#E8E8E8] text-[#333333] font-semibold rounded-lg hover:bg-[#A4A4A5] transition">
                    No mostrar de nuevo este mensaje
                </button> 
        </div>  
    `;
    openModal("#main-modal"); 
}

function dontShowAgain(){  
    fetch(`${base_url}/wp-admin/admin-ajax.php?action=dontShowAgain`)
    .then(response => response.json())
    .then(result => {
        document.querySelector("#main-modal h3").innerText = "";
        document.querySelector("#main-modal #main-modal-body").innerHTML = '';

        if (result.success) {
            closeModal("#main-modal");
        } else {
            closeModal("#main-modal");
            createAlert('Hubo un error al procesar la solicitud.','error');
        }
    })
    .catch(error => {
        document.querySelector("#main-modal h3").innerText = "";
        document.querySelector("#main-modal #main-modal-body").innerHTML = '';
        createAlert('Hubo un error al procesar la solicitud.','error');
    });
}