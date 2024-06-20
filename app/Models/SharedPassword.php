<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class SharedPassword extends Model
{
    use HasUuids;

    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'password',
        'expiration',
        'openings',
        'passphase',
        'link'
    ];
}
