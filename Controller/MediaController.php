<?php

namespace Controller;
use Slim\App;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\UploadedFileInterface;
use Controller\Controlller;
use Model\Media;
use Ramsey\Collection\Map\MapInterface;
use GuzzleHttp\Psr7;

interface MediaInterface{
    const uploadDir =  "";
}

class MediaController extends Controller implements MediaInterface
{

    private static $_init;
    private static $media;

    public function __construct()
    {
        self::$media = new Media();
    }

    public static function init()
    {

        if (is_null(self::$_init)) {

            self::$_init = new self();
        }

        return self::$_init;
    }

    public function mediasRoutes(App $app)
    {
        $container = $app->getContainer();
        $container['upload_directory'] = self::uploadDir;

        $app->post('/media', function (Request $request, Response $response, $args) {
            $soft = htmlspecialchars($request->getParsedBody()["software"]);
            $typeOfMedia = htmlspecialchars($request->getParsedBody()["type"]);
            $iscover = htmlspecialchars($request->getParsedBody()["iscover"]);
           
            $directory =  dirname(__DIR__) . "/public" .'/f8047557-49e0-4c60-9732-0cb1770faaa5';

            $uploadedFiles = $request->getUploadedFiles();

            $uploadedFile = $uploadedFiles['file'];

            $filename = "045040-045050608-5060493-450500.png";

            if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
                $filename = $this->moveUploadedFile($directory, $uploadedFile);
            }


           if(self::$media->setMedia([
                $soft,
                $typeOfMedia,
                $iscover,
                $filename
            ])){

                $response->getBody()->write(json_encode([
                    "code" => 201,
                    "message" => "Votre media a bien été ajouter"
                ]));
                $statusResponse = $response->withStatus(201);
                $responseWithHeader = $statusResponse->withHeader('Access-Control-Allow-Origin', '*')->withHeader('Content-type', 'application/json');
                return $responseWithHeader;

            }

            $response->getBody()->write(json_encode([
                "code" => 500,
                "message" => "Erreur durant votre requete"
            ]));
            $statusResponse = $response->withStatus(500);
            $responseWithHeader = $statusResponse->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS')
            ->withHeader('Content-type', 'application/json');
            return $responseWithHeader;

        });

        $app->delete('/media/{mediaId}', function (Request $request, Response $response, $args) {
            $mediaId = $args['mediaId'];
            self::$media->deleteMedia($mediaId);
            $response->getBody()->write(json_encode([
                "code" => 204,
                "message" => "Le media à bien été retirer"
            ]));
            $statusResponse = $response->withStatus(204);
            $responseWithHeader = $statusResponse->withHeader('Access-Control-Allow-Origin', '*')
                ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
                ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS')
                ->withHeader('Content-type', 'application/json');
            return $responseWithHeader;
        });

        $app->get("/media/{mediaId}", function (Request $request, Response $response, $args) {
            $mediaId = $args["mediaId"];

            $media = self::$media->getMedia($mediaId);

            

            $img =  imagecreatefrompng(dirname(__DIR__) . "/public" . "/f8047557-49e0-4c60-9732-0cb1770faaa5" . "/" . $media[0]["path"]);
            header('Content-type: image/png'); 
            imagepng($img);
            imagedestroy($img);

            $statusResponse = $response->withStatus(200);
            $responseWithHeader = $statusResponse->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');

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
