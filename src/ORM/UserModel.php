<?php

namespace Ml\Api\ORM;
use Ml\Api\Entity\User as UserEntity;
use RedBeanPHP\R;

class UserModel {
    const TABLE_NAME = "users";

    public static function create(UserEntity $data) {
        //TODO: EXCEPTION HANDLING MISSING!!!!
        $user_bean = R::dispense(self::TABLE_NAME);
        $user_bean->uuid = $data->get_uuid();
        $user_bean->firstname = $data->get_firstname();
        $user_bean->lastname = $data->get_lastname();
        $user_bean->phone = $data->get_phone();
        $user_bean->email = $data->get_email();
        $user_bean->createdAt = $data->get_created_at();

        $user_bean_id = R::store( $user_bean );
        R::close();
        return $user_bean_id;
    }
}