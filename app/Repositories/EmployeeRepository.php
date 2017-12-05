<?php

namespace App\Repositories;


class EmployeeRepository extends AbstractRepository
{

    const ITEM_UUID_RESOURCE = '/employees/%s';
    const ITEM_USER_UUID_RESOURCE = '/users/%s/employee';

    /**
     * @return mixed
     */
    protected function baseUrl()
    {
        return env('BACKEND_COMPONENT_BASE_URL');
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

    /**
     * @param $uuid
     * @param bool $json
     * @return string
     */
    public function getByUserUuid($uuid, $json = true) {
        $url = $this->buildUrl(self::ITEM_USER_UUID_RESOURCE, $uuid);
        return $this->clientGet($url, [], $json);
    }

}