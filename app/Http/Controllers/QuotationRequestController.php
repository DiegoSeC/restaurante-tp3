<?php

namespace App\Http\Controllers;

use App\Repositories\QuotationRequestRepository;
use Illuminate\Http\Request;

class QuotationRequestController extends Controller
{

    private $quotationRequestRepository;

    /**
     * QuotationRequestController constructor.
     * @param QuotationRequestRepository $quotationRequestRepository
     */
    public function __construct(QuotationRequestRepository $quotationRequestRepository)
    {
        $this->quotationRequestRepository = $quotationRequestRepository;
    }

    /**
     * @param Request $request
     * @return string
     */
    public function index(Request $request) {
        return $this->quotationRequestRepository->getAll($request->all());
    }

    /**
     * @param $uuid
     * @return string
     */
    public function get($uuid) {
        return $this->quotationRequestRepository->getByUuid($uuid);
    }

    /**
     * @param Request $request
     * @return string
     */
    public function post(Request $request) {
        return $this->quotationRequestRepository->create($request->all());
    }

    /**
     * @param Request $request
     * @param $uuid
     * @return string
     */
    public function put(Request $request, $uuid) {
        return $this->quotationRequestRepository->update($uuid, $request->all());
    }

    /**
     * @param Request $request
     * @param $uuid
     * @return mixed
     */
    public function patch(Request $request, $uuid) {
        return $this->quotationRequestRepository->updatePartially($uuid, $request->all());
    }

    /**
     * @param $uuid
     * @return mixed
     */
    public function delete($uuid) {
        return $this->quotationRequestRepository->delete($uuid);
    }
}
