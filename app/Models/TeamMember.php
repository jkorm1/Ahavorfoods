<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    protected $table = 'team_members'; // ✅ Explicitly define the table name

    protected $fillable = ['name', 'position', 'bio', 'image_path', 'social_links']; // ✅ Fields allowed for mass assignment

    protected $casts = [
        'social_links' => 'array', // ✅ Treat social_links as JSON (decoded into an array)
    ];
}
