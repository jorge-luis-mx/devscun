<?php require_once 'views/components/banner/banner.php' ?>

<div class="contacto">
   <div class="contenedor">
      <div class="container-form">
         <div class="column-form">
               <div class="info-contacto">
                  <p class="descripcion-info">Rellena el siguiente formulario con tus datos, y nos pondremos en contacto contigo para atender tus solicitudes de página web de manera personalizada.</p>
               </div>
               <form method="post" action=""  id="contactoForm" autocomplete="off" >
                  <div class="inputs">
                     <div class="input-group">
                        <div class="input-group-prepend">
                           <label for="nombre">Nombre</label>
                        </div>
                        <input type="text" id="nombre" name="nombre"  class="form-control iam-input"  required>
                        <p class="has-text-danger is-block mt-2 oculto">Nombre es requerido</p>
                     </div>
                     <div class="input-group">
                        <div class="input-group-prepend">
                           <label for="telefono">Telefono</label>
                        </div>
                        <input type="text" id="telefono"  name="telefono"  class="form-control iam-input justnumeric" maxlength="10" required>
                        <p class="has-text-danger is-block mt-2 oculto">Telefono es requerido</p>
                     </div>
                  </div>
               
                  <div class="inputs">
                     <div class="input-group">
                        <div class="input-group-prepend">
                           <label for="correo">Correo</label>
                        </div>
                        <input type="text" id="correo" name="correo" class="form-control iam-input"   required>
                        <p class="has-text-danger is-block mt-2 oculto">Correo es requerido</p>
                     </div>
                     <!-- <div class="input-group">
                        <div class="input-group-prepend">
                           <label for="pais">Pais</label>
                        </div>
                        <input type="text" id="pais" name="pais" class="form-control iam-input"   required>
                        <p class="has-text-danger is-block mt-2 oculto">Pais es requerido</p>
                     </div> -->
                  </div>

                  <!-- <div class="inputs">
                     <div class="input-group">
                        <div class="input-group-prepend">
                           <label for="estado">Estado</label>
                        </div>
                        <input type="text" id="estado" name="estado" class="form-control iam-input"  required>
                        <p class="has-text-danger is-block mt-2 oculto">Estado es requerido</p>
                     </div>
                     <div class="input-group">
                        <div class="input-group-prepend">
                           <label for="ciudad">ciudad</label>
                        </div>
                        <input type="text" id="ciudad" name="ciudad" class="form-control iam-input"  required>
                        <p class="has-text-danger is-block mt-2 oculto">Ciudad es requerido</p>
                     </div>
                  </div> -->

                  <div class="inputs-asunto">
                     <div class="input-group">
                        <div class="input-group-prepend">
                           <label for="asunto">Asunto</label>
                        </div>
                        <input type="text" id="asunto" name="asunto"  class="form-control iam-input" required>
                        <p class="has-text-danger is-block mt-2 oculto">Asunto es requerido</p>
                     </div>
                  </div>

                  <div class="inputs-message">
                     <div class="input-group">
                        <div class="input-group-prepend">
                           <label for="mensaje">Mensaje</label>
                        </div>
                        <textarea id="mensaje" name="mensaje"  class="form-control iam-input" rows="5"  required></textarea>
                        <p class="has-text-danger is-block mt-2 oculto">Mensaje es requerido</p>
                     </div>
                  </div>
                  <div class="inputs-btn"> 
                     <input  type="submit" id="submitContact" value="Enviar Mensaje">
                  </div>
               </form>
         </div>
         <div class="column-form-info">
            <div class="mas-info">
                  <ul>
                     <li>
                        <i class="fas fa-phone"></i>
                        998 4085290
                     </li>
                     <li>
                        <i class="fas fa-envelope"></i>
                        info@devscun.com
                     </li>
                  </ul>
            </div>
         </div>
      </div>
   </div>
</div>
