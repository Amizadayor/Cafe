<?php namespace App\Models;

use CodeIgniter\Model;

class ProductoModel extends Model{

    protected $table = 'producto';
    protected $primaryKey = 'Id';
    protected $returnType = 'array';
    protected $allowedFields = ['Nombre','Precio','Volumen','categoria_id'];

//VALIDACIÓN DE CADA SECCIÓN DE LA TABLA DE PRODUCTO

    protected $validationRules = [
        'Nombre' => 'required|alpha_space|min_length[3]|max_length[255]',
        'Precio' => 'required|alpha_numeric_space|min_length[2]|max_length[20]',
        'Volumen' => 'required|alpha_numeric_space|min_length[2]|max_length[20]',
        'categoria_id' => 'required|alpha_numeric_space|min_length[1]|max_length[20]',

    ];

//VALIDACIÓN DE LA SECCIÓN DE NOMBRES

    protected $validationMessages = [
        'Nombre' => [
            'valid_nombre' => 'Ingrese un nombre'
        ]
    ];

//VALIDACIÓN PARA QUE EL USUARIO NO SE SALTE EL PASO ANTERIOR
    protected $skipValidation = false;
}