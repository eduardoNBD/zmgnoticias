<?php 
    $register_id  = (int) get_theme_mod('dirmedal_page_register_patients', 0);
    $register_url = $register_id ? get_permalink($register_id) : '';
    $forget_password_id  = (int) get_theme_mod('dirmedal_page_forget_password', 0);
    $forget_password_url = $forget_password_id ? get_permalink($forget_password_id) : '';
    $post_id = get_the_ID();
    $requires_login_scripts = get_post_meta($post_id, '_dirmedal_requires_login_scripts', true);
  
    if ($requires_login_scripts) {
?>

<div class="mx-4 md:mx-0 bg-white border border-[#eaeaea] rounded-xl shadow-lg">
    <!-- Sección verde superior -->
    <div class="bg-[#27C195] text-white p-6 rounded-t-xl">
      <h2 class="text-lg font-medium mb-4">Elige al médico ideal cerca de ti.</h2>
      <p class="text-sm mb-4">Agenda tu próxima cita completamente gratis.</p>
      <p class="text-sm mb-6">Pregunta a los especialistas en el foro y aclara todas tus dudas.</p>
      <div class="flex flex-col items-start">
        <span class="text-xs mb-2">¿No tienes cuenta?</span>
        <a href="<?=$register_url?>" class="bg-[#125FBA] hover:bg-[#09357A] text-white px-4 py-2 rounded-md text-xs font-medium transition">
          Regístrate ahora
        </a>
      </div>
    </div>

    <!-- Formulario de inicio de sesión -->
    <div class="p-6 pt-4">
      <h3 class="text-lg font-semibold text-center mb-4">Iniciar sesión</h3>

      <form id="loginForm" action="<?php echo admin_url('admin-ajax.php'); ?>" method="POST">
        <div class="mb-4">
          <input 
            type="text" 
            name="username"
            placeholder="Usuario" 
            class="w-full px-4 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
        </div>

        <div class="mb-4">
          <input 
            name="password"
            type="password" 
            placeholder="Contraseña" 
            class="w-full px-4 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
        </div>

        <!-- Campo oculto con nonce de seguridad -->
        <input type="hidden" name="security" value="<?php echo wp_create_nonce('dirmedal_login_nonce'); ?>">

        <button 
          type="submit" 
          class="w-full bg-[#09357A] hover:bg-[#125FBA] text-white py-2 rounded-md text-sm font-medium transition"
        >
          Ingresar
        </button>

        <div class="mt-4 text-center">
          <a href="<?=$forget_password_url?>" class="text-xs text-gray-500 hover:text-blue-600">
            Olvidé mi contraseña
          </a>
        </div>
      </form>
    </div>

  </div>
<?php } ?>