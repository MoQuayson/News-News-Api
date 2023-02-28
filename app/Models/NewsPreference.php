<?php

namespace App\Models;

use App\Helpers\UsesUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsPreference extends Model
{
    use HasFactory,UsesUUID;
    protected $table = "user_feed_preferences";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'value',
    ];

    protected $casts = [
        'value' => 'array'
    ];
}
