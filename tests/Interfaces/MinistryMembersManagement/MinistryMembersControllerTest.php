<?php

namespace Tests\Interfaces\MinistryMembersManagement;

use App\Interfaces\MinistryMembersManagement\Controllers\MinistryMembersController;
use Jacksonsr45\RadiantPHP\Http\Message\Interfaces\RequestInterface;
use Jacksonsr45\RadiantPHP\Http\Message\Interfaces\ResponseInterface;
use Jacksonsr45\RadiantPHP\Http\Message\Request;
use PHPUnit\Framework\TestCase;

class MinistryMembersControllerTest extends TestCase
{
    private ResponseInterface $response;
    private RequestInterface $request;
    private MockMinistryMembersService $serviceMock;
    private MinistryMembersController $controller;

    public function setUp(): void
    {
        $this->serviceMock = new MockMinistryMembersService();

        $this->request = new Request('POST', 'http://localhost/members/John Doe');
        $this->controller = new MinistryMembersController(
            $this->serviceMock
        );

        $requestJson = json_encode(['name' => 'John Doe', 'skills' => ['bass'], 'availability' => ['Friday']]);
        $this->request->withHeader('Content-Type', 'application/json')->withJson($requestJson);
        $this->controller->register($this->request);

        $requestJson = json_encode(['name' => 'First Name', 'skills' => ['guitar'], 'availability' => ['Monday']]);
        $this->request->withHeader('Content-Type', 'application/json')->withJson($requestJson);
        $this->controller->register($this->request);

        $requestJson = json_encode(['name' => 'Secund Name', 'skills' => ['guitar'], 'availability' => ['Monday']]);
        $this->request->withHeader('Content-Type', 'application/json')->withJson($requestJson);
        $this->controller->register($this->request);
    }

    public function testIndexShouldReturnAllMembersData(): void
    {
        $this->response = $this->controller->index();

        $expectedData = json_encode(['data' => [
            ["id" => "", "name" => "John Doe", "skills" => ["Bass"], "availability" => ["Friday"]],
            ["id" => "", "name" => "First Name", "skills" => ["Guitar"], "availability" => ["Monday"]],
            ["id" => "", "name" => "Secund Name", "skills" => ["Guitar"], "availability" => ["Monday"]]
        ]]);
        $this->assertEquals(json_decode($expectedData), $this->response->getJson());
    }

    public function testShowByNameShouldReturnMemberData(): void
    {
        $requestJson = json_encode(['name' => 'John Doe']);
        $this->request->withHeader('Content-Type', 'application/json')->withJson($requestJson);
        $this->response = $this->controller->showByName($this->request);

        $expectedData = json_encode(
            [
                'data' => [
                    'id' => '',  'name' => 'John Doe', 'skills' => ['Bass'], 'availability' => ['Friday']
                ]
            ]
        );

        $this->assertEquals(json_decode($expectedData), $this->response->getJson());
    }

    public function testShowBySkillsShouldReturnMembersData(): void
    {
        $requestJson = json_encode(['skills' => ['Guitar']]);
        $this->request->withHeader('Content-Type', 'application/json')->withJson($requestJson);
        $this->response = $this->controller->showBySkills($this->request);

        $expectedData = json_encode(
            [
                'data' => [
                    ["id" => "", "name" => "First Name", "skills" => ["Guitar"], "availability" => ["Monday"]],
                    ["id" => "", "name" => "Secund Name", "skills" => ["Guitar"], "availability" => ["Monday"]]
                ]
            ]
        );
        $this->assertEquals(json_decode($expectedData), $this->response->getJson());
    }

    public function testShowByAvailabilityShouldReturnMembersData(): void
    {
        $requestJson = json_encode(['availability' => ['Friday']]);
        $this->request->withHeader('Content-Type', 'application/json')->withJson($requestJson);
        $this->response = $this->controller->showByAvailability($this->request);

        $expectedData = json_encode(
            [
                'data' => array([
                    'id' => '',  'name' => 'John Doe', 'skills' => ['Bass'], 'availability' => ['Friday']
                ])
            ]
        );

        $this->assertEquals(json_decode($expectedData), $this->response->getJson());
    }

    public function testRegisterShouldReturnSuccessMessage(): void
    {
        $requestJson = json_encode(['name' => 'John Doe', 'skills' => ['bass'], 'availability' => ['Friday']]);
        $this->request->withHeader('Content-Type', 'application/json')->withJson($requestJson);
        $this->response = $this->controller->register($this->request);

        $expectedData = json_encode(['data' => 'Member registered successfully!']);

        $this->assertEquals(json_decode($expectedData), $this->response->getJson());
    }

    public function testUpdateShouldReturnSuccessMessage(): void
    {
        $requestJson = json_encode([
            'id' => '', 'name' => 'John Doe Updated', 'skills' => ['bass'], 'availability' => ['Friday']
        ]);
        $this->request->withHeader('Content-Type', 'application/json')->withJson($requestJson);
        $this->response = $this->controller->update($this->request);

        $expectedData = json_encode(['data' => 'Member updated successfully!']);

        $this->assertEquals(json_decode($expectedData), $this->response->getJson());
    }

    public function testDeleteShouldReturnSuccessMessage(): void
    {
        $requestJson = json_encode([
            'id' => '', 'name' => null, 'skills' => [], 'availability' => []
        ]);
        $this->request->withHeader('Content-Type', 'application/json')->withJson($requestJson);
        $this->response = $this->controller->delete($this->request);

        $expectedData = json_encode(['data' => 'Member deleted successfully!']);

        $this->assertEquals(json_decode($expectedData), $this->response->getJson());
    }
}
