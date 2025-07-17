<?php
namespace App\Models\Admin;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory, HasSlug;

    protected $table   = 'job_titles';
    protected $guarded = ['id'];
}
