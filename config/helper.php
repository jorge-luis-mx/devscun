<?php
class General {




    public function clean_and_validate($validations, $_post){

        $errors = array();
        $dataOk = array();
        if (count($validations)>0) {
            foreach ($validations as $input => $value) {

                $postString = (isset($_post[$input]))? $_post[$input] : "";
                if ($value["required"] == "1") {
                    if ($postString == ""){
                        $errors[$input] = $value["etiquette"] . ", is required.";
                    }
                }
                if (!isset($errors[$input])){
                    switch ($value["validation"]) {
                        case 'email':
                            if ($postString!="") {
                                $stringClean = $this->cleanString($postString);
                                if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\.-])*@([a-zA-Z0-9-])+([a-zA-Z0-9\._-]+)+$/", $stringClean)) {
                                    $dataOk[$input] = $stringClean;
                                } else {
                                    $errors[$input] = $value["etiquette"] . ", is incorrect";
                                }
                            }
                            break;
                        case 'numeros':
                            if (is_array($postString) && count($postString)>0){
                                foreach ($postString as $k=>$item){
                                    if (preg_match("/^([0-9])+$/", $item)) {
                                        $dataOk[$input][$k] = $item;
                                    } else {
                                        $errors[$input] = $value["etiquette"] . ", is incorrect";
                                    }
                                }
                            }else{
                                if ($postString!=""){
                                    $stringClean = $this->cleanString($postString);
                                    if (preg_match("/^([0-9])+$/", $stringClean )) {
                                        $dataOk[$input] = $stringClean;
                                    } else {
                                        $errors[$input] = $value["etiquette"] . ", is incorrect";
                                    }
                                }else{
                                    $dataOk[$input] = "";
                                }
                            }

                            break;

                        case 'letras_numeros':
                            if ($postString!="") {
                                $stringClean = $this->cleanString($postString);
                                if (preg_match("/^[a-zA-Z0-9]+$/", $stringClean)) {
                                    $dataOk[$input] = $stringClean;
                                } else {
                                    $errors[$input] = $value["etiquette"] . ", is incorrect";
                                }
                            }else{
                                $dataOk[$input] = "";
                            }
                            break;

                        case 'letras':
                            if ($postString!="") {
                                $stringClean = $this->cleanString($postString);
                                if (preg_match("/^[A-Za-z]+$/", $stringClean)) {
                                    $dataOk[$input] = $stringClean;
                                } else {
                                    $errors[$input] = $value["etiquette"] . ", is incorrect.";
                                }
                            }else{
                                $dataOk[$input] = "";
                            }
                            break;

                        case 'letras_espacios':
                            if ($postString!="") {
                                $stringClean = $this->cleanString($postString);
                                $dataOk[$input] = $stringClean;

                            }else{
                                $dataOk[$input] = "";
                            }
                            break;
                            
                        case 'letras_numeros_espacios':
                                if ($postString!="") {
                                    $stringClean = $this->cleanString($postString);
                                    if (preg_match("/^[A-Za-z0-9\s]+$/", $stringClean)) {
                                        $dataOk[$input] = $stringClean;
                                    } else {
                                        $errors[$input] =  $value["etiquette"] . ", is incorrect.";
                                    }
                                }else{
                                    $dataOk[$input] = "";
                                }
    
                            break;

                        default:
                            $string = $this->cleanString($postString);
                            $dataOk[$input] = $string;
                            break;
                    }
                }
            }
        }
        $arrOut = array('data_ok'=>$dataOk,'errors'=>$errors);
        return $arrOut;
    }



    public function cleanString($string){
        // $string = trim($string); // Elimina espacios antes y después de los string
        // $string = addslashes($string);
        #$string = stripslashes($string); // Elimina backslashes \
        #$string = htmlspecialchars($string); // Traduce caracteres especiales en entidades HTML
        #$string = htmlentities($string);
        // return $string;
        $cleanstringhtml = strip_tags($string);
        $cleanstring = str_replace('=','',$cleanstringhtml);
        $cleanstring = str_replace(';','',$cleanstring);
        $cleanstring = str_replace('"','',$cleanstring);
        $cleanstring = trim($cleanstring);
        $cleanstring = addslashes($cleanstring);
        
        return $cleanstringhtml;
    }

    

    public function cleanArray( $array = array() ){
        $arrOut=array();
        if (count($array)>0){
            foreach ($array as $key => $value){
                $value=trim($value);
                if ($value !="" && $value!=null){
                    $arrOut[$key] = $value;
                }
            }
        }
        return $arrOut;
    }






    public function cambiarFormatFecha($date, $lang, $formatOut, $langMonth="", $separator=""){
        $fecha 		= explode('/', $date);

        $dateOutPut = "";
        switch ($lang) {
            case 'en': // month-day-year
                //$dateOutPut = $fecha[0].$separator. $fecha[1] .$separator.$fecha[2];
                $dateOutPut = $fecha[2]."-".$fecha[0]."-".$fecha[1];
                $dateOutPut = self::devolverFecha($dateOutPut,$formatOut,$langMonth,$separator);
                break;

            case 'es': // day-month-year
                //$dateOutPut = $fecha[1].$separator. $fecha[0] .$separator.$fecha[2];
                $dateOutPut = $fecha[2]."-".$fecha[1]."-".$fecha[0];
                $dateOutPut = self::devolverFecha($dateOutPut,$formatOut,$langMonth,$separator);
                break;
            case 'db':
            default:
                if ($formatOut != "db"){
                    $dateOutPut = self::devolverFecha($date,$formatOut,$langMonth,$separator);
                }else{
                    $dateOutPut = $fecha[2]."-".$fecha[1]."-".$fecha[0];
                    $dateOutPut = self::devolverFecha($date,$formatOut,$langMonth,$separator);
                }

                break;
        }
        return $dateOutPut;
    }

    private function devolverFecha($dateOutPut,$formatOut,$langMonth,$separator=''){

        $fecha 		= explode('-', $dateOutPut); // Fecha formato DB
        $arrMonths_es = array( '01' => "Ene", '02' => "Feb", '03' => "Mar", '04' => "Abr", '05' => "May", '06' => "Jun", '07' => "Jul", '08' => "Ago", '09' => "Sep", '10' => "Oct",  '11' => "Nov", '12' => "Dic" );
        $arrMonths_en = array( '01' => "Jan", '02' => "Feb", '03' => "Mar", '04' => "Apr", '05' => "May", '06' => "Jun", '07' => "Jul", '08' => "Aug", '09' => "Sep", '10' => "Oct",  '11' => "Nov", '12' => "Dec" );

        switch ($formatOut) {
            case 'en': // month-day-year
                $nameMonth=($langMonth!="")? $arrMonths_en[ $fecha[1] ]: $fecha[1];
                $dateOut = $nameMonth.$separator.$fecha[2].$separator.$fecha[0];
                break;

            case 'es': // day-month-year;
                $nameMonth=($langMonth!="")? $arrMonths_es[ $fecha[1] ]: $fecha[1];
                $dateOut = $fecha[2].$separator.$nameMonth.$separator.$fecha[0];
                break;
            default:
                $dateOut = $dateOutPut;
                break;
        }
        return $dateOut;
    }

    public function generateReferenceCode($ref, $id){
        return $ref.str_pad($id, 6,"0", STR_PAD_LEFT);
    }



    public function upload_file($file,$path,$fileType,$arrOthers=array())
    {
        $preName=(isset($arrOthers["pre_name"]))? $arrOthers["pre_name"] : "";
        $minSize=(isset($arrOthers["min_size"]))? $arrOthers["min_size"] : 0;
        $maxSize=(isset($arrOthers["max_size"]))? $arrOthers["max_size"] : 0;

        // 2097152 = 2MB

        $errors = array();
        if (count($file) > 0) {
            $file_name = $file['name'];
            $file_size = $file['size'];
            $file_tmp = $file['tmp_name'];
            $file_type = $file['type'];
            $file_error = $file['error'];
            $temp = explode('.', $file_name);
            $file_ext = $temp[1];

            $checType = $this->checkFileType($fileType,$file_ext);
            if ($checType["success"] == 1) {

                $checSize= $this->checkFileSize($file_size,$minSize,$maxSize);
                if ($checSize["success"]==1){

                    $file_name_db = $preName."-" . time() . "." . $file_ext;
                    $path .=$file_name_db;
                    if (move_uploaded_file($file_tmp, $path)) {
                        $response['success'] = true;
                        $response['name']    = $file_name;
                        $response['name_db'] = $file_name_db;
                    } else {
                        $response['success'] = false;
                        $response['errors']  = "no se movio la imagen ";
                    }

                }else{
                    $response['success']= false;
                    $response['errors'] = $checSize["message"];
                }

            }else{
                $response['success']= false;
                $response['errors'] = $checType["message"];
            }

        } else {
            $response['success']= false;
            $response['errors'] = "No hay archivo";
        }
        return $response;
    }

    private function checkFileSize($size,$minSize=0, $maxSize=0){
        $success=0;
        $message="";
        if ($size!=""){
            if ($maxSize > 0 && $size < $minSize && $size > $maxSize) {
                $message = 'Tamaño no coincide con lo requerido';
            }elseif ($size < $minSize){
                $message = 'Demaciado pequeño.';
            }elseif($size > $maxSize){
                $message = 'Demaciado grande.';
            }else{
                $success=1;
                $message = 'Bien!';
            }
        }
        return array("success"=>$success,"message"=>$message);
    }

    private function checkFileType($type,$fileTye){

        $arrTypes["image"] = array("jpeg", "jpg", "png", "gif");
        $arrTypes["document"]= array("pdf","doc","docs","xln","csv");
        $arrTypes["audio"]= array("mp3","mp4");

        if (isset($arrTypes[$type])){
            if (in_array($fileTye, $arrTypes[$type]) === false) {
                $success= 0;
                $message= "Tipo de archivo no permitido";
            }else{
                $success=1;
                $message = "Bien";
            }
        }else{
            $success= 0;
            $message = "Tipo de archivo no permitido";
        }

        return array("success"=>$success,"message"=>$message);
    }


    public function hace_cuanto($fecha1, $fecha2 = NULL) {
        $fecha1 = new Datetime($fecha1);
        if ( ! $fecha2) {
            $fecha2 = new Datetime('now');
        } else {
            $fecha2 = new Datetime($fecha2);
        }
        if ($fecha1 > $fecha2) return;
        $r_str = array();
        $intervalo = $fecha1->diff($fecha2);
        $diff = $intervalo->format('%ya-%mm-%dd-%hh-%ii-%ss');
        preg_match_all("/[1-9]+[a-z]+/", $diff, $match_diff);
        $time_str = array(  'a' => 'año',
            'm' => 'mes',
            'd' => 'día',
            'h' => 'hora',
            'i' => 'minuto',
            's' => 'segundo'
        );
        foreach ($match_diff[0] as $time) {
            $times = intval($time);
            $index_time = str_replace($times, '', $time);
            $string = $time_str[$index_time];
            $string .= $time > 1 ? ($string === 'mes' ? 'es' : 's' ) : '' ;
            $r_str[] =sprintf('%d %s', $time, $string);
        }
        $ult = end($r_str);
        $prev = prev($r_str);
        $r_str = array_reduce($r_str, function($r, $v) use($prev, $ult, $r_str) {
            if (count($r_str) > 1) {
                $v = $prev === $v ? sprintf('%s ', $v) : ($ult === $v ? sprintf('y %s', $v) :  sprintf('%s, ', $v));
            }
            $r .= $v;
            return $r;
        });
        return $r_str;
    }



}