<?php

namespace Ml\Routes;

use Cm\Api\Routes\Http;
use Ml\Api\Service\User;
use Cm\Api\Routes\Exception\NotAllowedException;


$action = $_REQUEST['action'] ?? null;

enum UserAction: string
{
    case CREATE = 'create';
    case GET = 'get';
    case REMOVE = 'remove';
    case UPDATE = 'update';
    case GET_ALL = 'get_all';
    case LOGIN = 'login';


    function getResponse(): string
    {
        //TODO: GET USER DATA From http body

        $user = new User();

        $user_data = json_decode(file_get_contents('php://input'));
        $user_id = $_REQUEST['id'] ?? null;

        $http_method = match ($this) {
            self::CREATE => http::POST_METHOD,
            self::GET, self::GET_ALL => http::GET_METHOD,
            self::REMOVE => http::DELETE_METHOD,
            self::UPDATE => http::PUT_METHOD,
        };

        if (!Http::matchHttpRequestMethod($http_method)) {
            throw new NotAllowedException('Method not allowed');
        }


        $response = match ($this) {
            self::CREATE => $user->create($user_data),
            self::GET => $user->get($user_id),
            self::REMOVE => $user->remove($user_id),
            self::UPDATE => $user->update($user_data),
            self::GET_ALL => $user->getAll(),
            self::LOGIN =>$user->login($user_data)
        };
        return json_encode($response);
    }
}


$user_action = UserAction::tryFrom($action);
if ($user_action) {
    echo $user_action->getResponse();
} else {
    require '404.routes.php';
}
