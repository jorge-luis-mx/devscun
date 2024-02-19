window.addEventListener('DOMContentLoaded', (event) => {

   let localObj = window.location;
   let contextPath = localObj.pathname.split("/")[1];
   let path = localObj.protocol + "//" + localObj.host + "/"+ contextPath;

   const menuClick = document.getElementById('btn-menu');
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
   const wereinputs = document.querySelectorAll('.iam-input');
   if(wereinputs != null) {
       wereinputs.forEach((input) => {
           input.addEventListener('keypress', (e) => {
            dealsModule.removeError(e);
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


   const inputs = document.querySelectorAll('#contactoForm input');
   if(inputs != null) {
  
      // inputs.forEach((input) => {

      //    input.addEventListener('keyup', (e)=>{
      //       dealsModule.validarFormulario(e);
      //    });
      //    input.addEventListener('blur', (e)=>{
      //       dealsModule.validarFormulario(e);
      //    });
         
      // });
   }



   const dealsModule = {

      showMenu: function(e) {
         var btn=document.querySelector(".btn-menu span");
         //realizamos una condicion donde comparamos la clase obtenida es igual igual
         if (btn.getAttribute('class')=='fas fa-bars') {
         //removemos la clase actual y agregamos una nueva clase
         btn.classList.remove('fas', 'fa-bars');
         btn.classList.add('fas','fa-times');
         //nuevamente hacemos queryselector para obtenemos la clase 
         var menu=document.querySelector(".menu-link");
         //mostramos la clase csss y quitar si ya existe
         menu.classList.add("mostrarMenuMovil");
         menu.classList.remove('quitarMenuMovil');
         }else{
         //removemos la clase actual y agregamos una nueva clase
         btn.classList.remove('fas','fa-times');
         btn.classList.add('fas', 'fa-bars');
         var menu=document.querySelector(".menu-link");
         menu.classList.add("quitarMenuMovil");
         menu.classList.remove('mostrarMenuMovil');
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
 
         const validate = {
            nombre : engine.get('nombre'),
            telefono : engine.get('telefono'),
            correo : engine.get('correo'),
            asunto : engine.get('asunto'),
            mensaje : engine.get('mensaje')
         };


         if(validate.nombre == null || validate.nombre == 0 || /^\s+$/.test(validate.nombre)) {
             this.errorActive('nombre');
             return false;
         }
         if(validate.telefono == null || validate.telefono == 0 || /^\s+$/.test(validate.telefono)) {
            this.errorActive('telefono');
            return false;
         }
         if (!(/\w+([-+.']\w+)*@\w+([-.]\w+)/.test(validate.correo))) {
             this.errorActive('correo');
             return false;
         }
 
         // if(validate.pais == null || validate.pais == 0 || /^\s+$/.test(validate.pais)) {
         //    this.errorActive('pais');
         //    return false;
         // }

         // if(validate.estado == null || validate.estado == 0 || /^\s+$/.test(validate.estado)) {
         //    this.errorActive('estado');
         //    return false;
         // } 

         // if(validate.ciudad == null || validate.ciudad == 0 || /^\s+$/.test(validate.ciudad)) {
         //    this.errorActive('ciudad');
         //    return false;
         // }

         if(validate.asunto == null || validate.asunto == 0 || /^\s+$/.test(validate.asunto)) {
            this.errorActive('asunto');
            return false;
         }

         if(validate.mensaje == null || validate.mensaje == 0 || /^\s+$/.test(validate.mensaje)) {
            console.log(validate.mensaje);
             this.errorActive('mensaje');
             return false;
         }

         try {
            const response = await fetch('controllers/EmailController.php',{
               method: "post",
               body: engine
            });
            let res=await response.json();
            if (res.status==200) {
               Swal.fire(
                  'Mensaje enviado correctamente!',
                  'click en button!',
                  'success'
                )
               const wereinputs = document.querySelectorAll('.iam-input');
               if(wereinputs != null) {
                   wereinputs.forEach((input) => {
                       input.value = "";
                   });
               }

            }
         } catch (e) {
              console.log('fetch failed', e);
         }
          
          
      },
      errorActive: function(idAttr) {

         const input = document.getElementById(`${idAttr}`);
         const error = input.nextElementSibling;
         if (error!=null) {
            error.classList.remove('oculto');
            error.classList.add('mostrar');
            input.focus();
         }
     },
      removeError: function(el) {
         const error = el.target.nextElementSibling;
         if(error.classList.contains('mostrar')) {
            error.classList.remove('mostrar');
            error.classList.add('oculto');
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
console.log(totalPaginas);
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
