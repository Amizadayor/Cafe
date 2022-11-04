<?php

namespace App\Controllers\API;

use App\Models\CarritoModel;
use CodeIgniter\RESTful\ResourceController;

class Carrito extends ResourceController
{
    public function __construct()
    {
        $this->model = $this->setModel(new CarritoModel());
    }

    //METODO GET

    public function index()
    {
        $carrito = $this->model->findAll();
        return $this->respond($carrito);
    }

    public function show($Id = null)
    {
        try {
            if ($Id == null)
                return $this->respuesta(null,'Se esperaba un Id',404);
            $carritoVerificado = $this->model->find($Id);
            if ($carritoVerificado==null)
                return $this->respuesta(null,'No se ha encontrado el Producto con ID : '. $Id,404);
            else
                return $this->respuesta($carritoVerificado,'',200);
        } catch (\Exception $e) {
            return $this->failServerError('Ha ocurrido un error en el servidor');
        }
    }

    //METODO CREATE

    public function create()
    {
        try {
            $carrito = $this->request->getJSON();
            if ($this->model->insert($carrito)) :
                $carrito->id = $this->model->insertId(); // Checar la funcion de esta linea de codigo
                return $this->respondCreated($carrito);
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
            $carritoVerificado = $this->model->find($Id);
            if ($carritoVerificado == null)
                return $this->failNotFound('No se ha encontrado el producto con ID : ' . $Id, 404);
            $carrito = $this->request->getJSON();
            if ($this->model->update($Id, $carrito)) :
                $carrito->Id = $Id;
                return $this->respondUpdated($carrito);
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
            $carritoVerificado = $this->model->find($Id);
            if ($carritoVerificado==null)
                return $this->failNotFound('No se ha encontrado el producto con ID : '. $Id, 404);
            if ($this->model->delete($Id)):
                return $this->respondDeleted($carritoVerificado);
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