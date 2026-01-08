<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FinanceType extends Model
{
    use SoftDeletes;

    protected $table = 'finance_types';
    protected $guarded = ['id'];

    public function finances()
    {
        return $this->hasMany(Finance::class, 'type_id', 'id');
    }
}
