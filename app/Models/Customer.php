<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'telephone_number', 'street_address'];

    public function treatments()
    {
        return $this->hasMany(Treatment::class);
    }
}