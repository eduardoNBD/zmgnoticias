document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');

    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {

            e.preventDefault();

            // Obtener los datos del formulario
            const formData = new FormData(loginForm);
            const username = formData.get('username');
            const password = formData.get('password');

            // Crear el objeto de datos para enviar
            const data = new URLSearchParams();
            data.append('action', 'dirmedal_ajax_login');
            data.append('username', username);
            data.append('password', password);
            data.append('security', loginForm.querySelector('input[name="security"]').value);

            // Mostrar indicador de carga
            const submitBtn = loginForm.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            submitBtn.textContent = 'Iniciando sesión...';
            submitBtn.disabled = true;

            // Hacer la petición AJAX con fetch puro
            fetch(loginForm.action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: data
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    // Login exitoso - redirigir o mostrar mensaje
                    window.location.href = result.data.redirect; 
                } else {
                    // Error de login
                    if(result.data.code === 'UNVERIFIED_USER'){
                        createAlert('Tu cuenta no ha sido verificada. Por favor, revisa tu correo electrónico para el enlace de verificación o solicita que se envie nuevamente.', 'warning',true);
                    } else {    
                        createAlert(result.data.message, 'error');
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                createAlert('Error de conexión. Inténtalo de nuevo.', 'error');
            })
            .finally(() => {
                // Restaurar botón
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            });
        });
    } 
});