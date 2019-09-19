<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spend extends Model
{
    protected $fillable = ['value', 'supplier', 'description', 'spending_date'];
}
