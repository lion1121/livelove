<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 016 16.05.19
 * Time: 9:53
 */

namespace App\SmsService;


class SmsServiceFacade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'SmsService';
    }
}