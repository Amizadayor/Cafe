<?php

namespace App\Controllers\API;

use App\Models\UsuarioModel;
use CodeIgniter\RESTful\ResourceController;

class Usuario extends ResourceController
{
    public function __construct() {
        $this->model = $this->setModel(new UsuarioModel());
    }

//METODO GET

    public function index()
    {
        $usuario = $this->model->findAll();
        return $this->respond($usuario);
    }

//METODO CREATE

    public function create()
    {
        try {
            $usuario = $this->request->getJSON();
            if ($this->model->insert($usuario)):
                $usuario->id = $this->model->insertId(); // Checar la funcion de esta linea de codigo
                return $this->respondCreated($usuario);
            else:
                return $this->failValidationErrors($this->model->validation->listErrors());
            endif;
        } catch (\Exception $e) {
            return $this->failServerError('Ha ocurrido un error en el servidor');
        }
    }
}
