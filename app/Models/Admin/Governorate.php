<?php

namespace App\Models\Admin;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    use HasFactory,HasSlug;

    protected $table = 'governorates';

    protected $guarded = ['id'];
}
