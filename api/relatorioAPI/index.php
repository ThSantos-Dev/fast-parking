<?php
// Import do arquivo autoload, que fara as instancias do slim
require_once('vendor/autoload.php');

// Criando um objeto do slim chamado app
$app = new \Slim\App();


// Import do arquivo de configurações do projeto
require_once('../module/config.php');

// Import das controller do projeto


/**_______________           ENDPOINTS           _______________ **/















// Inicializando a API
$app->run();


?>