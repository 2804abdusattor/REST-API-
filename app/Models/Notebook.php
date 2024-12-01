<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notebook extends Model
{
    use HasFactory;

    // Указываем поля, которые можно массово заполнять
    protected $fillable = [
        'name',
        'phone',
        'email',
        'company',
        'birth_date',
        'photo',
    ];
}
