<?php

namespace App\Interfaces\MinistryMembersManagement\Controllers;

use App\Application\MinistryMembersManagement\Contracts\MinistryMembersServiceInterface;
use App\Application\MinistryMembersManagement\DTOs\MemberDTO;
use App\Interfaces\Controller;
use Exception;
use Jacksonsr45\RadiantPHP\Http\Request;
use Jacksonsr45\RadiantPHP\Http\Response;

class MinistryMembersController extends Controller
{
    private MinistryMembersServiceInterface $service;

    public function __construct(
        Request $request,
        Response $response,
        MinistryMembersServiceInterface $service
    ) {
        parent::__construct($request, $response, $service);
    }

    public function index(): void
    {
        try {
            $this->response->setStatusCode(200);
            $this->response->sendJson(["data" => $this->service->getAll()]);
        } catch (Exception $ex) {
            $this->response->setStatusCode(500);
            $this->response->sendJson(["error" => $ex->getMessage()]);
        }
    }

    public function showByName(): void
    {
        try {
            $request = $this->request->getJson();
            $data = $this->service->getByName(
                new MemberDTO(
                    null,
                    $request->name,
                    [],
                    []
                )
            );
            $this->response->setStatusCode(200);
            $this->response->sendJson(["data" => $data]);
        } catch (Exception $ex) {
            $this->response->setStatusCode(500);
            $this->response->sendJson(["error" => $ex->getMessage()]);
        }
    }

    public function showBySkills(): void
    {
        try {
            $request = $this->request->getJson();
            $data = $this->service->getBySkills(
                new MemberDTO(
                    null,
                    null,
                    $request->skills,
                    []
                )
            );
            $this->response->setStatusCode(200);
            $this->response->sendJson(["data" => $data]);
        } catch (Exception $ex) {
            $this->response->setStatusCode(500);
            $this->response->sendJson(["error" => $ex->getMessage()]);
        }
    }

    public function showByAvailability(): void
    {
        try {
            $request = $this->request->getJson();
            $data = $this->service->getByAvailability(
                new MemberDTO(
                    null,
                    null,
                    [],
                    $request->availability
                )
            );
            $this->response->setStatusCode(200);
            $this->response->sendJson(["data" => $data]);
        } catch (Exception $ex) {
            $this->response->setStatusCode(500);
            $this->response->sendJson(["error" => $ex->getMessage()]);
        }
    }

    public function register(): void
    {
        try {
            $request = $this->request->getJson();
            $this->service->registerMember(
                new MemberDTO(
                    null,
                    $request->name,
                    $request->skills,
                    $request->availability
                )
            );
            $this->response->setStatusCode(200);
            $this->response->sendJson(["data" => "Member registered successfully!"]);
        } catch (Exception $ex) {
            $this->response->setStatusCode(500);
            $this->response->sendJson(["error" => $ex->getMessage()]);
        }
    }

    public function update(): void
    {
        try {
            $request = $this->request->getJson();
            $this->service->updateMember(
                new MemberDTO(
                    $request->id,
                    $request->name,
                    $request->skills,
                    $request->availability
                )
            );
            $this->response->setStatusCode(200);
            $this->response->sendJson(["data" => "Member updated successfully!"]);
        } catch (Exception $ex) {
            $this->response->setStatusCode(500);
            $this->response->sendJson(["error" => $ex->getMessage()]);
        }
    }

    public function delete(): void
    {
        try {
            $request = $this->request->getJson();
            $this->service->removeMember(
                new MemberDTO(
                    $request->id,
                    null,
                    [],
                    []
                )
            );
            $this->response->setStatusCode(200);
            $this->response->sendJson(["data" => "Member deleted successfully!"]);
        } catch (Exception $ex) {
            $this->response->setStatusCode(500);
            $this->response->sendJson(["error" => $ex->getMessage()]);
        }
    }
}
