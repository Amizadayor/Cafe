<?php

namespace App\Controllers\API;

use App\Models\ProductoModel;
use CodeIgniter\RESTful\ResourceController;

class Producto extends ResourceController
{
    public function __construct()
    {
        $this->model = $this->setModel(new ProductoModel());
    }

    //METODO GET

    public function index()
    {
        $producto = $this->model->findAll();
        return $this->respond($producto);
    }

    public function show($Id = null)
    {
        try {
            if ($Id == null)
                return $this->respuesta(null,'Se esperaba un Id',404);
            $productoVerificado = $this->model->find($Id);
            if ($productoVerificado==null)
                return $this->respuesta(null,'No se ha encontrado el cliente con ID : '. $Id,404);
            else
                return $this->respuesta($productoVerificado,'',200);
        } catch (\Exception $e) {
            return $this->failServerError('Ha ocurrido un error en el servidor');
        }
    }

    //METODO CREATE

    public function create()
    {
        try {
            $producto = $this->request->getJSON();
            if ($this->model->insert($producto)) :
                $producto->id = $this->model->insertId(); // Checar la funcion de esta linea de codigo
                return $this->respondCreated($producto);
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
            $productoVerificado = $this->model->find($Id);
            if ($productoVerificado == null)
                return $this->failNotFound('No se ha encontrado el cliente con ID : ' . $Id, 404);
            $producto = $this->request->getJSON();
            if ($this->model->update($Id, $producto)) :
                $producto->Id = $Id;
                return $this->respondUpdated($producto);
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
            $productoVerificado = $this->model->find($Id);
            if ($productoVerificado==null)
                return $this->failNotFound('No se ha encontrado el cliente con ID : '. $Id, 404);
            if ($this->model->delete($Id)):
                return $this->respondDeleted($productoVerificado);
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
