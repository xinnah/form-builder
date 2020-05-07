<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerInfo extends Model
{
    protected $table = 'customer_info';
    protected $fillable = [
        'form_id', 'user_id', 'value',
    ];
}
