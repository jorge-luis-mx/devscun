<?php require_once 'views/components/banner/banner.php' ?>

<div class="contacto">
   <div class="contenedor">
   <div class="container-contact">
   <a class="custom-link" href="mailto:info@devscun.com">
      <div class="custom-link-body">
         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 42 42">
            <path fill="currentColor" d="M40.5 31.5v-18S22.3 26.2 20.53 26.859C18.79 26.23.5 13.5.5 13.5v18c0 2.5.53 3 3 3h34c2.529 0 3-.439 3-3m-.029-21.529c0-1.821-.531-2.471-2.971-2.471h-34c-2.51 0-3 .78-3 2.6l.03.28s18.069 12.44 20 13.12c2.04-.79 19.97-13.4 19.97-13.4z"/>
         </svg>
         <span>info@devscun.com</span>
      </div>
   </a>
   <a class="custom-link" href="tel:9984085290">
      <div class="custom-link-body">
         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <g fill="currentColor">
               <path d="M22 12A10 10 0 0 0 12 2v2a8 8 0 0 1 7.391 4.938A8 8 0 0 1 20 12zM2 10V5a1 1 0 0 1 1-1h5a1 1 0 0 1 1 1v4a1 1 0 0 1-1 1H6a8 8 0 0 0 8 8v-2a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1h-5C7.373 22 2 16.627 2 10"/>
               <path d="M17.543 9.704A6 6 0 0 1 18 12h-1.8A4.2 4.2 0 0 0 12 7.8V6a6 6 0 0 1 5.543 3.704"/>
            </g>
         </svg>
         <span>998 408 5290</span>
      </div>
   </a>
</div>





   
   <div class="form-container">
      <p class="form-description">
         <span>¿Necesitas más información?</span> Rellena el siguiente formulario con tus datos y nos pondremos en contacto contigo para atender tus solicitudes de manera personalizada.
      </p>
      <form id="contactoForm">
         <div class="form-content">
            <!-- Primera Columna -->
            <div class="form-left">

               <div class="input-group">
                  <label for="asunto">¿Qué tipo de servicio necesitas?</label>
                  <input type="text" id="asunto" name="asunto" class="form-control" required>
                  <p class="error-message">Tipo de servici requerido </p>
               </div>

               <div class="input-group">
                  <label for="mensaje">Mensaje</label>
                  <textarea id="mensaje" name="mensaje" class="form-control" rows="6" required></textarea>
                  <p class="error-message">Mensaje es requerido</p>
               </div>
            </div>

            <!-- Segunda Columna -->
            <div class="form-right">
               <div class="input-group">
                  <label for="nombre">Nombre</label>
                  <input type="text" id="nombre" name="nombre" class="form-control" required>
                  <p class="error-message">Nombre es requerido</p>
               </div>
               <div class="input-group">
                  <label for="empresa">Empresa</label>
                  <input type="text" id="empresa" name="empresa" class="form-control">
                  <p class="error-message">Empresa es requerido</p>
               </div>
               <div class="input-group">
                  <label for="correo">Correo Electrónico</label>
                  <input type="email" id="correo" name="correo" class="form-control" required>
                  <p class="error-message">Correo es requerido</p>
               </div>
               <div class="input-group">
                  <label for="telefono">Teléfono</label>
                  <input type="text" id="telefono" name="telefono" class="form-control justnumeric" maxlength="15" required>
                  <p class="error-message">Teléfono es requerido</p>
               </div>
            </div>
         </div>

         <!-- Botón de Envío -->
         <div class="form-footer">
            <input type="submit" id="submitContact" value="Enviar Solicitud">
         </div>
      </form>
   </div>

   </div>
</div>