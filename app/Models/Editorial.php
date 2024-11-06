<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Editorial extends Model
{
    use HasFactory;

    // Define los campos que se pueden llenar de manera masiva
    protected $fillable = [
        'name',
        'address',
        'phone',
    ];

    // Aquí puedes definir relaciones si las hay. Por ejemplo:
    // public function books()
    // {
    //     return $this->hasMany(Book::class);
    // }
}
