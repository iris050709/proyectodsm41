<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = "users";

    protected $fillable = ['name', 'email','password'];

    protected $primaryKey = "id";

    public $timestamps = true; 

    protected $hidden = ['password','created_at', 'updated_at'];
}

