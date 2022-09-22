<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tipo extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tipos';
    protected $primaryKey = 'id_tipo';
    protected $dates = [
                        'created_at',
                        'updated_at',
                        'deleted_at'
                        ];
    protected $fillable = ['tipo'];

}
