<?php

namespace App\Controllers\API;

use App\Models\UsuarioModel;
use CodeIgniter\RESTful\ResourceController;

class Usuario extends ResourceController
{
    public function __construct()
    {
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
            if ($this->model->insert($usuario)) :
                $usuario->id = $this->model->insertId(); // Checar la funcion de esta linea de codigo
                return $this->respondCreated($usuario);
            else :
                return $this->failValidationErrors($this->model->validation->listErrors());
            endif;
        } catch (\Exception $e) {
            return $this->failServerError('Ha ocurrido un error en el servidor');
        }
    }

    //METODO UPDATE

    public function update($Id = null)
    {
        try {
            if ($Id == null)
                return $this->failValidationError('No se ha pasado un ID válido'); //Nota: No muestra el comentario de error cuando no hay ningun ID
            $usuarioVerificado = $this->model->find($Id);
            if ($usuarioVerificado == null)
                return $this->failNotFound('No se ha encontrado el cliente con ID : ' . $Id);
            $usuario = $this->request->getJSON();
            if ($this->model->update($Id, $usuario)) :
                $usuario->Id = $Id;
                return $this->respondUpdated($usuario);
            else :
                return $this->failValidationError($this->model->validation->listErrors());
            endif;
        } catch (\Exception $e) {
            return $this->failServerError('Ha ocurrido un error en el servidor');
        }
    }

    //METODO DELETE

    public function delete($Id = null)
    {
        try {
            if ($Id == null)
                return $this->failValidationError('No se ha pasado un ID válido');
            $usuarioVerificado = $this->model->find($Id);
            if ($usuarioVerificado==null)
                return $this->failNotFound('No se ha encontrado el cliente con ID : '. $Id);
            if ($this->model->delete($Id)):
                return $this->respondDeleted($usuarioVerificado);
            else:
                return $this->failServerError('No se ha podido eliminar el registro con ID : '.$Id);
            endif;
        } catch (\Exception $e) {
            return $this->failServerError('Ha ocurrido un error en el servidor');
        }
    }
}
