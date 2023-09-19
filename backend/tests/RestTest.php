<?php namespace Tests;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\Response;
use CodeIgniter\RESTful\ResourceController;

class RestTest extends CIUnitTestCase
{
    public function testRestAccess()
    {
        // Simula uma requisição GET para o endpoint de teste no controlador REST
        $controller = new \App\Controllers\Teste(); // Substitua pelo caminho do seu controlador REST
        $request = new IncomingRequest();
        $request->setMethod('get');
        $response = new Response($request);

        $output = $controller->test();

        // Verifica se a resposta contém a palavra "success"
        $this->assertStringContainsString('success', $output->getBody());
    }

    public function testRestAuthentication()
    {
        // Simula uma requisição POST com dados de autenticação inválidos
        $controller = new \App\Controllers\Rest(); // Substitua pelo caminho do seu controlador REST
        $request = new IncomingRequest();
        $request->setMethod('post');
        $request->setJSON(['username' => 'invalid', 'password' => 'invalid']);
        $response = new Response($request);

        $output = $controller->auth();

        // Verifica se a resposta contém a mensagem de erro de autenticação
        $this->assertStringContainsString('Authentication failed', $output->getBody());
    }
}
