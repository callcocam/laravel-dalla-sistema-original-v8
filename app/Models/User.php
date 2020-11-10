<?php

namespace App\Models;



use App\Models\Admin\User as UserAlias;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;

use App\Notifications\MyResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends UserAlias implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use HasFactory, Notifiable, Authenticatable, Authorizable, CanResetPassword, MustVerifyEmail, HasApiTokens;

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MyResetPassword($token));
    }
}
