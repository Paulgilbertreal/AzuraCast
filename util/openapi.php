<?php

use OpenApi\Annotations as OA;

#[
    OA\OpenApi(
        info: new OA\Info(
            version: AZURACAST_VERSION,
            title: 'AzuraCast',
            description: "AzuraCast is a standalone, turnkey web radio management tool. Radio stations hosted by AzuraCast expose a public API for viewing now playing data, making requests and more.",
            license: new OA\License(
                name: 'Apache 2.0',
                url: "http://www.apache.org/licenses/LICENSE-2.0.html"
            ),
        ),
        servers: [
            new OA\Server(
                description: AZURACAST_API_NAME,
                url: AZURACAST_API_URL
            ),
        ],
        externalDocs: new OA\ExternalDocumentation(
            description: "AzuraCast on GitHub",
            url: "https://github.com/AzuraCast/AzuraCast"
        ),
        tags: [
            new OA\Tag(
                name: "Now Playing",
                description: "Endpoints that provide full summaries of the current state of stations.",
            ),

            new OA\Tag(name: "Stations: General"),
            new OA\Tag(name: "Stations: Song Requests"),
            new OA\Tag(name: "Stations: Service Control"),

            new OA\Tag(name: "Stations: History"),
            new OA\Tag(name: "Stations: Listeners"),
            new OA\Tag(name: "Stations: Schedules"),
            new OA\Tag(name: "Stations: Media"),
            new OA\Tag(name: "Stations: Mount Points"),
            new OA\Tag(name: "Stations: Playlists"),
            new OA\Tag(name: "Stations: Podcasts"),
            new OA\Tag(name: "Stations: Queue"),
            new OA\Tag(name: "Stations: Remote Relays"),
            new OA\Tag(name: "Stations: SFTP Users"),
            new OA\Tag(name: "Stations: Streamers/DJs"),
            new OA\Tag(name: "Stations: Web Hooks"),

            new OA\Tag(name: "Administration: Custom Fields"),
            new OA\Tag(name: "Administration: Users"),
            new OA\Tag(name: "Administration: Relays"),
            new OA\Tag(name: "Administration: Roles"),
            new OA\Tag(name: "Administration: Settings"),
            new OA\Tag(name: "Administration: Stations"),
            new OA\Tag(name: "Administration: Storage Locations"),

            new OA\Tag(name: "Miscellaneous"),
        ]
    ),
    OA\Parameter(
        name: "station_id_required",
        in: "path",
        required: true,
        schema: new OA\Schema(
            anyOf: [
                new OA\Schema(type: "integer", format: "int64"),
                new OA\Schema(type: "string", format: "string"),
            ]
        )
    ),
    OA\Response(
        response: "todo",
        description: "This API call has no documented response (yet)",
    ),
    OA\SecurityScheme(
        type: "apiKey",
        in: "header",
        securityScheme: "api_key",
        name: "X-API-Key"
    )
]
class OpenApi
{
}



