<?php


namespace App;


use App\Entity\User;

class Auth
{

    private static ?User $user = null;

    public static function isAuthorized(): bool {
        return self::user()->id > 0;
    }

    public static function login($email, $password): bool {

        $result = false;

        $user = User::getByEmail($email);

        if ($user->id > 0) {
            $hash = $user->password;
            if(password_verify($password, $hash)) {
                $_SESSION = [
                    'user' => [
                        'id' => $user->id,
                    ],
                ];
                self::$user = $user;
                $result = true;
            }
        }

        return $result;

    }

    public static function user(): User
    {
        if(empty(self::$user)) {
            self::$user = new User($_SESSION['user']['id'] ?? 0);
        }
        return self::$user;
    }

    public static function logout() {
        if(isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
        self::$user = new User();
    }

    public static function isAdmin(): bool
    {
        return self::user()->is_admin == 1;
    }
}