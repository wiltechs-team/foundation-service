<?php

namespace wiltechsteam\FoundationService\Models;

use Illuminate\Database\Eloquent\Model;

class PositionsCN extends Model
{
    protected $table = 'positions_cn';

    public $timestamps = false;

    public $keyType = 'string';

    public $primaryKey = 'id';

    public $incrementing = false;

    protected $fillable = ['id', 'created_date', 'created_by', 'last_modified_date', 'last_modified_by', 'unit_id', 'name', 'description', 'is_active'];

    public function setIdAttribute($value)
    {
        $this->attributes['id'] = strtoupper($value);
    }

    public function setCreatedDateAttribute($value)
    {
        $this->attributes['created_date'] = date('Y-m-d H:i:s', strtotime($value));
    }

    public function setCreatedByAttribute($value)
    {
        $this->attributes['created_by'] = strtoupper($value);
    }

    public function setLastModifiedDateAttribute($value)
    {
        $this->attributes['last_modified_date'] = date('Y-m-d H:i:s', strtotime($value));
    }

    public function setLastModifiedByAttribute($value)
    {
        $this->attributes['last_modified_by'] = strtoupper($value);
    }

    public function setUnitIdAttribute($value)
    {
        $this->attributes['unit_id'] = strtoupper($value);
    }

    public function setIsActiveAttribute($value)
    {
        $this->attributes['is_active'] = $value === true ? 1 : 0;
    }
}
