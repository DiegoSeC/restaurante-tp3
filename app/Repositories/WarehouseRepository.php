<?php

namespace App\Repositories;


class WarehouseRepository extends AbstractRepository
{


    const MAIN_RESOURCE = '/warehouses';

    /**
     * @return mixed
     */
    protected function baseUrl()
    {
        return env('BACKEND_COMPONENT_BASE_URL');
    }

    /**
     * @param array $data
     * @param bool $json
     * @return string
     */
    public function getAll($data = [], $json = true)
    {
        $url = $this->buildUrl(self::MAIN_RESOURCE);
        return $this->clientGet($url, $data, $json);
    }

}