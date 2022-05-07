<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    // 前台用户更新权限
    public function foreUpdate(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }

    // 后台列表删除权限
    public function backDestroy(User $currentUser, User $user)
    {
        return $user->is_admin == 0;
    }

    // 后台的操作权限
    public function is_admin(User $currentUser, User $user)
    {
        return $currentUser->is_admin;
    }
}
