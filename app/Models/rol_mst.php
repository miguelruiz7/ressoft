<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rol_mst extends Model
{
    protected $primaryKey = 'rol_uuid';
    protected $keyType = 'string';
    public $timestamps = false;
    use HasFactory;
}
