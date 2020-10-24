<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['user_id', 'category_id', 'money'];
}
