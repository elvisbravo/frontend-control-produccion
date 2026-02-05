<?php

namespace App\Models;

use CodeIgniter\Model;

class PermisoTipoModel extends Model
{
    protected $table      = 'permiso_tipos';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType       = 'array';
    protected $allowedFields    = [
        'nombre',
        'descripcion',
        'es_remunerado',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Obtiene todos los tipos activos
     */
    public function getActive()
    {
        return $this->orderBy('nombre', 'ASC')->findAll();
    }
}
