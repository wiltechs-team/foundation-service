<?php

namespace wiltechsteam\FoundationService\Models;

use Illuminate\Database\Eloquent\Model;

class UnitsUS extends Model
{
    protected $table = 'units_us';

    public $timestamps = false;

    public $keyType = 'string';

    public $primaryKey = 'id';

    public $incrementing = false;

    protected $fillable = ['id', 'name', 'type_id', 'parent_id', 'leader_id', 'leader_country_code', 'location_code', 'status'];

    public function setIdAttribute($value)
    {
        $this->attributes['id'] = strtoupper($value);
    }

    public function setParentIdAttribute($value)
    {
        $this->attributes['parent_id'] = strtoupper($value);
    }

    public function setLeaderIdAttribute($value)
    {
        $this->attributes['leader_id'] = strtoupper($value);
    }

    public function setLocationCodeAttribute($value)
    {
        $this->attributes['location_code'] = strtoupper($value);
    }
}
