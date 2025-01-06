<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaints extends Model
{
    use HasFactory;

    // Enabling timestamps
    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'complaint_category_id_fk',
        'complaint_type_id_fk',
        'complaint_details',
        'district_id_fk',
        'tehsil_id_fk',
        'markaz_id',
        'emis_code',
        'school_name',
        'complaint_id',
        'complaint_source_id',
        'user_id',
        'status_id',
        'assigned_to_user_id',
        'updated_by',
        'lat',
        'lng',
    ];

    public function attachments()
    {
        return $this->hasMany(ComplaintAttachment::class);
    }
    public function complaint_track()
    {
        return $this->hasMany(ComplaintTrack::class, 'complaint_id');
    }
    public function complaint_type()
    {
        return $this->belongsTo(ComplaintType::class, 'complaint_type_id_fk');
    }
    public function complaint_user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Accessor to convert UTC to Asia/Karachi
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->timezone('Asia/Karachi')->format('d-m-Y H:i:s');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->timezone('Asia/Karachi')->format('d-m-Y H:i:s');
    }
}
