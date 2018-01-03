<?php
/**
 * Created by PhpStorm.
 * User: hjl
 * Date: 2017/12/22
 * Time: 下午2:50
 */

namespace common\libraries\jwt;

use common\libraries\openssl\RSA;
use Firebase\JWT\JWT as BaseJWT;

final class JWT
{
    public static function generate($user)
    {
        $token = [
            "id" => $user->id,
            "email" => $user->email,
            "time" => time()
        ];
        return BaseJWT::encode($token, RSA::$privateKey, 'RS256');
    }

    /**
     * Parses the JWT and returns a token class
     * @param string $token JWT
     * @return object
     */
    public static function loadToken($token)
    {
        return BaseJWT::decode($token, RSA::$publicKey, array('RS256'));
    }
}