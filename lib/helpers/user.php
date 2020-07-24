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
    private static $timestampsCache = [];

    public static function getUsersIdName(int $groupId): array
    {
        $by = 'id';
        $order = 'desc';
        $resultDb = CUser::GetList($by, $order,
            ['GROUPS_ID' => [$groupId]],
            ['FIELDS' => ["ID", "LOGIN"]]
        );
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

    public static function getTimestamp(int $id): string
    {
        if (self::$timestampsCache[$id]) {
            return self::$timestampsCache[$id];
        }

        $data = self::getProps($id, ['FIELDS' => 'TIMESTAMP_X']);
        $timestamp = $data['TIMESTAMP_X'];
        self::$timestampsCache[$id] = $timestamp;

        return $timestamp;
    }
}
