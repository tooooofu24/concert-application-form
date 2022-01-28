<?php

namespace App\Models;

use App\Service\GooApiService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'uid', 'name', 'email', 'tel', 'zip', 'address', 'status', 'converted_name'
    ];

    protected $casts = [
        'updated_at' => 'datetime',
        'entered_at' => 'datetime'
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function (self $ticket) {
            $ticket->uid = Str::uuid();
            if (!$ticket->converted_name)
                $ticket->converted_name = GooApiService::convert($ticket->name);
        });
    }
}
