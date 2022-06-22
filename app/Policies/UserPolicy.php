<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    // 前台用户更新用户资料权限
    public function foreUpdate(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }

    // 后台用户列表删除权限只有非管理员才能允许被修改，并且删除者必须是非管理员
    public function backDestroy(User $currentUser, User $user)
    {
        return $user->is_admin == 0 && $currentUser->is_admin == 1;
    }

    // 后台的操作权限，用户必须是管理员
    public function is_admin(User $currentUser, User $user)
    {
        return $currentUser->is_admin;
    }
}
