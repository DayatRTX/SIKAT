<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    use HasFactory;

    




    protected $fillable = [
        'user_id',
        'technician_id',
        'title',
        'description',
        'location',
        'category',
        'image_before',
        'image_after',
        'status',
        'reject_reason',
    ];

    


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    


    public function technician(): BelongsTo
    {
        return $this->belongsTo(User::class, 'technician_id');
    }

    


    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
