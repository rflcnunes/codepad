<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Events\PostCreated;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'message',
    ];

    protected $dispatchesEvents = [
        'created' => PostCreated::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
