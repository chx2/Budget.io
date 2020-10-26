<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    public function incomes()
    {
        return $this->hasMany('App\Models\Income');
    }

    public function expenses()
    {
        return $this->hasMany('App\Models\Expense');
    }
}
