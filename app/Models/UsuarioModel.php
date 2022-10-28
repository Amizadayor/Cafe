<?php namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model{

    protected $table = 'usuario';
    protected $primaryKey = 'Id';
    protected $returnType = 'array';
    protected $allowedFields = ['Nombre_1',
                                'Nombre_2',
                                'Apellido_paterno',
                                'Apellido_materno',
                                'Numero_telefono',
                                'Correo',
                                'Password_cliente'];

//VALIDACIÓN DE CADA SECCIÓN DE LA TABLA DE USUARIO

    protected $validationRules = [
        'Nombre_1' => 'required|alpha_space|min_length[3]|max_length[255]',
        'Nombre_2' => 'permit_empty|alpha_space|max_length[255]',
        'Apellido_paterno' => 'required|alpha_space|min_length[3]|max_length[255]',
        'Apellido_materno' => 'required|alpha_space|min_length[3]|max_length[255]',
        'Numero_telefono' => 'required|alpha_numeric_space|min_length[10]|max_length[10]',
        'Correo' => 'required|valid_email|min_length[10]|max_length[50]',
        'Password_cliente' => 'required',
    ];

//VALIDACIÓN DE LA SECCIÓN DE CORREO Y CONTRASEÑA

    protected $validationMessages = [
        'Correo' => [
            'valid_email' => 'Ingrese un correo valido'
        ],
        'Password_cliente' => [
            'valid_password' => 'Ingrese una contraseña mínima de 8 dígitos'
        ]
    ];

//VALIDACIÓN PARA QUE EL USUARIO NO SE SALTE EL PASO ANTERIOR
    protected $skipValidation = false;
}