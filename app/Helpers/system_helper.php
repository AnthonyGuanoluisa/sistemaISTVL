<?php


function getDataSystem(){
        $db = db_connect();
        $result = $db->table('system')->where('id',1)->get();
        if($result->getResult()){
            $data = [
                "appName" => $result->getResult()[0]->name,
                "appVersion" => $result->getResult()[0]->version,
                "appOwner" => $result->getResult()[0]->owner,
                "appWebsite" => $result->getResult()[0]->website,
                "appLogo" => $result->getResult()[0]->logo
                
            ];
            
        }else{
            $data = [
                "appName" => '',
                "appVersion" => '',
                "appOwner" => '',
                "appWebsite" => '',
                "appLogo" => ''
            ];
        }

        return (object) $data;
        
}



function encriptar($string){
    $key = "MICLAVE_123456789#";
    $result = '';
    for($i=0; $i<strlen($string); $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key))-1, 1);
        $char = chr(ord($char)+ord($keychar));
        $result.=$char;
    }
    $result=base64_encode($result);
    $result = str_replace(array('+','/','='),array('-','_','.'),$result);
    return $result;
}
   
function desencriptar($string){
    $key = "MICLAVE_123456789#"; 
    $string = str_replace(array('-','_','.'),array('+','/','='),$string);
    $result = '';
    $string = base64_decode($string);
    for($i=0; $i<strlen($string); $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key))-1, 1);
        $char = chr(ord($char)-ord($keychar));
        $result.=$char;
    }
    return $result;
}

function verficarAcceso($idMenu){
    if(session('isLoggedIn')){ // verificar el inicio de sesión
        if(session('esSuperadmin') == "S"){
            return true;
        }
        else{
            $idUsuario = session('idUsuario');
            
            $sql = "SELECT perfil_menu.id, perfil_menu.escritura FROM perfil_menu INNER JOIN perfil ON perfil_menu.perfil_id = perfil.id INNER JOIN usuario_perfil ON usuario_perfil.perfil_id = perfil.id WHERE usuario_perfil.usuario_id = $idUsuario AND perfil_menu.menu_id = $idMenu";

            $db = \Config\Database::connect();
            $registros = $db->query($sql);
            $registros = $registros->getResult() ? $registros->getResult()[0] : false;
            
           // $PerfilesMenus =& get_instance();
           //$PerfilesMenus->load->model('PerfilesMenus/PerfilMenu');
            //$registros = $PerfilesMenus->PerfilMenu->buscarMenuUsuario($idUsuario, $idMenu);
            return $registros;
        }
    }
    else{
        return false;
    }	
}


function normalizaCadena($cadena){
    $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
    $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
    $cadena = utf8_decode($cadena);
    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
    $cadena = strtolower($cadena);
    return utf8_encode($cadena);
}

function getAudith($action){
   switch($action){
    case "insert":
        $data = [
            "created_id" => session("idUsuario"),
            "created_at" => date("Y-m-d h:i:s")
        ];
    break;
    case "edit":
        $data = [
            "updated_id" => session("idUsuario"),
            "updated_at" => date("Y-m-d h:i:s")
        ];
    break;
}
   return $data;
}