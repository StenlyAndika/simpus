<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objektif extends Model
{
    use HasFactory;
    protected $table = 'objektif';
    protected $fillable = ['idp', 'td', 'n', 'r', 's', 'tb', 'bb', 'kepala', 'dada', 'abdomen', 'extermitas'];
    public $timestamps = false;
}
