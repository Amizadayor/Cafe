<?php namespace App\Models;

use CodeIgniter\Model;

class CarritoModel extends Model{

    protected $table = 'carrito';
    protected $primaryKey = 'Id';
    protected $returnType = 'array';
    protected $allowedFields = ['Productos_comprados',
                                'producto_id'];


//VALIDACIÓN DE CADA SECCIÓN DE LA TABLA DE CARRITO

    protected $validationRules = [
        'Productos_comprados' => 'required|alpha_space|min_length[1]|max_length[100]',
        'producto_id' => 'required|is_natural_no_zero'
    ];

//VALIDACIÓN DE LA SECCIÓN DE CARRITO

protected $validationMessages = [
    'Productos_comprados' => [
        'valid_Productos_comprados' => 'Ingrese un producto comprado'
    ]
];

//VALIDACIÓN PARA QUE EL USUARIO NO SE SALTE EL PASO ANTERIOR
protected $skipValidation = false;
}