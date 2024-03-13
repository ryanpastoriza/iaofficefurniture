<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $table = 'company_info';
    protected $primaryKey = 'company_id';

    protected $fillable = [
        'name',
        'address',
        'phone',
        'mobile',
        'facebook',
        'twitter',
        'linkedin',
        'instagram',
    ];
}
