<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sen_mst extends Model
{
    protected $primaryKey = 'sen_uuid';
    protected $keyType = 'string';
    public $timestamps = false;
    use HasFactory;
}
