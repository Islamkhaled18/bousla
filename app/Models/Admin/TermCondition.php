<?php
namespace App\Models\Admin;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermCondition extends Model
{
    use HasFactory, HasUuid;

    protected $table   = 'terms_conditions';
    protected $guarded = ['id'];

}
