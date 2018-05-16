<?php

namespace wiltechsteam\FoundationService\Models;

use Illuminate\Database\Eloquent\Model;

class PositionsUS extends Model
{
    protected $table = 'positions_us';

    public $timestamps = false;

    public $keyType = 'string';

    public $primaryKey = 'id';

    public $incrementing = false;

    protected $fillable = ['id', 'unit_id', 'name', 'description', 'status'];

    public function setIdAttribute($value)
    {
        $this->attributes['id'] = strtoupper($value);
    }

    public function setUnitIdAttribute($value)
    {
        $this->attributes['unit_id'] = strtoupper($value);
    }
}
