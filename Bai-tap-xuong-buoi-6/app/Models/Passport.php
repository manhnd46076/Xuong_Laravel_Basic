<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passport extends Model
{
    use HasFactory;
    protected $fillable = [
        'passport_number',
        'issued_date',
        'expiry_date'
    ];
  
}
