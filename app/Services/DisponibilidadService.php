<?php

namespace App\Services;

class DisponibilidadService
{
    /**
     * Datos de ejemplo de auxiliares/trabajadores
     */
    private function obtenerAuxiliaresEjemplo()
    {
        return [
            ['id' => 1, 'nombre' => 'Juan', 'apellidos' => 'Pérez García', 'usuario' => 'juan.perez', 'carga' => 30],
            ['id' => 2, 'nombre' => 'Carla', 'apellidos' => 'Ruiz López', 'usuario' => 'carla.ruiz', 'carga' => 15],
            ['id' => 3, 'nombre' => 'Luis', 'apellidos' => 'Gómez Martínez', 'usuario' => 'luis.gomez', 'carga' => 40],
            ['id' => 4, 'nombre' => 'María', 'apellidos' => 'Sánchez Flores', 'usuario' => 'maria.sanchez', 'carga' => 25],
            ['id' => 5, 'nombre' => 'Roberto', 'apellidos' => 'Fernández Díaz', 'usuario' => 'roberto.fern', 'carga' => 50],
            ['id' => 6, 'nombre' => 'Sofía', 'apellidos' => 'Torres Castillo', 'usuario' => 'sofia.torres', 'carga' => 10],
            ['id' => 7, 'nombre' => 'Diego', 'apellidos' => 'Morales Ramos', 'usuario' => 'diego.morales', 'carga' => 35],
            ['id' => 8, 'nombre' => 'Laura', 'apellidos' => 'Quispe Huanca', 'usuario' => 'laura.quispe', 'carga' => 20],
        ];
    }

    /**
     * Clasifica estado según porcentaje de carga
     */
    private function clasificarEstado($porcentaje)
    {
        if ($porcentaje < 50) return 'disponible';
        if ($porcentaje < 80) return 'moderado';
        return 'ocupado';
    }

    /**
     * Obtiene auxiliares ordenados por disponibilidad (sin BD)
     */
    public function obtenerMasDisponibles($cantidad = 10, $filtroRol = null)
    {
        $auxiliares = $this->obtenerAuxiliaresEjemplo();
        $capacidadMaxima = 40;

        // Mapear y enriquecer con datos de carga
        $resultado = array_map(function ($aux) use ($capacidadMaxima) {
            $porcentaje = ($aux['carga'] / $capacidadMaxima) * 100;
            return [
                'id' => $aux['id'],
                'nombre' => $aux['nombre'],
                'apellidos' => $aux['apellidos'],
                'usuario' => $aux['usuario'],
                'trabajos_activos' => rand(1, 3),
                'trabajos_en_curso' => rand(0, 2),
                'horas_actuales' => $aux['carga'],
                'capacidad_maxima' => $capacidadMaxima,
                'porcentaje' => round($porcentaje, 2),
                'estado' => $this->clasificarEstado($porcentaje),
            ];
        }, $auxiliares);

        // Ordenar por carga (menor carga = más disponible)
        usort($resultado, function ($a, $b) {
            return $a['horas_actuales'] <=> $b['horas_actuales'];
        });

        // Limitar cantidad
        return array_slice($resultado, 0, (int)$cantidad);
    }

    /**
     * Obtiene sugerencia de auxiliar más disponible
     */
    public function sugerirAuxiliar($trabajo_id = null)
    {
        $disponibles = $this->obtenerMasDisponibles(1);
        return $disponibles[0] ?? null;
    }

    /**
     * Retorna reporte de disponibilidad por equipo
     */
    public function reporteDisponibilidad()
    {
        $todos = $this->obtenerMasDisponibles(100);

        $porEstado = [
            'disponible' => [],
            'moderado' => [],
            'ocupado' => [],
        ];

        foreach ($todos as $usr) {
            $porEstado[$usr['estado']][] = $usr;
        }

        return [
            'resumen' => [
                'disponible' => count($porEstado['disponible']),
                'moderado' => count($porEstado['moderado']),
                'ocupado' => count($porEstado['ocupado']),
            ],
            'detalle' => $porEstado,
        ];
    }
}
