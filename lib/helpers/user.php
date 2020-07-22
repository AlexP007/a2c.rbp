<?php


namespace A2C\RBP\Helpers;


use CUser;

/**
 * Class User
 * @package A2C\RBP\Helpers
 *
 * @license MIT
 *
 * @author AlexP007
 * @email alex.p.panteleev@gmail.com
 * @link https://github.com/AlexP007/a2c.rbp
 */
class User
{
    public static function getUsersIdName(): array
    {
        $by = 'id';
        $order = 'desc';
        $resultDb = CUser::GetList($by, $order, [], ['FIELDS' => ["ID", "LOGIN"]]);
        $result = [];
        while ($user = $resultDb->Fetch()) {
            $result[] = $user;
        }
        
        return $result;
    }

    public static function getProps(int $id, array $filterProps): array
    {
        $by = 'id';
        $order = 'desc';
        $resultDb =  CUser::GetList($by, $order, ['ID' => $id], $filterProps);

        return $resultDb->GetNext();
    }
}