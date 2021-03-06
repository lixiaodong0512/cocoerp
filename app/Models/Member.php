<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table = "erp_member";

    protected $primaryKey = "id";
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d'
    ];

    public function balance()
    {
        return $this->hasMany('App\Models\PayRank','uid');
    }

    public function jobInfo()
    {
        return $this->hasOne('App\Models\JobUser','job_id');
    }
}
