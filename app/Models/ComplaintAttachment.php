<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintAttachment extends Model
{
    use HasFactory;
    protected $fillable = [
        'complaint_id',
        'attachment_path',
    ];

    public function complaint()
    {
        return $this->belongsTo(Complaints::class);
    }
}
