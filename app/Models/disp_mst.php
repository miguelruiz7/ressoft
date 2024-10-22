<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class disp_mst extends Model
{
    protected $primaryKey = 'disp_uuid';
    protected $keyType = 'string';
    public $timestamps = false;
    use HasFactory;
}
