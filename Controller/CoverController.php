<?php

namespace Controller;

use Slim\App;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Controller\Controlller;
use Model\Cover;

/**
 * CoverController class
 */
class CoverController extends Controller
{

    private static $_init;
    private static $cover;

    public function __construct()
    {
        self::$cover = new Cover();
    }

    public static function init()
    {

        if (is_null(self::$_init)) {

            self::$_init = new self();
        }

        return self::$_init;
    }

    public function coverRoutes(App $app)
    {
        $app->get('/covers', function (Request $request, Response $response, $args) {

            $covers = self::$cover->getCovers();

            $response->getBody()->write(json_encode($covers));

            $statusResponse = $response->withStatus(200);
            $responseWithHeader = $statusResponse->withHeader('Content-type', 'application/json');
            return $responseWithHeader;
        });

        $app->post('/cover', function (Request $request, Response $response, $args) {
    
            $soft = htmlspecialchars($request->getParsedBody()["software"]);
            $title = htmlspecialchars($request->getParsedBody()["title"]);
            $img = htmlspecialchars($request->getParsedBody()["img"]);
            $desk = htmlspecialchars($request->getParsedBody()["description"]);

            self::$cover->setCover([$soft, $title, $img, $desk]);

            $response->getBody()->write(json_encode([
                "code" => 201,
                "message" => "La couverture à été ajouter"
            ]));

            $statusResponse = $response->withStatus(201);
            $responseWithHeader = $statusResponse->withHeader('Content-type', 'application/json');
            return $responseWithHeader;
        });
    }
}
