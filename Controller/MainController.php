<?php

namespace Controller;

use Slim\App;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Controller\Controlller;

use Model\Downloaded;
use Model\Version;


class MainController extends Controller
{

    private static $_init;
    private static $download;
    private static $version;

    public function __construct()
    {
        self::$download = new Downloaded();
        self::$version = new Version();
       
    }

    public static function init()
    {

        if (is_null(self::$_init)) {

            self::$_init = new self();
        }

        return self::$_init;
    }

    public function mainRoutes(App $app)
    {
        $app->get('/', function (Request $request, Response $response, $args) {
            $response->getBody()->write("Welcome to cinaf api store");
            $statusResponse = $response->withStatus(200);
            $responseWithHeader = $statusResponse->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS')
            ->withHeader('Content-type', 'application/json');
            return $responseWithHeader;
        });

        $app->get('/download/{file}', function (Request $request, Response $response, $args) {

            $file = $args["file"];
            $fkSoftware = self::$version->getFkSoftware($file)[0]["fkSoftware"];

            self::$download->setDownloaded(["fkSoftware"=> $fkSoftware]);


            $filename = 'f8047557-49e0-4c60-9732-0cb1770fafileaa5' . "/" .$file;
            define('CHUNK_SIZE', filesize($filename));

            function readfile_chunked($filename, $retbytes = TRUE) {
                $buffer = '';
                $cnt    = 0;
                $handle = fopen($filename, 'rb');

                if ($handle === false) {
                    return false;
                }

                while (!feof($handle)) {
                    $buffer = fread($handle, CHUNK_SIZE);
                    echo $buffer;
                    ob_flush();
                    flush();

                    if ($retbytes) {
                        $cnt += strlen($buffer);
                    }
                }

                $status = fclose($handle);

                if ($retbytes && $status) {
                    return $cnt;
                }

                return $status;
            }



            $mimetype = filetype($filename);
            header('Content-Type: '.$mimetype );
            header('Content-Length: '. filesize($filename));
            header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Headers: *");
            header("Access-Control-Allow-Methods: *");
            readfile_chunked($filename);

            $statusResponse = $response->withStatus(201);
            //$responseWithHeader = $statusResponse->withHeader('Access-Control-Allow-Origin', '*')->withHeader('Content-type', 'application/json');
            return $statusResponse;
        });

        

       
    }
}
