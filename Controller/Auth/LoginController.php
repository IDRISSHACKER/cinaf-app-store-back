<?php

namespace Controller\Auth;

use Slim\App;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

use Model\User;

class LoginController{

    private static $_init;
    private static $login;

    public function __construct()
    {
        self::$login = new User();
    }

    public static function init()
    {

        if (is_null(self::$_init)) {

            self::$_init = new self();
        }

        return self::$_init;
    }

    public function authRoutes(App $app)
    {
        $app->post('/login', function (Request $request, Response $response, $args) {

            $email = htmlspecialchars($request->getParsedBody()["email"]);
            $password = htmlspecialchars($request->getParsedBody()["password"]);

            $login = self::$login->login($email, $password);

            if($login){
                $userId = $login["id"];
                $key = 'CinafTV2022.';
                $payload = [
                    'iss' => $login["email"],
                    'aud' => $login["password"],
                    'iat' => 1356999524,
                    'nbf' => 1357000000
                ];
                $token = JWT::encode($payload, $key, 'HS256');
                $refreshToken = JWT::encode($payload, $key, 'HS256');

                self::$login->setTokenAndRefreshToken($token, $refreshToken, $userId);

                $response->getBody()->write(json_encode(["status" => 201, "message" => "Login success", "token" => $token, "refreshToken" => $refreshToken]));
                $statusResponse = $response->withStatus(200);
                $responseWithHeader = $statusResponse->withHeader('Content-type', 'application/json');
                return $responseWithHeader;
            }else{
                $response->getBody()->write(json_encode(["status" => 404, "message" => "User not authorized"]));
                $statusResponse = $response->withStatus(404);
                $responseWithHeader = $statusResponse->withHeader('Content-type', 'application/json');
                return $responseWithHeader;
            }
        });

        $app->get("/user/{token}", function (Request $request, Response $response, $args) {
            $token = $args["token"];
            $user = self::$login->getUser($token)[0];


            $response->getBody()->write(json_encode($user));
            $statusResponse = $response->withStatus(200);
            $responseWithHeader = $statusResponse->withHeader('Content-type', 'application/json');
            return $responseWithHeader;
        });

    }
    
}

//echo password_hash("cinaf2022", PASSWORD_BCRYPT);

