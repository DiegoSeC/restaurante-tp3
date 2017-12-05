<?php

namespace App\Repositories;


class TruckRepository extends AbstractRepository
{

    const MAIN_RESOURCE = '/trucks';

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