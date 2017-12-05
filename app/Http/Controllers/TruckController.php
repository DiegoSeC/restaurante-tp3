<?php

namespace App\Http\Controllers;


use App\Repositories\TruckRepository;
use Illuminate\Http\Request;

class TruckController extends Controller
{


    private $truckRepository;

    /**
     * TruckController constructor.
     * @param TruckRepository $truckRepository
     */
    public function __construct(TruckRepository $truckRepository)
    {
        $this->truckRepository = $truckRepository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request) {
        return $this->truckRepository->getAll($request->all());
    }

}
