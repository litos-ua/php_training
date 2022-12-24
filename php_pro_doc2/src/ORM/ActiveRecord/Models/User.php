<?php

namespace Doctor\PhpPro\ORM\ActiveRecord\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "users";
    protected $fillable = [
        "id",
        "login",
        "password",
        "status",
    ];
    public $timestamps = false;

    public function phones()
    {
        return $this->hasMany(Phone::class);
    }

    public static function getAllUsers() {
        $users = User::all();
        return $users;
    }

    public static function getActiveUsers() {
        $users = User::query()->where('status',0)->get();
        return $users;
    }

    public static function getUsersWithPhones() {
        $users = User::query()
            ->rightJoin('phones', 'phones.user_id', '=', 'users.id')
            ->orderBy('user_id')
            ->get();
        return $users;
    }

}
