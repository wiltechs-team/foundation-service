<?php

namespace wiltechsteam\FoundationService\Models;

use Illuminate\Database\Eloquent\Model;

class StaffUS extends Model
{
    protected $table = 'staffs_us';

    public $timestamps = false;

    public $keyType = 'string';

    public $primaryKey = 'id';

    public $incrementing = false;

    protected $fillable = ['id', 'user_id', 'user_name', 'payroll_name', 'gender', 'location_id', 'location_name', 'department_id', 'department_name', 'group_id', 'group_name', 'position_id', 'position_name', 'ssn', 'language', 'wechat_account', 'wechat_name', 'back_to_warehouse', 'dob', 'address', 'city', 'badge', 'territory_code', 'postal_code', 'personal_mobile', 'work_phone', 'emergency_contact', 'emergency_tel', 'comment', 'w4_marital_status', 'w4_excomption', 'w4_marital_state', 'w4_maritalStateExcomption', 'location_description', 'driver_number', 'driver_code', 'derver_exp', 'position_status', 'hired_date', 're_hired_date', 'terminated_date', 'terminated_comment', 'deleted_date', 'status'];

    public function setIdAttribute($value)
    {
        $this->attributes['id'] = strtoupper($value);
    }

    public function setUserIdAttribute($value)
    {
        $this->attributes['user_id'] = strtoupper($value);
    }

    public function setUserNameAttribute($value)
    {
        $this->attributes['user_name'] = strtoupper($value);
    }

    public function setLocationIdAttribute($value)
    {
        $this->attributes['location_id'] = strtoupper($value);
    }

    public function setDepartmentIdAttribute($value)
    {
        $this->attributes['department_id'] = strtoupper($value);
    }

    public function setGroupIdAttribute($value)
    {
        $this->attributes['group_id'] = strtoupper($value);
    }

    public function setPositionIdAttribute($value)
    {
        $this->attributes['position_id'] = strtoupper($value);
    }

    public function setSuperiorIdAttribute($value)
    {
        $this->attributes['superior_id'] = strtoupper($value);
    }

    public function setDobAttribute($value)
    {
        $this->attributes['dob'] = date('Y-m-d', strtotime($value));
    }

    public function setHiredDateAttribute($value)
    {
        $this->attributes['hired_date'] = date('Y-m-d', strtotime($value));
    }

    public function setTerminatedDateAttribute($value)
    {
        $this->attributes['terminated_date'] = date('Y-m-d', strtotime($value));
    }

    public function setDeletedDateAttribute($value)
    {
        $this->attributes['deleted_date'] = date('Y-m-d H:i:s', strtotime($value));
    }

}
