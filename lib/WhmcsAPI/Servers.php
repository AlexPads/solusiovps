<?php

// Copyright 2020. Plesk International GmbH.

namespace WHMCS\Module\Server\SolusIoVps\WhmcsAPI;

use WHMCS\Module\Server\SolusIoVps\Database\Models\Server;
use WHMCS\Module\Server\SolusIoVps\SolusAPI\Resources\ProjectResource;
use WHMCS\Module\Server\SolusIoVps\SolusAPI\Connector;

/**
 * @package WHMCS\Module\Server\SolusIoVps\WhmcsAPI
 */
class Servers
{
    public static function getValidParams(): array
    {
        $serverIds = Server::getServerIds();

        foreach ($serverIds as $serverId) {
            $serverParams = Server::getParams($serverId);

            try {
                $projectResource = new ProjectResource(Connector::create($serverParams));

                $projectResource->list();

                return $serverParams;
            } catch (\Exception $e) {
                return [];
            }
        }
    }
}
