<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_id',
        'case_manager_id',
        'care_level_id',
        'completed_hours',
    ];

    /**
     * The person this client record is based on.
     */
    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    /**
     * The care level this client is assigned to.
     */
    public function careLevel()
    {
        return $this->belongsTo(CareLevel::class, 'care_level_id', 'level');
    }

    /**
     * The case manager assigned to this client.
     */
    public function caseManager()
    {
        return $this->belongsTo(Employee::class, 'case_manager_id');
    }

    /**
     * All sessions this client has attended.
     */
    public function sessions()
    {
        return $this->belongsToMany(SessionHistories::class, 'client_sessions')
                    ->withPivot(['staff_id', 'client_note', 'in_alleva', 'note_assigned_to_id', 'care_level_id']);
    }

    /**
     * All session records for this client.
     */
    public function clientSessions()
    {
        return $this->hasMany(ClientSession::class);
    }
}
