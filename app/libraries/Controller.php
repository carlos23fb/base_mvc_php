<?php
    // Cargando el modelo y la vista
    class Controller {

        public function model($model){

            // Requiriendo el archivo del modelo
            require_once '../app/models/' . $model . '.php';

            // Instanciando el modelo
            return new $model();
        }


        // Cargando la vista (verificando si existe el archivo)
        public function view($view, $data = []){
            if(file_exists('../app/views/' . $view . '.php')){
                require_once '../app/views/' . $view . '.php';
            }else{
                die(' La Vista no existe');
            }
        }
    }