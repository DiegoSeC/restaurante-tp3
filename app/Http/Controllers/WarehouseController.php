<?php

namespace App\Http\Controllers;


use App\Repositories\WarehouseRepository;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{

    private $warehouseRepository;

    /**
     * WarehouseController constructor.
     * @param WarehouseRepository $warehouseRepository
     */
    public function __construct(WarehouseRepository $warehouseRepository)
    {
        $this->warehouseRepository = $warehouseRepository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request) {
        return $this->warehouseRepository->getAll($request->all());
    }

}
