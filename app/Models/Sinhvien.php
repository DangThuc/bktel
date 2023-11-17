<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Sinhvien extends Model
{
    use HasFactory;
    protected $table = 'sinhviens';
    protected $fillable = [
        'Firstname',
        'Lastname',
        'Studentcode',
        'Department',
        'Faculty',
        'Address',
        'Phone',
        'Note',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
