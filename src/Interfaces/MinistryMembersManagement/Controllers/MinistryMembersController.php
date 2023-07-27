<?php

namespace App\Interfaces\MinistryMembersManagement\Controllers;

use App\Application\MinistryMembersManagement\Contracts\MinistryMembersServiceInterface;
use App\Application\MinistryMembersManagement\DTOs\MemberDTO;
use Exception;
use Jacksonsr45\RadiantPHP\Http\Message\Interfaces\RequestInterface;
use Jacksonsr45\RadiantPHP\Http\Message\Interfaces\ResponseInterface;
use Jacksonsr45\RadiantPHP\Http\Message\Response;

class MinistryMembersController
{
    private MinistryMembersServiceInterface $service;
    private ResponseInterface $response;

    public function __construct(
        MinistryMembersServiceInterface $service
    ) {
        $this->service = $service;
        $this->response = new Response();
    }

    public function index(): ResponseInterface
    {
        try {
            return $this->response->setStatusCode(200)
                ->withJson(json_encode(["data" => $this->service->getAll()]))
                ->withHeader('Content-Type', 'application/json');
        } catch (Exception $ex) {
            return $this->response
                ->setStatusCode(500)
                ->withJson(json_encode(["error" => $ex->getMessage()]))
                ->withHeader('Content-Type', 'application/json');
        }
    }

    public function showByName(RequestInterface $request): ResponseInterface
    {
        try {
            $request = $request->getJson();
            $data = $this->service->getByName(
                new MemberDTO(
                    null,
                    $request->name,
                    [],
                    []
                )
            );
            return $this->response->setStatusCode(200)
                ->withJson(json_encode(["data" => $data]))
                ->withHeader('Content-Type', 'application/json');
        } catch (Exception $ex) {
            $this->response->setStatusCode(500)
                ->withJson(json_encode(["error" => $ex->getMessage()]))
                ->withHeader('Content-Type', 'application/json');
        }
    }

    public function showBySkills(RequestInterface $request): ResponseInterface
    {
        try {
            $request = $request->getJson();
            $data = $this->service->getBySkills(
                new MemberDTO(
                    null,
                    null,
                    $request->skills,
                    []
                )
            );
            return $this->response->setStatusCode(200)
                ->withJson(json_encode(["data" => $data]))
                ->withHeader('Content-Type', 'application/json');
        } catch (Exception $ex) {
            return $this->response->setStatusCode(500)
                ->withJson(json_encode(["error" => $ex->getMessage()]))
                ->withHeader('Content-Type', 'application/json');
        }
    }

    public function showByAvailability(RequestInterface $request): ResponseInterface
    {
        try {
            $request = $request->getJson();
            $data = $this->service->getByAvailability(
                new MemberDTO(
                    null,
                    null,
                    [],
                    $request->availability
                )
            );
            return $this->response->setStatusCode(200)
                ->withJson(json_encode(["data" => $data]))
                ->withHeader('Content-Type', 'application/json');
        } catch (Exception $ex) {
            return $this->response->setStatusCode(500)
                ->withJson(json_encode(["error" => $ex->getMessage()]))
                ->withHeader('Content-Type', 'application/json');
        }
    }

    public function register(RequestInterface $request): ResponseInterface
    {
        try {
            $request = $request->getJson();
            $this->service->registerMember(
                new MemberDTO(
                    null,
                    $request->name,
                    $request->skills,
                    $request->availability
                )
            );
            return $this->response->setStatusCode(200)
                ->withJson(json_encode(["data" => "Member registered successfully!"]))
                ->withHeader('Content-Type', 'application/json');
        } catch (Exception $ex) {
            return $this->response->setStatusCode(500)
                ->withJson(json_encode(["error" => $ex->getMessage()]))
                ->withHeader('Content-Type', 'application/json');
        }
    }

    public function update(RequestInterface $request): ResponseInterface
    {
        try {
            $request = $request->getJson();
            $this->service->updateMember(
                new MemberDTO(
                    $request->id,
                    $request->name,
                    $request->skills,
                    $request->availability
                )
            );
            return $this->response->setStatusCode(200)
                ->withJson(json_encode(["data" => "Member updated successfully!"]))
                ->withHeader('Content-Type', 'application/json');
        } catch (Exception $ex) {
            return $this->response->setStatusCode(500)
                ->withJson(json_encode(["error" => $ex->getMessage()]))
                ->withHeader('Content-Type', 'application/json');
        }
    }

    public function delete(RequestInterface $request): ResponseInterface
    {
        try {
            $request = $request->getJson();
            $this->service->removeMember(
                new MemberDTO(
                    $request->id,
                    null,
                    [],
                    []
                )
            );
            return $this->response->setStatusCode(200)
                ->withJson(json_encode(["data" => "Member deleted successfully!"]))
                ->withHeader('Content-Type', 'application/json');
        } catch (Exception $ex) {
            return $this->response->setStatusCode(500)
                ->withJson(json_encode(["error" => $ex->getMessage()]))
                ->withHeader('Content-Type', 'application/json');
        }
    }
}
