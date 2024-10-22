<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class un_mst extends Model
{
    protected $primaryKey = 'un_uuid';
    protected $keyType = 'string';
    public $timestamps = false;
    use HasFactory;
}
