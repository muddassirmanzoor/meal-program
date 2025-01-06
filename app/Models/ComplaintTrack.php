<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class ComplaintTrack extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'status_id',
        'assigned_by',
        'assigned_to',
        'complaint_id',
        'note',
        'complaint_action_date',
        'action',
    ];

    public function complaint()
    {
        return $this->belongsTo(Complaints::class);
    }

    public function status()
    {
        return $this->hasMany(StatusTypes::class, 'id', 'status_id');
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

    public function getComplaintAssignDateAttribute($value)
    {
        return Carbon::parse($value)->timezone('Asia/Karachi')->format('d-m-Y H:i:s');
    }
}
