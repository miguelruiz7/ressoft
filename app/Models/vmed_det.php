<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vmed_det extends Model
{
    protected $primaryKey = 'vmed_uuid_';
    protected $keyType = 'string';
    public $timestamps = false;
    use HasFactory;
}
