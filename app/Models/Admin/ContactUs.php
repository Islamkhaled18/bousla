<?php
namespace App\Models\Admin;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory, HasSlug;

    protected $table   = 'contact_us';

    protected $guarded = ['id'];
}
