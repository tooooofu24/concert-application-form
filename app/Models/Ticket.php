<?php

namespace App\Models;

use App\Mail\InvitationMail;
use App\Service\GooApiService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'uid', 'name', 'email', 'tel', 'converted_name', 'tel_reserved_flag'
    ];

    protected $casts = [
        'updated_at' => 'datetime',
        'entered_at' => 'datetime'
    ];

    public function getIsEmptyAttribute()
    {
        return !$this->name || !$this->converted_name || !$this->tel || !$this->email;
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function (self $ticket) {
            $ticket->uid = Str::uuid();
            if (!$ticket->converted_name && $ticket->name)
                $ticket->converted_name = GooApiService::convert($ticket->name);
        });
        self::created(function (self $ticket) {
            if (app()->isProduction()) {
                Mail::to($ticket->email)->send(new InvitationMail($ticket));
            }
        });
    }
}
