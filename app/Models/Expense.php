<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'uid';
    }

    public function budget()
    {
        return $this->belongsTo(Budget::class);
    }
}
