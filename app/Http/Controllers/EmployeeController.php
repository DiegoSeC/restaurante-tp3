<?php

namespace App\Http\Controllers;

use App\Repositories\EmployeeRepository;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    private $employeeRepository;

    /**
     * EmployeeController constructor.
     * @param EmployeeRepository $employeeRepository
     */
    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    /**
     * @param $uuid
     * @return string
     */
    public function get($uuid) {
        return $this->employeeRepository->getByUuid($uuid);
    }

    /**
     * @param Request $request
     * @return string
     */
    public function getByUserUuid(Request $request) {
        $user = $request->user();
        return $this->employeeRepository->getByUserUuid($user->uuid);
    }


}
