<?php

namespace App\Http\Controllers;

use App\Repositories\OrderRepository;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    private $orderRepository;

    /**
     * OrderController constructor.
     * @param OrderRepository $orderRepository
     */
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * @param Request $request
     * @return string
     */
    public function index(Request $request) {
        return $this->orderRepository->getAll($request->all());
    }

    /**
     * @param $uuid
     * @return string
     */
    public function get($uuid) {
        return $this->orderRepository->getByUuid($uuid);
    }

    /**
     * @param Request $request
     * @return string
     */
    public function post(Request $request) {
        return $this->orderRepository->create($request->all());
    }

    /**
     * @param Request $request
     * @param $uuid
     * @return string
     */
    public function put(Request $request, $uuid) {
        return $this->orderRepository->update($uuid, $request->all());
    }

    /**
     * @param Request $request
     * @param $uuid
     * @return mixed
     */
    public function patch(Request $request, $uuid) {
        return $this->orderRepository->updatePartially($uuid, $request->all());
    }

    /**
     * @param $uuid
     * @return mixed
     */
    public function delete($uuid) {
        return $this->orderRepository->delete($uuid);
    }


}
