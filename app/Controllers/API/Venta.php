<?php
namespace App\Controllers\API;

use App\Models\VentaModel;
use CodeIgniter\RESTful\ResourceController;

class Venta  extends ResourceController{
    public function __construct()
    {
        $this->model = $this->setModel(new VentaModel());
    }

    //METODO GET

    public function index()
    {
        $venta = $this->model->findAll();
        return $this->respond($venta);
    }
   //METODO PARA MOSTAR LOS DATOS

    public function show($Id = null)
    {
        try {
            if ($Id == null)
                return $this->respuesta(null,'Se esperaba un Id',404);
            $ventaVerificado = $this->model->find($Id);
            if ($ventaVerificado==null)
                return $this->respuesta(null,'No se ha encontrado la venta con ID : '. $Id,404);
            else
                return $this->respuesta($ventaVerificado,'',200);
        } catch (\Exception $e) {
            return $this->failServerError('Ha ocurrido un error en el servidor');
        }
    }

    //METODO CREATE

    public function create()
    {
        try {
            $venta = $this->request->getJSON();
            if ($this->model->insert($venta)) :
                $venta->id = $this->model->insertId(); // Checar la funcion de esta linea de codigo
                return $this->respondCreated($venta);
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
            $ventaVerificado = $this->model->find($Id);
            if ($ventaVerificado == null)
                return $this->failNotFound('No se ha encontrado la venta con ID : ' . $Id, 404);
            $venta = $this->request->getJSON();
            if ($this->model->update($Id, $venta)) :
                $venta->Id = $Id;
                return $this->respondUpdated($venta);
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
            $ventaVerificado = $this->model->find($Id);
            if ($ventaVerificado==null)
                return $this->failNotFound('No se ha encontrado la venta con ID : '. $Id, 404);
            if ($this->model->delete($Id)):
                return $this->respondDeleted($ventaVerificado);
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