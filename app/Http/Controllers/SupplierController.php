<?php

namespace App\Http\Controllers;

use App\Repositories\SupplierRepository;
use Illuminate\Http\Request;

class SupplierController extends Controller
{


    private $supplierRepository;

    /**
     * SupplierController constructor.
     * @param SupplierRepository $supplierRepository
     */
    public function __construct(SupplierRepository $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request) {
        return $this->supplierRepository->getAll($request->all());
    }

    /**
     * @param $uuid
     * @return mixed
     */
    public function get($uuid) {
        return $this->supplierRepository->getByUuid($uuid);
    }



}
