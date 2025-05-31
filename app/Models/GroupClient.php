<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GroupClient extends Model
{
    use HasFactory;

    protected $table = 'group_clients';

    protected $fillable = [
        'group_id',
        'client_id',
    ];

    /**
     * The group this client is assigned to.
     */
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * The client assigned to the group.
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
