<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dokter extends Model
{
    use HasFactory;
    protected $table = 'dokter';
    protected $guarded = ['idd'];
    protected $primaryKey = 'idd';
    public $timestamps = false;
}
