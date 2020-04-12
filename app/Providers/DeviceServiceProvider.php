<?php

namespace App\Providers;

use App\Models\Device;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

use function config;

/**
 * Class DeviceServiceProvider
 * @package App\Providers
 */
class DeviceServiceProvider extends BasicProvider
{
    //si occupa di prendere i device dal database
    /**
     * @var Client
     */
    private $request;

    /**
     * DeviceServiceProvider constructor.
     */
    public function __construct()
    {
        parent::__construct(app());
        $this->request = new Client([
            'base_uri' => config('app.api') . '/devices',
            'headers' => [
                'Content-Type' => 'application/json'
            ]
        ]);
    }

    /**
     * @param mixed $identifier
     * @return Device
     */
    public function find($identifier)
    {
        try {
            $response = json_decode($this->request->get("/devices/" . $identifier, $this->setHeaders())->getBody());
            $device = new Device();
            $device->fill((array)$response);
            return $device;
        } catch (RequestException $e) {
            $this->isExpired($e);
            abort($e->getCode(), $e->getResponse()->getReasonPhrase());
        }
    }

    /**
     * @return array|null
     */
    public function findAll()
    {
        try {
            $response = json_decode($this->request->get('', $this->setHeaders())->getBody());
            $devices = [];
            foreach ($response as $d) {
                $device = new Device();
                $device->fill((array)$d);
                $devices[] = $device;
            }
            return $devices;
        } catch (RequestException $e) {
            $this->isExpired($e);
            abort($e->getCode(), $e->getResponse()->getReasonPhrase());
        }
    }

    /**
     * @param $entity
     * @return array
     */
    public function findAllFromEntity($entity)
    {
        try {
            $response = json_decode($this->request->get('', array_merge($this->setHeaders(), [
                'query' => ['entityId' => $entity]
            ]))->getBody());
            $devices = [];
            foreach ($response as $d) {
                $device = new Device();
                $device->fill((array)$d);
                $devices[] = $device;
            }
            return $devices;
        } catch (RequestException $e) {
            $this->isExpired($e);
            abort($e->getCode(), $e->getResponse()->getReasonPhrase());
        }
    }

    public function findAllFromGateway($gateway)
    {
        try {
            $response = json_decode($this->request->get('', array_merge($this->setHeaders(), [
                'query' => ['gatewayId' => $gateway]
            ]))->getBody());
            $devices = [];
            foreach ($response as $d) {
                $device = new Device();
                $device->fill((array)$d);
                $devices[] = $device;
            }
            return $devices;
        } catch (RequestException $e) {
            $this->isExpired($e);
            abort($e->getCode(), $e->getResponse()->getReasonPhrase());
        }
    }

    // ===================================================
    // Mockup per un utente
    // Funzione da rimuovere in production

    /**
     * @return Device
     */
    public static function getADevice()
    {
        $device = new Device();
        $arr = array_combine(
            array('deviceId', 'name', 'frequency', 'realDeviceId'),
            array("0", "Potato", "5", "007")
        );
        $device->fill($arr);
        return $device;
    }
}
