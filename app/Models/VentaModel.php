<?php namespace App\Models;

use CodeIgniter\Model;

class VentaModel extends Model{

    protected $table = 'venta';
    protected $primaryKey = 'Id';
    protected $returnType = 'array';
    protected $allowedFields = ['usuario_id',
                                'carrito_id',
                                'Total'];

//VALIDACIÓN DE CADA SECCIÓN DE LA TABLA DE USUARIO

    protected $validationRules = [
        'usuario_id' => 'required|is_natural_no_zero',
        'carrito_id' => 'required|is_natural_no_zero',
        'Total' => 'required|alpha_space|min_length[2]|max_length[50]',
    ];

//VALIDACIÓN DE LA SECCIÓN DE CORREO Y CONTRASEÑA

    protected $validationMessages = [
        'usuario_id' => [
            'valid_usuario_id' => 'Ingrese un usuario valido'
        ],
        'carrito_id' => [
            'valid_carrito_id' => 'Ingrese una compra valida'
        ],
        'Total' => [
            'valid_Total' => 'Ingrese un Total valido'
        ]
    ];

//VALIDACIÓN PARA QUE EL USUARIO NO SE SALTE EL PASO ANTERIOR
    protected $skipValidation = false;
}