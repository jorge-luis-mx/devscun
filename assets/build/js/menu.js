window.addEventListener('DOMContentLoaded', (event) => {

   let localObj = window.location;
   let contextPath = localObj.pathname.split("/")[1];
   let path = localObj.protocol + "//" + localObj.host + "/"+ contextPath;

   const menuClick = document.getElementById('btn-menu');
   // Aseguramos que inicialmente solo se muestra el ícono de hamburguesa
   var iconAmburger = document.querySelector(".icon-amburger");
   var iconClose = document.querySelector(".icon-close");

   // Inicialmente solo el ícono de hamburguesa debe ser visible
   iconAmburger.style.display = "block";
   iconClose.style.display = "none";

   if(menuClick != null) {
       menuClick.addEventListener('click', (e) => {
         dealsModule.showMenu(e);
       });
   }

   const buttonContinue = document.getElementById('submitContact');
   if(buttonContinue != null) {
       buttonContinue.addEventListener('click', (e) => {
         dealsModule.contactSubmit(path,e);
       })
   }
   
   // Input keypress
   const wereinputs = document.querySelectorAll('.form-control'); // Asegura que seleccionas los inputs correctos
   if (wereinputs) {
      wereinputs.forEach((input) => {
         input.addEventListener('keypress', (e) => {
            dealsModule.removeError(e.target); // Pasa el input que activó el evento
         });
      });
   }

   // Is numeric 
   const numericInputs = document.querySelectorAll('.justnumeric');
   if (numericInputs != null) {
       numericInputs.forEach((input) => {
           input.addEventListener('keypress', (e) => {
            dealsModule.justNumeric(e);
           });
       });
   }

   //validations inputs
   const expresiones = {
      letras_espacios_acentos: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
      telefono: /^\d{7,14}$/, // 7 a 14 numeros.
      correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
      
   }


   const dealsModule = {

      showMenu: function(e) {

         var iconAmburger = document.querySelector(".icon-amburger");
         var iconClose = document.querySelector(".icon-close");
     
         // Si el ícono de hamburgesa está visible
         if (iconAmburger.style.display !== "none") {
             // Ocultamos el ícono de hamburgesa y mostramos el ícono de cerrar
             iconAmburger.style.display = "none";
             iconClose.style.display = "block";
     
             // Mostrar el menú
             var menu = document.querySelector(".menu-link");
             menu.classList.add("mostrarMenuMovil");
             menu.classList.remove("quitarMenuMovil");
         } else {
             // Mostramos el ícono de hamburgesa y ocultamos el ícono de cerrar
             iconAmburger.style.display = "block";
             iconClose.style.display = "none";
     
             // Ocultar el menú
             var menu = document.querySelector(".menu-link");
             menu.classList.add("quitarMenuMovil");
             menu.classList.remove("mostrarMenuMovil");
         }

      },

      validarFormulario:function(e){
      
         switch (e.target.name) {
            case "nombre":
              this.ruleinputs(expresiones.letras_espacios_acentos, e.target, e.target.name);
            break;

            case "telefono":
               this.ruleinputs(expresiones.telefono, e.target, e.target.name);
            break;

            case "correo":
               this.ruleinputs(expresiones.correo, e.target, e.target.name);
            break;

            case "pais":
               this.ruleinputs(expresiones.letras_espacios_acentos, e.target, e.target.name);
            break;

            case "estado":
               this.ruleinputs(expresiones.letras_espacios_acentos, e.target, e.target.name);
            break;

            case "ciudad":
               this.ruleinputs(expresiones.letras_espacios_acentos, e.target, e.target.name);
            break;

            case "asunto":
               this.ruleinputs(expresiones.letras_espacios_acentos, e.target, e.target.name);
            break;

            case "mensaje":
               this.ruleinputs(expresiones.letras_espacios_acentos, e.target, e.target.name);
            break;
   
         }
      },


      ruleinputs:function(expresion, input, campo){
         if(expresion.test(input.value)){
            document.getElementById(campo).classList.remove('danger-input');
         }else{
            document.getElementById(campo).classList.add('danger-input');
            document.getElementById(campo).focus();
         }
      },


      contactSubmit: async function(path,e){
         e.preventDefault();
         
         const contacto = document.getElementById('contactoForm');

         const engine = new FormData(contacto);

         const fields = ['asunto', 'mensaje', 'nombre', 'empresa', 'correo', 'telefono'];
         const optionalFields = ['empresa']; // Campos que no son obligatorios
         const validate = {};
         
         // Obtener y limpiar valores del formulario sin usar "?." (encadenamiento opcional)
         for (const field of fields) {
             let value = engine.get(field);
             validate[field] = value ? value.trim() : ''; // Limpiar y asignar
         }
         
         // Expresiones regulares para validar
         const emailRegex = /^[\w.-]+@[a-zA-Z\d.-]+\.[a-zA-Z]{2,}$/;
         const phoneRegex = /^\d{10,15}$/; // Acepta entre 10 y 15 dígitos numéricos
         
         // Validación general para todos los campos y validación específica (correo y teléfono) en un solo recorrido
         for (const [key, value] of Object.entries(validate)) {
             // Si el campo no es obligatorio y está vacío, lo omitimos
             if (!optionalFields.includes(key) && !value.length) { 
                 this.errorActive(key, 'Este campo es obligatorio');
                 return false;
             }
         
             // Validación específica para el correo
             if (key === 'correo' && value.length && !emailRegex.test(value)) {
                 this.errorActive('correo', 'Por favor, ingresa un correo válido');
                 return false;
             }
         
             // Validación específica para el teléfono
             if (key === 'telefono' && value.length && !phoneRegex.test(value)) {
                 this.errorActive('telefono', 'El teléfono debe tener entre 10 y 15 dígitos');
                 return false;
             }
         }
         
         

         try {
            const response = await fetch('controllers/EmailController.php',{
               method: "post",
               body: engine
            });
            let res=await response.json();
            if (res.status==200) {
               Swal.fire({
                     title: 'Mensaje enviado correctamente!',
                     text: 'Click en el botón!',
                     icon: 'success',
                     confirmButtonText: 'OK',
                     confirmButtonColor: "#3085d6",
                  });
               contacto.reset();
            }
         } catch (e) {
              console.log('fetch failed', e);
         }
          
          
      },
      errorActive: function(idAttr, message) {

         const input = document.getElementById(`${idAttr}`);
         const error =  input.closest('.input-group').querySelector('.error-message');
       
         if (error!=null) {
            error.textContent = message;
            error.style.display = 'block'; 
            input.focus();
         }
     },
      removeError: function(input) {
         const error =  input.closest('.input-group').querySelector('.error-message');
         if (error) {
             error.style.display = 'none'; // Oculta el mensaje de error
         }
      },
      justNumeric: function(e) {
         // console.log(e.charCode)
         // if (e.charCode < 48 || e.charCode > 57) {
         //     e.preventDefault();
         //     return false;
         // }
     }

   }
   //primer comentario min
   //segundo compilado
   //tercer a pararlel


   //Nos permite navegar la categoria Blog
   // Seleccionamos todos los elementos que coincidan con los selectores
   const figuras = document.querySelectorAll(".grid figure, .gridFooter figure");
   // Recorremos cada figura
   figuras.forEach(figure => {

      // Mouseover
      figure.addEventListener("mouseover", () => {
         figure.style.backgroundPosition = "right bottom";
      });

      // Mouseout
      figure.addEventListener("mouseout", () => {
         figure.style.backgroundPosition = "left top";
      });

      // Click
      figure.addEventListener("click", () => {
         const vinculo = figure.getAttribute("vinculo");
         if (vinculo) {
            window.location.href = vinculo;
         }
      });

   });

});




