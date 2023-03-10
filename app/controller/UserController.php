<?php

namespace app\controller;

use app\Request;

class UserController
{
    public function getUserById(Request $request) {
        $userService = invoke("app\service\UserService");
        return $userService->getUserById($request->param('id'));
    }

    public function testDel(Request $request) {
        $img = '../public/images/topic/mFelBFEGW5yBsSDtHr05D-0.jpg';
        if (unlink($img)) {
            return json("successful");
        }
        return json("failed");
    }
}