<?php

namespace App\Http\Controllers;

use App\Repositories\TransferGuideRepository;;
use Illuminate\Http\Request;

class TransferGuideController extends Controller
{

    private $transferGuideRepository;

    public function __construct(TransferGuideRepository $transferGuideRepository)
    {
        $this->transferGuideRepository = $transferGuideRepository;
    }


    /**
     * @param Request $request
     * @return string
     */
    public function index(Request $request) {
        return $this->transferGuideRepository->getAll($request->all());
    }

    /**
     * @param $uuid
     * @return string
     */
    public function get($uuid) {
        return $this->transferGuideRepository->getByUuid($uuid);
    }

    /**
     * @param Request $request
     * @return string
     */
    public function post(Request $request) {
        return $this->transferGuideRepository->create($request->all());
    }

    /**
     * @param Request $request
     * @param $uuid
     * @return string
     */
    public function put(Request $request, $uuid) {
        return $this->transferGuideRepository->update($uuid, $request->all());
    }

    /**
     * @param Request $request
     * @param $uuid
     * @return mixed
     */
    public function patch(Request $request, $uuid) {
        return $this->transferGuideRepository->updatePartially($uuid, $request->all());
    }

    /**
     * @param $uuid
     * @return mixed
     */
    public function delete($uuid) {
        return $this->transferGuideRepository->delete($uuid);
    }


}
