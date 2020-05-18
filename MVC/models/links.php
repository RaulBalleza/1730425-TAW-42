<?php
    //modelo de enlaces web
    class Pages{
        public function linksPagesModel($links){
            if($links=='login' || $links=='users' || $links=='products' ||
            $links=='addProduct' || $links=='edit' || $links=='editProduct' || $links='signout'){
                $module = "views/modules/".$links.".php";
            }else if($links=='index'){
                $module = "views/modules/registro.php";
            }else if($links=='ok'){
                $module = "views/modules/registro.php";
            }else if($links=='fallo'){
                $module = "views/modules/ingresar.php";
            }else if($links=='cambio'){
                $module = "views/modules/usuarios.php";
            }else{
                $module = "views/modules/registro.php";
            }
        }
    }
?>