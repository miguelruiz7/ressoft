<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sen_det extends Model
{
    protected $primaryKey = 'sen_uuid_';
    protected $keyType = 'string';
    public $timestamps = false;
    use HasFactory;
}
