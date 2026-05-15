<?php

class UsuarioController
{
    public function index ()
    {
        echo "Usuario Controller";
    }

    public function visualizar ($id)
    {
        echo "visualizar Usuário: ". $id[0];
    }


}