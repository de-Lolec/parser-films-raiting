<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Exceptions\IsNotAdmin;
use MyProject\Models\Users\User;
use MyProject\Models\Users\UserActivationService;
use MyProject\Models\Users\UsersAuthService;
use MyProject\Services\EmailSender;

class UsersController extends AbstractController
{

    public function signUp()
    {
        if (!empty($_POST)) {
            try {
                $user = User::signUp($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('users/signUp.php', ['error' => $e->getMessage()]);
                return;
            }

            if ($user instanceof User) {
                $code = UserActivationService::createActivationCode($user);

                EmailSender::send($user, 'Активация', 'userActivation.php', [
                    'userId' => $user->getId(),
                    'code' => $code
                ]);

                $this->view->renderHtml('users/signUpSuccessful.php');
                return;
            }
        }

        $this->view->renderHtml('users/signUp.php');
    }

    public function PDadmin(){
        $admin = UsersAuthService::getUserByToken();
        if($admin->isAdmin() == true) {
           $this->view->renderHtml('users/adminProfile.php');
        } else{
            $this->view->renderHtml('users/login.php');
            throw new IsNotAdmin();
        }
    }

    public function activate(int $userId, string $activationCode)
    {
        $user = User::getById($userId);
        $isCodeValid = (new \MyProject\Models\Users\UserActivationService)->checkActivationCode($user, $activationCode);
        if ($isCodeValid) {
            $user->activate();
            echo 'OK!';
            $db = Db::getInstance();
            $db->query(
                'DELETE FROM `users_activation_codes`' . ' WHERE user_id = user_id',
                [
                    'user_id' => $user->getId(),
                ]
            );
        }
    }

    public function login()
    {
        if (!empty($_POST)) {
            try {
                $user = User::login($_POST);
                UsersAuthService::createToken($user);
                header('Location: /');
                exit();
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('users/login.php', ['error' => $e->getMessage()]);
                return;
            }
        }

        $this->view->renderHtml('users/login.php');
    }

    public function exit()
    {

        setcookie("token","",time()-3600,"/");
        header('Location: /');

        }
}