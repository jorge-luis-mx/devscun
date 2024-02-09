<?php
if ($_SERVER["REQUEST_METHOD"]=="POST") {
   
   include_once '../config/db.php';
   include_once '../config/helper.php';
   include_once '../models/metaModel.php';
   include_once '../models/saveClientsModel.php';

   $objCon = new Config();

   $objGeneral=new General($objCon);
   $objClient=new Save($objCon);

   $validacion["nombre"] = array("etiqueta" => "nombre", "validacion" => "letras_espacios", "obligatorio" => "1");
   $validacion["telefono"] = array("etiqueta" => "telefono", "validacion" => "numeros", "obligatorio" => "1");
   $validacion["correo"] = array("etiqueta" => "correo", "validacion" => "email", "obligatorio" => "1");
   // $validacion["pais"] = array("etiqueta" => "pais", "validacion" => "letras_espacios", "obligatorio" => "1");
   // $validacion["estado"   ] = array("etiqueta" =>"estado","validacion" => "letras_espacios", "obligatorio" => "" );
   // $validacion["ciudad"   ] = array("etiqueta" =>"ciudad","validacion" => "letras_espacios", "obligatorio" => "1" );
   $validacion["asunto"] = array("etiqueta" => "asunto", "validacion" => "letras_numeros_espacios", "obligatorio" => "1");
   $validacion["mensaje"] = array("etiqueta" => "mensaje", "validacion" => "letras_numeros_espacios", "obligatorio" => "1");
   $validar = $objGeneral->clean_and_validate($validacion, $_POST);

   $errors = $validar["errors"];
   $limpios = $validar["data_ok"];
   if (count($errors) == 0 && $limpios!=null) {

      $datos["nombre"]	= $limpios['nombre'];
      $datos["telefono"]= $limpios['telefono'];
      $datos["correo"] 	= $limpios['correo'];
      // $datos["pais"] 	= $limpios['pais'];
      // $datos["estado"] 	= $limpios['estado'];
      // $datos["ciudad"] 	= $limpios['ciudad'];
      $datos["asunto"] 	= $limpios['asunto'];
      $datos["mensaje"] = $limpios['mensaje'];
         

      $enviar_a	= 'info@devscun.com';
      $asunto		= $datos["asunto"];
      $info = "Tienes un cliente solicitando información!";
      foreach ($datos as $key => $value) {
           $info .= "<br> <strong>".ucwords($key)."</strong>: ".$value;
      }
         
      // $headers = "MIME-Version: 1.0\r\n"; 
      // $headers.= "Content-type: text/html; charset=UTF-8\r\n"; 
      // $headers.= "X-Priority: 1\r\n";
      $headers = 'MIME-Version:1.0'."\r\n".
      'Content-type:text/html; charset=UTF-8'."\r\n".
        'From: info@devscun.com'. "\r\n".
        'Reply-To: info@devscun.com' . "\r\n";
       
      $enviado = mail($enviar_a, $asunto,$info,$headers);
      
      if ($enviado !== false) {
   
         $strInsert = "INSERT INTO client (`nombre`,`telefono`,`correo`,`asunto`,`mensaje`,`status`) 
         values ( 
         '" . $datos["nombre"].  "',
         '" . $datos["telefono"]. "',
         '" . $datos["correo"]. "',
         '" . $datos["asunto"] . "',
         '" . $datos["mensaje"] . "',
         1
         )";

         $id_client = $objClient->saveClient($strInsert);
         // procedemos a devolver la respuesta de aprovacion
         $resultado["status"]=200;
         $resultado["message"]="Su mensaje ha sido enviado!";
         $resultado["message"]=$id_client;
   
      }else {
         // Hubo algun tipo de error
         $resultado["status"]=4004;
         $resultado["message"]="lo sentimos! algo sucedio su mensaje no ha sido enviado";
         $resultado['ResExitoso']= $limpios;
      }
          
      echo json_encode($resultado);
      
   }else{
      $resutado["errors"] = $errors;
   }

}