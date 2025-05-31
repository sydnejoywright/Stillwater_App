<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'position',
        'username',
        'password',
    ];
      /**
     * The person this employee record is based on.
     */
    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    /**
     * Clients where this employee is the assigned case manager.
     */
    public function managedClients()
    {
        return $this->hasMany(Client::class, 'case_manager_id');
    }

    /**
     * Sessions where this employee is the group leader.
     */
    public function ledSessions()
    {
        return $this->hasMany(SessionHistories::class, 'leader_id');
    }

    /**
     * All sessions this employee has participated in (as a non-lead).
     */
    public function sessions()
    {
        return $this->belongsToMany(SessionHistories::class, 'session_staff');
    }

    /**
     * All client session records where this employee is the assigned staff.
     */
    public function clientSessions()
    {
        return $this->hasMany(ClientSession::class, 'staff_id');
    }

    /**
     * All client session records where this employee is assigned to write a note.
     */
    public function assignedNotes()
    {
        return $this->hasMany(ClientSession::class, 'note_assigned_to_id');
    }
}
