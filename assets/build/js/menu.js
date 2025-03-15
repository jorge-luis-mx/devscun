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


   // const inputs = document.querySelectorAll('#contactoForm input');
   // if(inputs != null) {
  

   // }



   const dealsModule = {

      showMenu: function(e) {
         // var btn=document.querySelector(".btn-menu span");
         // //realizamos una condicion donde comparamos la clase obtenida es igual igual
         // if (btn.getAttribute('class')=='fas fa-bars') {
         // //removemos la clase actual y agregamos una nueva clase
         // btn.classList.remove('fas', 'fa-bars');
         // btn.classList.add('fas','fa-times');
         // //nuevamente hacemos queryselector para obtenemos la clase 
         // var menu=document.querySelector(".menu-link");
         // //mostramos la clase csss y quitar si ya existe
         // menu.classList.add("mostrarMenuMovil");
         // menu.classList.remove('quitarMenuMovil');
         // }else{
         // //removemos la clase actual y agregamos una nueva clase
         // btn.classList.remove('fas','fa-times');
         // btn.classList.add('fas', 'fa-bars');
         // var menu=document.querySelector(".menu-link");
         // menu.classList.add("quitarMenuMovil");
         // menu.classList.remove('mostrarMenuMovil');
         // }
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
               // const wereinputs = document.querySelectorAll('.iam-input');
               // if(wereinputs != null) {
               //     wereinputs.forEach((input) => {
               //         input.value = "";
               //     });
               // }

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
});



/*=============================================
BANNER
=============================================*/

// $(".fade-slider").jdSlider({

// 	isSliding: false,
// 	isAuto: true,
// 	isLoop: true,
// 	isDrag: false,
// 	interval:5000,
// 	isCursor: false,
// 	speed:3000

// });

// var alturaBanner = $(".fade-slider").height();

// $(".bannerEstatico").css({"height":alturaBanner+"px"})


/*=============================================
ANIMACIONES SCROLL
=============================================*/

// $(window).scroll(function(){

// 	var posY = window.pageYOffset;
	
// 	if(posY > alturaBanner){

// 		$("header").css({"background":"white"})

// 		$("header .logotipo").css({"filter":"invert(100%)"})

// 		$(".fa-search, .fa-bars").css({"color":"black"})

// 	}else{

// 		$("header").css({"background":"rgba(0,0,0,.5)"})

// 		$("header .logotipo").css({"filter":"invert(0%)"})

// 		$(".fa-search, .fa-bars").css({"color":"white"})

// 	}

// })

/*=============================================
MENÚ
=============================================*/

// $(".fa-bars").click(function(){

// 	$(".menu").fadeIn("fast");

// })

// $(".btnClose").click(function(e){

// 	e.preventDefault();

// 	$(".menu").fadeOut("fast");

// })

/*=============================================
GRID CATEGORÍAS
=============================================*/

$(".grid figure, .gridFooter figure").mouseover(function(){

	$(this).css({"background-position":"right bottom"})

})

$(".grid figure, .gridFooter figure").mouseout(function(){

	$(this).css({"background-position":"left top"})

})

$(".grid figure, .gridFooter figure").click(function(){

	var vinculo = $(this).attr("vinculo");

	window.location = vinculo;

})

/*=============================================
PAGINACIÓN
=============================================*/

var totalPaginas = Number($(".pagination").attr("totalPaginas"));

var paginaActual = Number($(".pagination").attr("paginaActual"));
var rutaActual = $("#rutaActual").val();
var rutaPagina = $(".pagination").attr("rutaPagina");

if($(".pagination").length != 0){

	$(".pagination").twbsPagination({
		totalPages: totalPaginas,
		startPage: paginaActual,
		visiblePages: 4,
		first: "Primero",
		last: "Último",
		prev: '<i class="fas fa-angle-left"></i>',
		next: '<i class="fas fa-angle-right"></i>'

	}).on("page", function(evt, page){

		if(rutaPagina != ""){

			window.location = rutaActual+rutaPagina+"/"+page;

		}else{

			window.location = rutaActual+page;
		}
		

	})

}


/*=============================================
SCROLL UP
=============================================*/

// $.scrollUp({
// 	scrollText:"",
// 	scrollSpeed: 2000,
// 	easingType: "easeOutQuint"
// })

/*=============================================
DESLIZADOR DE ARTÍCULOS
=============================================*/

$(".deslizadorArticulos").jdSlider({
	wrap: ".slide-inner",
	slideShow: 3,
	slideToScroll:3,
	isLoop: true,
	responsive: [{
		viewSize: 320,
		settings:{
			slideShow: 1,
			slideToScroll: 1
		}

	}]

})

/*=============================================
COMPARTIR ARTÍCULOS
=============================================*/

$('.social-share').shapeShare();

/*=============================================
OPINIONES VACÍAS
=============================================*/

if($(".opiniones").html()){

	if(document.querySelector(".opiniones").childNodes.length == 1){	

		$(".opiniones").html(`

			<p class="pl-3 text-secondary">¡Este artículo no tiene opiniones!</p>

		`)
	}

}

/*=============================================
SUBIR FOTO TEMPORAL DE OPINIÓN
=============================================*/
$("#fotoOpinion").change(function(){
$(".alert").remove();

	
	var imagen = this.files[0];
	
	/*=============================================
    VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
    =============================================*/

    if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

    	$("#fotoOpinion").val("");

    	$("#fotoOpinion").after(`

				<div class="aler alert-danger">¡La imagen debe estar en formato JPG o PNG!</div>
    		
    	`)

    	return;

    }else if(imagen["size"] > 2000000){

    	$("#fotoOpinion").val("");

    	$("#fotoOpinion").after(`

				<div class="aler alert-danger">¡La imagen no debe pesar más de 2MB!</div>
    		
    	`)

    	return;
    
    }else{

    	 var datosImagen = new FileReader;

    	 datosImagen.readAsDataURL(imagen);

    	 $(datosImagen).on("load", function(event){

    	 	var rutaImagen = event.target.result;

    	 	$(".prevFotoOpinion").attr("src", rutaImagen);

    	 })

    }

})

/*=============================================
BUSCADOR
=============================================*/

$(".buscador").change(function(){

	var busqueda = $(this).val().toLowerCase();

	var expresion = /^[a-z0-9ñÑáéíóú ]*$/;

	if(!expresion.test(busqueda)){

		$(".buscador").val("");

	}else{

		var evaluarBusqueda = busqueda.replace(/[0-9ñáéíóú ]/g, "_");

		var rutaBuscador = evaluarBusqueda;

		$(".buscar").click(function(){

			if($(this).parent().parent().children(".buscador").val() != ""){

				window.location = rutaActual+rutaBuscador;

			}

		})

	}

})

/*=============================================
BUSCADOR CON ENTER
=============================================*/

$(document).on("keyup", ".buscador", function(evento){

	evento.preventDefault();

	if(evento.keyCode == 13 && $(".buscador").val() != ""){

		var busqueda = $(this).val().toLowerCase();

		var expresion = /^[a-z0-9ñÑáéíóú ]*$/;

		if(!expresion.test(busqueda)){

			$(".buscador").val("");

		}else{

			var evaluarBusqueda = busqueda.replace(/[0-9ñáéíóú ]/g, "_");

			var rutaBuscador = evaluarBusqueda;

			window.location = rutaActual+rutaBuscador;

		}


	}

})
