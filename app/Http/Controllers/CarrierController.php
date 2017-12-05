<?php

namespace App\Http\Controllers;

use App\Repositories\CarrierRepository;
use Illuminate\Http\Request;

class CarrierController extends Controller
{

    private $carrierRepository;

    /**
     * CarrierController constructor.
     * @param CarrierRepository $carrierRepository
     */
    public function __construct(CarrierRepository $carrierRepository)
    {
        $this->carrierRepository = $carrierRepository;
    }

    /**
     * @param Request $request
     * @return string
     */
    public function index(Request $request) {
        return $this->carrierRepository->getAll($request->all());
    }

}
