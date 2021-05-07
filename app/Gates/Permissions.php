<?php

namespace App\Gates;

class Permissions
{
    public function isAdmin($user)
    {
        return $user->type === 'admin';
    }
}
