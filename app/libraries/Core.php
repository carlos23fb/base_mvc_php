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

                // Declarar el nuevo controlador
                $this->currentController = ucwords($url[0]);
                unset($url[0]);
            }

            // Requiriendo el controlador en caso de que exsita
            require_once '../app/controllers/' . $this->currentController . '.php';
            $this->currentController = new $this->currentController;


            // Verificando si hay una segunda parte en la url
            if (isset($url[1])){
                if (method_exists($this->currentController, $url[1])){
                    $this->currentMethod = $url[1];
                    unset($url[1]);
                }
            }

            // Obtener parametros
            $this->params = $url ? array_values($url) : [];

            // Hacer la llamada al metodo con un arreglo de parametros
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);

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