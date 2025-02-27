<?php

declare(strict_types=1);

namespace App\Controller\Api\Stations;

use App\Entity;
use App\Http\Response;
use App\Http\ServerRequest;
use Doctrine\ORM\EntityManagerInterface;
use OpenApi\Annotations as OA;
use Psr\Http\Message\ResponseInterface;

/**
 * @OA\Get(path="/stations",
 *   operationId="getStations",
 *   tags={"Stations: General"},
 *   description="Returns a list of stations.",
 *   parameters={},
 *   @OA\Response(response=200, description="Success",
 *     @OA\JsonContent(type="array",
 *       @OA\Items(ref="#/components/schemas/Api_NowPlaying_Station")
 *     )
 *   )
 * )
 *
 * @OA\Get(path="/station/{station_id}",
 *   operationId="getStation",
 *   tags={"Stations: General"},
 *   description="Return information about a single station.",
 *   @OA\Parameter(ref="#/components/parameters/station_id_required"),
 *   @OA\Response(response=200, description="Success",
 *     @OA\JsonContent(ref="#/components/schemas/Api_NowPlaying_Station")
 *   ),
 *   @OA\Response(response=404, description="Station not found")
 * )
 */
class IndexController
{
    public function __construct(
        protected EntityManagerInterface $em,
        protected Entity\ApiGenerator\StationApiGenerator $stationApiGenerator
    ) {
    }

    public function listAction(ServerRequest $request, Response $response): ResponseInterface
    {
        $stations_raw = $this->em->getRepository(Entity\Station::class)
            ->findBy(['is_enabled' => 1]);

        $stations = [];
        foreach ($stations_raw as $row) {
            /** @var Entity\Station $row */
            $api_row = ($this->stationApiGenerator)($row);
            $api_row->resolveUrls($request->getRouter()->getBaseUrl());

            if ($api_row->is_public) {
                $stations[] = $api_row;
            }
        }

        return $response->withJson($stations);
    }

    public function indexAction(ServerRequest $request, Response $response): ResponseInterface
    {
        $station = $request->getStation();

        $apiResponse = ($this->stationApiGenerator)($station);
        $apiResponse->resolveUrls($request->getRouter()->getBaseUrl());

        return $response->withJson($apiResponse);
    }
}
