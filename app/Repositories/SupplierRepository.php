<?php

namespace App\Repositories;


class SupplierRepository extends AbstractRepository
{

    const MAIN_RESOURCE = '/suppliers';
    const ITEM_UUID_RESOURCE = '/suppliers/%s';

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

    /**
     * @param $uuid
     * @param bool $json
     * @return string
     */
    public function getByUuid($uuid, $json = true) {
        $url = $this->buildUrl(self::ITEM_UUID_RESOURCE, $uuid);
        return $this->clientGet($url, [], $json);
    }

}