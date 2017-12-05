<?php

namespace App\Http\Controllers;

use App\Repositories\WaybillRepository;
use Illuminate\Http\Request;

class WaybillController extends Controller
{

    private $waybillRepository;

    /**
     * WaybillController constructor.
     * @param WaybillRepository $waybillRepository
     */
    public function __construct(WaybillRepository $waybillRepository)
    {
        $this->waybillRepository = $waybillRepository;
    }

    /**
     * @param Request $request
     * @return string
     */
    public function index(Request $request) {
        return $this->waybillRepository->getAll($request->all());
    }

    /**
     * @param $uuid
     * @return string
     */
    public function get($uuid) {
        return $this->waybillRepository->getByUuid($uuid);
    }

    /**
     * @param Request $request
     * @return string
     */
    public function post(Request $request) {
        return $this->waybillRepository->create($request->all());
    }

    /**
     * @param Request $request
     * @param $uuid
     * @return string
     */
    public function put(Request $request, $uuid) {
        return $this->waybillRepository->update($uuid, $request->all());
    }

    /**
     * @param Request $request
     * @param $uuid
     * @return mixed
     */
    public function patch(Request $request, $uuid) {
        return $this->waybillRepository->updatePartially($uuid, $request->all());
    }

    /**
     * @param $uuid
     * @return mixed
     */
    public function delete($uuid) {
        return $this->waybillRepository->delete($uuid);
    }

    /**
     * @param $uuid
     * @return string
     */
    public function getByCarrierUuid($uuid) {
        return $this->waybillRepository->getByCarrierUuid($uuid);
    }

    /**
     * @param Request $request
     * @return string
     */
    public function batchUpdate(Request $request) {
        return $this->waybillRepository->batchUpdate($request->all());
    }


}
