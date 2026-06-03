<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Treatment;

class Customer extends Model
{
    protected $fillable = ['name', 'telephone_number', 'street_address'];

    public function treatments()
    {
        return $this->hasMany(Treatment::class);
    }
}