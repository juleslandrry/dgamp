<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageDg extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'destination', 'subject', 'message', 'lu'];
}