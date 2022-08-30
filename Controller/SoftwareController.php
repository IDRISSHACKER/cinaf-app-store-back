<?php
namespace Controller;

use Slim\App;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Controller\Controlller;
use Model\Software;

/**
 * SoftwareController class
 */
class SoftwareController extends Controller{

    private static $_init;
    private static $software;

    public function __construct(){
        self::$software = new Software();
    }

    public static function init()
    {

        if (is_null(self::$_init)) {

            self::$_init = new self();
        }

        return self::$_init;
    }
    
    public function softwaresRoutes(App $app){
        $app->get('/softwares', function (Request $request, Response $response, $args) {
            $softwares = self::$software->getSoftwares();
            $response->getBody()->write(json_encode($softwares));
            $statusResponse = $response->withStatus(200);
            $responseWithHeader = $statusResponse
                ->withHeader('Access-Control-Allow-Origin', '*')
                ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
                ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS')
                ->withHeader('Content-type', 'application/json');
            return $responseWithHeader;
        });

        $app->get('/softwares/{page}', function (Request $request, Response $response, $args) {
            $page = $args['page'];
            $softwares = self::$software->getSoftwareLimited($page);
            
           
            $response->getBody()->write(json_encode($softwares));
            $statusResponse = $response->withStatus(200);
            $responseWithHeader = $statusResponse
                ->withHeader('Access-Control-Allow-Origin', '*')
                ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
                ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS')
                ->withHeader('Content-type', 'application/json');
            return $responseWithHeader;
        });

        $app->post('/software', function (Request $request, Response $response, $args){
            $title = htmlspecialchars($request->getParsedBody()["title"]);
            $description = htmlspecialchars($request->getParsedBody()["description"]);
            $fkSupport = htmlspecialchars($request->getParsedBody()["fkSupport"]);
            
            self::$software->setSoftware([
                "title"=> $title,
                "description"=> $description,
            ], $fkSupport);

            $softwares = self::$software->getSoftwares();;

            $response->getBody()->write(json_encode([
                "code"=> 201,
                "softwareId" => $softwares[0]["id"],
                "message"=> "L'application à bien été ajouter"
            ]));
            $statusResponse = $response->withStatus(201);
            $responseWithHeader = $statusResponse->withHeader('Content-type', 'application/json')
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE');
            return $responseWithHeader;
        });

        $app->get('/software/{softwareId}', function (Request $request, Response $response, $args) {
            $softwareId = $args["softwareId"];
            $software = self::$software->getSoftwareById($softwareId);

            if(!$software){
                $response->getBody()->write(json_encode([
                    "code" => 404,
                    "message" => "L'application que vous essayer de consulter n'existe pas :("
                ]));
                $statusResponse = $response->withStatus(404);
                $responseWithHeader = $statusResponse->withHeader('Content-type', 'application/json')
                ->withHeader('Access-Control-Allow-Origin', '*')
                ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
                ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE');
                return $responseWithHeader;
            }

            $response->getBody()->write(json_encode($software));
            $statusResponse = $response->withStatus(200);
            $responseWithHeader =
            $statusResponse
            ->withHeader('Content-type', 'application/json')
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE');
            return $responseWithHeader;
        });

        $app->delete('/software/{softwareId}', function (Request $request, Response $response, $args) {
            $softwareId = $args["softwareId"];
            self::$software->deleteSoftware($softwareId);

            $response->getBody()->write(json_encode([
                "code" => 204,
                "message" => "L'application à bien été supprimer"
            ]));
            $statusResponse = $response->withStatus(204);
            $responseWithHeader = $statusResponse->withHeader('Content-type', 'application/json');
            return $responseWithHeader;
        });

        $app->put('/software', function (Request $request, Response $response, $args) {
            self::$software->updateSoftware([
                "id"=>3,
                "title"=> "Linux software",
                "description"=>"Linux desk",
                "fkSupport"=>1
            ]);

            $response->getBody()->write(json_encode([
                "code" => 204,
                "message" => "L'application à bien été mise à jour"
            ]));
            $statusResponse = $response->withStatus(204);
            $responseWithHeader = $statusResponse->withHeader('Content-type', 'application/json');
            return $responseWithHeader;
        });
    }
    
}

