<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    protected $table = 'contact_messages'; // ✅ Links the model to the correct table

    protected $fillable = ['name', 'email', 'subject', 'department', 'message', 'privacy']; // ✅ Defines allowed fields
}
