<?php

namespace App\Controllers;

class Permisos extends BaseController
{
    public function index()
    {
        if(!session()->get('isLoggedIn')){
            return redirect()->to(base_url());
        }

        return view('permisos/index');
    }

    public function listaRoles()
    {
        $ruta = getenv('URL_BACKEND') . 'permisos/lista-roles';

        $client = \Config\Services::curlrequest();

        $response = $client->get($ruta, [
            'headers' => [
                'Accept' => 'application/json'
            ],
            'http_errors' => false
        ]);

        $data = json_decode($response->getBody(), true);

        if (!$data || $data['status'] == 500) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $data['message']['error']
            ]);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'message' => $data['message'],
            'result' => $data['result']
        ]);
    }

    public function guardarRol()
    {
        $nombreRol = $this->request->getPost('nombreRol');
        $rolId = $this->request->getPost('rolId');

        $ruta = getenv('URL_BACKEND') . 'permisos/crear-rol';

        $client = \Config\Services::curlrequest();

        $response = $client->post($ruta, [
            'headers' => [
                'Accept' => 'application/json'
            ],
            'http_errors' => false,
            'json' => [
                'nombre' => $nombreRol,
                'rolId' => $rolId
            ]
        ]);

        $data = json_decode($response->getBody(), true);

        if (!$data || $data['status'] == 500) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $data['message']['error']
            ]);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'message' => $data['message']
        ]);
    }

    public function eliminarRol($id)
    {
        $ruta = getenv('URL_BACKEND') . 'permisos/eliminar-rol/' . $id;

        $client = \Config\Services::curlrequest();

        $response = $client->get($ruta, [
            'headers' => [
                'Accept' => 'application/json'
            ],
            'http_errors' => false
        ]);

        $data = json_decode($response->getBody(), true);

        if (!$data || $data['status'] == 500) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $data['message']['error']
            ]);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'message' => $data['message']
        ]);
    }

}
