<?php 
    class MvcController{
        //llamar a la plantilla
        public function showPage(){
            include 'views/template.php';
        }
        
        //enlaces
        public function linksPagesController(){
            if(isset($_GET['action'])){
                $links = $_GET['action'];
            }else{
                $links = 'index';
            }
            //controlador invoca al model para que muestre
            //el listado de páginas
            $response = Pages::linksPagesModel($links);
            include $response;
        }

        //registro de usuarios
        public function userRegisterController(){
            if(isset($_POST['userRegister'])){
                //recibe los campos para el registro de usuarios,
                //se almacenan los datos en una propiedad de tipo array asociativo.
                //Propiedades(username,password,email).
                $datosController = array('username'=>$_POST['userRegister'],
                                        'password'=>$_POST['passwordRegister'],
                                        'email'=>$_POST['emailRegister']);
                
                //Se le dice al modelo models/crud.php (Datos::userRegisterModel) reciba como
                //parametros los valores del arreglo $datosController y el nombre de la tabla
                //de la base de datos (users)
                $response = Datos::userRegisterModel($datosController,'users');

                //se imprime la respuesta
                if($response=='success'){
                    header('location:index.php?action=ok');
                }else{
                    header('location:index.php');
                }
            }
        }

        //INGRESO USUARIOS
        public function userLoginController(){
            if(isset($_POST['userLogin'])){
                $datosController = array(
                    'user'=>$_POST['userLogin'],
                    'password'=>$_POST['passwordLogin']
                );
                $response = Datos::userLoginModel($datosController);

                //validar la respuesta del modelo para ver si es un usuario válido
                if($response['user']==$_POST['userLogin'] && $response['password']==$_POST['passwordLogin']){
                    session_start();
                    $_SESSION['validate'] = true;
                    header("location:index.php?action=users"); 
                }else{
                    header("location:index.php?action=fallo");
                }
            }
        }

        //VISTA DE USUARIOS
        public function usersViewController(){
            $response = Datos::userViewModel("users");

            foreach($response as $row=> $item){
                echo '<tr>
                    <td>'.$item['user'].'</td>
                    <td>'.$item['password'].'</td>
                    <td>'.$item['email'].'</td>
                    <td><a href="index.php?action=update$id='.$item['id'].'"><button>Editar</button></a></td>
                    <td><a href="index.php?action=users$idDelete='.$item['id'].'"><button>Borrar</button></a></td>
                    </tr>';
            }
        }

        public function userEditController(){
            $datosController = $_GET['id'];
            $response = Datos::userUpdateModel($datosController,"users");
            
            //Diseño de la estructura de un formulario para que se muestren los datos de la consulta generada en el modelo
            echo '<input type="hidden" value="'.$response['id'].'name="idUpdate">
                <input type="text" value="'.$response['user'].'" name="userUpdate" required>
                <input type="text" value="'.$response['password'].'" name="passwordUpdate" required>
                <input type="text" value="'.$response['email'].'" name="emailUpdate" required>
                ';
        }

        //ACTUALIZAR USUARIO
        public function userUpdateController(){
            if(isset($_POST['userEdit'])){
                $datosController = array('id'=>$_POST['idUpdate'],
                                        'user'=>$_POST['userUpdate'],
                                        'password'=>$_POST['passwordUpdate'],
                                        'email'=>$_POST['emailUpdate']);
                
                $response = Datos::userUpdateModel($datosController,'users');

                if($response == "success"){
                    header("location:index.php?action=cambio");
                }else{
                    echo("Error");
                }
            }
        }

        //BORRAR USUARIO
        public function userDeleteController(){
            if(isset($_GET['idDeleteUser'])){
                $datosController = $_GET['idDeleteUser'];

                $response = Datos::userDeleteModel($datosController,'users');

                if($response = "success"){
                    header("location:index.php?action=");
                }else{
                    echo("error");
                }
            }
        }
    }
?>