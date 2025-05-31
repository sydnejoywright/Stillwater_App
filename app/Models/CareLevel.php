<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareLevel extends Model
{
    // Disable auto-incrementing ID since 'level' is the primary key
    public $incrementing = false;

    // Set the primary key to 'level' (a string)
    protected $primaryKey = 'level';
    protected $keyType = 'string';

    protected $fillable = [
        'level',
        'required_hours',
    ];

    /**
     * Get the clients assigned to this care level.
     */
    public function clients()
    {
        return $this->hasMany(Client::class, 'care_level_id', 'level');
    }

    /**
     * Get the client_sessions using this care level at the session level.
     */
    public function clientSessions()
    {
        return $this->hasMany(ClientSession::class, 'care_level_id', 'level');
    }
}
