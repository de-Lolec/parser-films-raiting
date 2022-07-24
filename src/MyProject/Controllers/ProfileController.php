<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Models\Users\User;
use MyProject\Models\Users\UserActivationService;
use MyProject\Models\Users\UsersAuthService;
use MyProject\Services\EmailSender;

class ProfileController extends AbstractController
{
 public function UserProfile(){
        $user = UsersAuthService::getUserByToken();



         $this->view->renderHtml('users/login.php');
    }
}
