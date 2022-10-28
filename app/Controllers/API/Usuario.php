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

    public function show($Id = null)
    {
        try {
            if ($Id == null)
                return $this->respuesta(null,'Se esperaba un Id',404);
            $usuarioVerificado = $this->model->find($Id);
            if ($usuarioVerificado==null)
                return $this->respuesta(null,'No se ha encontrado el cliente con ID : '. $Id,404);
            else
                return $this->respuesta($usuarioVerificado,'',200);
        } catch (\Exception $e) {
            return $this->failServerError('Ha ocurrido un error en el servidor');
        }
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
                return $this->failValidationErrors('No se ha pasado un ID válido', 404); //Nota: No muestra el comentario de error cuando no hay ningun ID
            $usuarioVerificado = $this->model->find($Id);
            if ($usuarioVerificado == null)
                return $this->failNotFound('No se ha encontrado el cliente con ID : ' . $Id, 404);
            $usuario = $this->request->getJSON();
            if ($this->model->update($Id, $usuario)) :
                $usuario->Id = $Id;
                return $this->respondUpdated($usuario);
            else :
                return $this->failValidationErrors($this->model->validation->listErrors());
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
                return $this->failValidationErrors('No se ha pasado un ID válido');
            $usuarioVerificado = $this->model->find($Id);
            if ($usuarioVerificado==null)
                return $this->failNotFound('No se ha encontrado el cliente con ID : '. $Id, 404);
            if ($this->model->delete($Id)):
                return $this->respondDeleted($usuarioVerificado);
            else:
                return $this->failServerError('No se ha podido eliminar el registro con ID : '.$Id, 404);
            endif;
        } catch (\Exception $e) {
            return $this->failServerError('Ha ocurrido un error en el servidor');
        }
    }

    //METODO DE RESPUESTA

    public function respuesta ($data, $mensaje, $codigo){
        if ($codigo == 200){
            return $this->respond(array(
                "status" => $codigo,
                "data" => $data
            ));
        }else{
            return $this->respond(array(
                "status" => $codigo,
                "mensaje" => $mensaje
            ));
        }
    }
}
