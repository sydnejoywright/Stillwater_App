<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionHistories extends Model
{
    protected $table = 'session_histories';
    protected $fillable = [
        'start_time',
        'end_time',
        'leader_id',
        'group_id',
        'shift_note_complete',
        'date',
    ];

    /**
     * The group this session is based on.
     */
    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    /**
     * The leader (employee) who ran this session.
     */
    public function leader()
    {
        return $this->belongsTo(Employee::class, 'leader_id');
    }

    /**
     * The staff who supported this session (non-leaders).
     */
    public function staff()
    {
        return $this->belongsToMany(Employee::class, 'session_staff');
    }

    /**
     * The clients who attended this session.
     */
    public function clients()
    {
        return $this->belongsToMany(Client::class, 'client_sessions')
                    ->withPivot(['staff_id', 'client_note', 'in_alleva', 'note_assigned_to_id', 'care_level_id']);
    }

    /**
     * All raw client session records for this session.
     */
    public function clientSessions()
    {
        return $this->hasMany(ClientSession::class, 'session_id');
    }
}
