<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usr_mst extends Model
{
    protected $primaryKey = 'usr_uuid';
    protected $keyType = 'string';
    public $timestamps = false;
    use HasFactory;
}
