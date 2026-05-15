<?php


class Core
{
    private $rotas;
    
    public function __construct()
    {
        $this->carregarRotas();
    }

    public function run () 
    { 
        $url = '/';
        
        if (isset($_GET['url'])) {
            $url .= $_GET['url'];
        }

        if ($url != '/') {
            $url = rtrim($url, '/');
        }

        $rotaEncontrada = false;

        foreach ( $this->rotas as $caminho => $acao) {

            $regex = '#^'.preg_replace('/{id}/', '(\w+)', $caminho).'$#';

            if (preg_match($regex, $url, $matches)) {
                array_shift($matches);

                $rotaEncontrada = true;

                [$controllerAtual, $funcao] = explode('@', $acao);

                require_once __DIR__."/../controllers/{$controllerAtual}.php";

                $newController = new $controllerAtual();
                $newController->$funcao($matches);
            }

        }
        if (!$rotaEncontrada) {
            require_once __DIR__."/../views/404.php";
        }

    }

    private function carregarRotas ()
    {
        $caminho = __DIR__.'/../routes/rotas.php';

        if (!file_exists($caminho)) {
            die("Arquivo de rotas não encontrado! Caminho: {$caminho}");
        }

        require_once($caminho);

        $this->rotas = $rotas;

    }
}