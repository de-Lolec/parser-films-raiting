<?php

namespace MyProject\Models\Users;

use MyProject\Models\ActiveRecordEntity;
use MyProject\Services\Db;

class UserActivationService
{
    private const TABLE_NAME = 'users_activation_codes';
    /**
     * @var |null
     */
    private $user_id;

    public static function createActivationCode(User $user): string
    {
        // Генерируем случайную последовательность символов, о функциях почитайте в документации
        $code = bin2hex(random_bytes(16));

        $db = Db::getInstance();
        $db->query(
            'INSERT INTO ' . self::TABLE_NAME . ' (user_id, code) VALUES (:user_id, :code)',
            [
                'user_id' => $user->getId(),
                'code' => $code
            ]
        );

        return $code;
    }

    public function checkActivationCode(User $user, string $code): bool
    {

        $db = Db::getInstance();
        $result = $db->query(
            'SELECT * FROM ' . self::TABLE_NAME . ' WHERE user_id = :user_id AND code = :code',
            [
                'user_id' => $user->getId(),
                'code' => $code
            ]
        );
        return !empty($result);

    }
/*
    public function deleted(int $userId): void
    {
        $user = User::getById($userId);
        $db = Db::getInstance();
        $db->query(
            'DELETE FROM `users_activation_codes`' . ' WHERE user_id = id',
            [
                'user_id' => $user->getId(),
            ]
        );

    }
    public function getuserId(){

    }
*/
}