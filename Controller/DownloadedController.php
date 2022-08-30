<?php

namespace Controller;

use Slim\App;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Controller\Controlller;
use Model\Downloaded;

/**
 * DownloadedController class
 */
class DownloadedController extends Controller
{

    private static $_init;
    private static $downloaded;

    public function __construct()
    {
        self::$downloaded = new Downloaded();
    }

    public static function init()
    {

        if (is_null(self::$_init)) {

            self::$_init = new self();
        }

        return self::$_init;
    }

    public function downloadedRoutes(App $app)
    {
        $app->get('/downloaded', function (Request $request, Response $response, $args) {

            $downloadeds = self::$downloaded->getDownloadeds();

            $response->getBody()->write(json_encode($downloadeds));

            $statusResponse = $response->withStatus(200);
            $responseWithHeader = $statusResponse->withHeader('Content-type', 'application/json');
            return $responseWithHeader;
        });

        $app->post('/downloaded', function (Request $request, Response $response, $args) {
            $soft = htmlspecialchars($_POST["software"]);
            self::$downloaded->setDownloaded(["fkSoftware"=>$soft]);

            $response->getBody()->write(json_encode([
                "code" => 201,
                "message" => "Le nouveau telechargement à été prise en compte"
            ]));

            $statusResponse = $response->withStatus(201);
            $responseWithHeader = $statusResponse->withHeader('Content-type', 'application/json');
            return $responseWithHeader;
        });

    }
}
