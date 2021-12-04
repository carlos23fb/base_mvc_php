<?php

    //Esta clase ayuda a cambiar dinamicamente el controlador y el motodo en base a la url

    class Core{
        protected $currentController = 'Pages';
        protected $currentMethod = 'index';
        protected $params= [];


        // la funcion __construct se ejecuta cuando se instancia la clase Core en require.php
        public function __construct(){
            $url = $this->getUrl();

            // ucwords convierte Convierte en mayuscula la primer letra de un texto
            // Esta condicional verfica que exista un controlador para la url
            if(file_exists('../app/controllers/' . ucwords($url[0] . '.php'))){
                $this->currentController = ucwords($url[0]);
            }


        }


        // Funcion que me ayuda a obtener la url
        public function getUrl(){
            if(isset($_GET['url'])){
                // Remueve la barra al final de la url
                $url = rtrim($_GET['url'], '/');
                // Remueve caracteres erroneos en la url
                $url = filter_var($url, FILTER_SANITIZE_URL);

                // Convierte la cadena en un arreglo
                $url = explode('/', $url);
                return $url;
            }
        }
    }