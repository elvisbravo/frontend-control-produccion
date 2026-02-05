<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PermisoTipoSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['nombre' => 'Salud', 'descripcion' => 'Permiso por cita médica o motivos de salud', 'es_remunerado' => 1],
            ['nombre' => 'Personal', 'descripcion' => 'Permiso por motivos personales', 'es_remunerado' => 0],
            ['nombre' => 'Maternidad', 'descripcion' => 'Permiso de maternidad', 'es_remunerado' => 1],
            ['nombre' => 'Paternidad', 'descripcion' => 'Permiso de paternidad', 'es_remunerado' => 1],
            ['nombre' => 'Vacaciones', 'descripcion' => 'Permiso de vacaciones', 'es_remunerado' => 1],
            ['nombre' => 'Familiar', 'descripcion' => 'Permiso por evento familiar (fallecimiento, boda, etc)', 'es_remunerado' => 1],
            ['nombre' => 'Estudio', 'descripcion' => 'Permiso para cursos o estudios', 'es_remunerado' => 0],
            ['nombre' => 'Otro', 'descripcion' => 'Otro tipo de permiso', 'es_remunerado' => 0],
        ];

        $this->db->table('permiso_tipos')->insertBatch($data);
    }
}
