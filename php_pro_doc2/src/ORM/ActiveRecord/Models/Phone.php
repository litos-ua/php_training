<?php

namespace Doctor\PhpPro\ORM\ActiveRecord\Models;

use Illuminate\Database\Eloquent\Model;
class Phone extends Model
{
    protected $table = "phones";
    protected $fillable = [
        "id",
        "user_id",
        "phone"
    ];
    public $timestamps = false;

    public static function createPhone(User $user, string $phone)
    {
        return Phone::create([
            "phone" => $phone,
            'user_id' => $user->id
        ]);
    }
}
