<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class SessionStaff extends Pivot
{
    protected $table = 'session_staff';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'session_id',
        'staff_id',
    ];

    /**
     * The session this staff record belongs to.
     */
    public function session()
    {
        return $this->belongsTo(SessionHistories::class, 'session_id');
    }

    /**
     * The employee (staff) assigned to this session.
     */
    public function staff()
    {
        return $this->belongsTo(Employee::class, 'staff_id');
    }
}

