<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class per_mst extends Model
{
    protected $primaryKey = 'per_uuid';
    protected $keyType = 'string';
    public $timestamps = false;
    use HasFactory;
}
