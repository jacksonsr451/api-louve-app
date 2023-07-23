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
    protected MinistryMembersServiceInterface $service;

    public function __construct(
        Request $request,
        Response $response,
        MinistryMembersServiceInterface $service
    ) {
        parent::__construct($request, $response, $service);
        $this->service = $service;
    }

    public function index(): Response
    {
        try {
            return $this->response
                ->setStatusCode(200)
                ->sendJson(["data" => $this->service->getAll()]);
        } catch (Exception $ex) {
            return $this->response
                ->setStatusCode(500)
                ->sendJson(["error" => $ex->getMessage()]);
        }
    }

    public function showByName(): Response
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
            return $this->response;
        } catch (Exception $ex) {
            $this->response->setStatusCode(500);
            $this->response->sendJson(["error" => $ex->getMessage()]);
            return $this->response;
        }
    }

    public function showBySkills(): Response
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
            return $this->response;
        } catch (Exception $ex) {
            $this->response->setStatusCode(500);
            $this->response->sendJson(["error" => $ex->getMessage()]);
            return $this->response;
        }
    }

    public function showByAvailability(): Response
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
            return $this->response;
        } catch (Exception $ex) {
            $this->response->setStatusCode(500);
            $this->response->sendJson(["error" => $ex->getMessage()]);
            return $this->response;
        }
    }

    public function register(): Response
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
            return $this->response;
        } catch (Exception $ex) {
            $this->response->setStatusCode(500);
            $this->response->sendJson(["error" => $ex->getMessage()]);
            return $this->response;
        }
    }

    public function update(): Response
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
            return $this->response;
        } catch (Exception $ex) {
            $this->response->setStatusCode(500);
            $this->response->sendJson(["error" => $ex->getMessage()]);
            return $this->response;
        }
    }

    public function delete(): Response
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
            return $this->response;
        } catch (Exception $ex) {
            $this->response->setStatusCode(500);
            $this->response->sendJson(["error" => $ex->getMessage()]);
            return $this->response;
        }
    }
}
