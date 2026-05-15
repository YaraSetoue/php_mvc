<?php

class InicioController extends Controller
{
    public function index ()
    {
        return $this->loadView('inicio');
    }
}