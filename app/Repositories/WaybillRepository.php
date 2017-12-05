<?php

namespace App\Repositories;


class WaybillRepository extends AbstractRepository
{

    const MAIN_RESOURCE = '/waybills';
    const ITEM_UUID_RESOURCE = '/waybills/%s';
    const ITEMS_CARRIER_UUID_RESOURCE = '/carriers/%s/waybills';
    const BATCH_UPDATE_RESOURCE = '/waybills/batch-update';

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
    public function getAll($data = [], $json = true) {
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

    /**
     * @param $data
     * @param bool $json
     * @return string
     */
    public function create($data, $json = true) {
        $url = $this->buildUrl(self::MAIN_RESOURCE);
        return $this->clientPost($url, $data, $json);
    }

    /**
     * @param $uuid
     * @param $data
     * @param bool $json
     * @return string
     */
    public function update($uuid, $data, $json = true) {
        $url = $this->buildUrl(self::ITEM_UUID_RESOURCE, $uuid);
        return $this->clientPut($url, $data, $json);
    }

    /**
     * @param $uuid
     * @param $data
     * @param bool $json
     * @return mixed
     */
    public function updatePartially($uuid, $data, $json = true) {
        $url = $this->buildUrl(self::ITEM_UUID_RESOURCE, $uuid);
        return $this->clientPatch($url, $data, $json);
    }

    /**
     * @param $uuid
     * @return mixed
     */
    public function delete($uuid) {
        $url = $this->buildUrl(self::ITEM_UUID_RESOURCE, $uuid);
        return $this->clientDelete($url);
    }

    /**
     * @param $uuid
     * @param bool $json
     * @return string
     */
    public function getByCarrierUuid($uuid, $json = true) {
        $url = $this->buildUrl(self::ITEMS_CARRIER_UUID_RESOURCE, $uuid);
        return $this->clientGet($url, [], $json);
    }

    /**
     * @param $data
     * @param bool $json
     * @return string
     */
    public function batchUpdate($data, $json = true) {
        $url = $this->buildUrl(self::BATCH_UPDATE_RESOURCE);
        return $this->clientPut($url, $data, $json);
    }
}