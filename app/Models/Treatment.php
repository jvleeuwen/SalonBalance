<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;

class Treatment extends Model
{
    protected $fillable = ['name', 'price', 'version'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}