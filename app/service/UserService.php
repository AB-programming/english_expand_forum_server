<?php

namespace app\service;
use app\model\User;
use think\Service;

class UserService extends Service
{

    public function __construct()
    {
    }

    public function getUserById(string $id) {
        $user = User::find($id);
        if ($user != null) {
            return json(array('status' => 1, 'info' => '查找成功', 'user' => $user));
        }
        return json(array('status' => 0, 'info' => '查找失败,ID(' . $id . ')不存在'));
    }
}