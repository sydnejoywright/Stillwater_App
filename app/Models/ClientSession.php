<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientSession extends Model
{
    // This table does not use a default `id` primary key
    public $incrementing = false;
    public $timestamps = false; // Enable if you add timestamps later

    protected $table = 'client_sessions';

    protected $primaryKey = null; // Composite key, so no single primary key

    protected $fillable = [
        'session_id',
        'client_id',
        'staff_id',
        'client_note',
        'in_alleva',
        'note_assigned_to_id',
        'care_level_id',
    ];

    /**
     * The session this record belongs to.
     */
    public function session()
    {
        return $this->belongsTo(SessionHistories::class, 'session_id');
    }

    /**
     * The client this record belongs to.
     */
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    /**
     * The staff assigned to this client in this session.
     */
    public function staff()
    {
        return $this->belongsTo(Employee::class, 'staff_id');
    }

    /**
     * The person assigned to handle the note.
     */
    public function noteAssignee()
    {
        return $this->belongsTo(Employee::class, 'note_assigned_to_id');
    }

    /**
     * The care level assigned for this session (optional override).
     */
    public function careLevel()
    {
        return $this->belongsTo(CareLevel::class, 'care_level_id', 'level');
    }
}
