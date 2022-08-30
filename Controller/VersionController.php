<?php

namespace Controller;

use Slim\App;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\UploadedFileInterface;

use Controller\Controlller;
use Model\Version;

/**
 * VersionController class
 */
class VersionController extends Controller
{

    private static $_init;
    private static $version;

    public function __construct()
    {
        self::$version = new Version();
    }

    public static function init()
    {

        if (is_null(self::$_init)) {

            self::$_init = new self();
        }

        return self::$_init;
    }

    public function versionsRoutes(App $app)
    {

        $app->post('/version', function (Request $request, Response $response, $args) {
            $directory =  dirname(__DIR__) . "/public" . '/f8047557-49e0-4c60-9732-0cb1770fafileaa5';

            $uploadedFiles = $request->getUploadedFiles();

            $uploadedFile = $uploadedFiles['file'];

            $filename = "045040-045050608-5060493-450500.apk";

            if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
                $filename = $this->moveUploadedFile($directory, $uploadedFile);
            }

            $soft = htmlspecialchars($_POST["software"]);
            $version = htmlspecialchars($_POST["version"]);

           if(self::$version->setVersion([$soft, $version, $filename])){
               

            }

            $response->getBody()->write(json_encode([
                "code" => 201,
                "message" => "Votre version a bien été ajouter"
            ]));
            header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Headers: *");
            header('Access-Control-Allow-Credentials: true');
            // header('Access-Control-Max-Age: 86400');  
            header("Access-Control-Allow-Methods: *");

            $statusResponse = $response->withStatus(201);
            //$responseWithHeader = $statusResponse->withHeader('Access-Control-Allow-Origin', '*')->withHeader('Content-type', 'application/json');
            return $statusResponse;


            /*$response->getBody()->write(json_encode([
                "code" => 500,
                "message" => "Erreur durant votre requete"
            ]));
            $statusResponse = $response->withStatus(500);
            $responseWithHeader = $statusResponse->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS')
            ->withHeader('Content-type', 'application/json');
            return $responseWithHeader;*/
        });

        $app->delete('/version/{versionId}', function (Request $request, Response $response, $args) {
            
            $versionId = $args["versionId"];

            self::$version->deleteVersion(["id"=>$versionId]);
            
            $response->getBody()->write(json_encode([
                "code" => 204,
                "message" => "La version à bien été retirer"
            ]));

            $statusResponse = $response->withStatus(204);
            $responseWithHeader = $statusResponse->withHeader('Content-type', 'application/json');
            return $responseWithHeader;
        });

    }

    private static function moveUploadedFile(string $directory, UploadedFileInterface $uploadedFile)
    {
        $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);

        $basename = bin2hex(random_bytes(8));
        $filename = sprintf('%s.%0.8s', $basename, $extension);

        $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);

        return $filename;
    }
}
