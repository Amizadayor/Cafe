<?php namespace App\Models;

use CodeIgniter\Model;

class CategoriaModel extends Model{

    protected $table = 'categoria';
    protected $primaryKey = 'Id';
    protected $returnType = 'array';
    protected $allowedFields = ['Nombre','Cantidad_disponible'];

//VALIDACIÓN DE CADA SECCIÓN DE LA TABLA DE USUARIO

    protected $validationRules = [
        'Nombre' => 'required|alpha_space|min_length[2]|max_length[255]',
        'Cantidad_disponible' => 'required|alpha_numeric_space|min_length[1]|max_length[10]',
    ];

//VALIDACIÓN DE LA SECCIÓN DE CORREO Y CONTRASEÑA

    protected $validationMessages = [
        'Nombre' => [
            'valid_nombre' => 'Ingrese un nombre'
        ]
    ];

//VALIDACIÓN PARA QUE EL USUARIO NO SE SALTE EL PASO ANTERIOR
    protected $skipValidation = false;
}