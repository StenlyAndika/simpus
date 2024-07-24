<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosa extends Model
{
    use HasFactory;
    protected $table = 'diagnosa';
    protected $fillable = ['idp', 'idd', 's', 'o', 'a', 'p', 'alergi', 'kie', 'rujukan'];
    protected $primaryKey = 'idd';
    public $timestamps = false;
}
