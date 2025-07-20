<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JoinRequestImage extends Model
{
    use HasFactory;

    protected $table = 'join_requests_images';
    protected $guarded = ['id'];

    public function joinRequest()
    {
        return $this->belongsTo(JoinRequest::class, 'join_request_id');
    }
}
