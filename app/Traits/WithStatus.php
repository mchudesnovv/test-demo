<?php

namespace App\Traits;

trait WithStatus {
    public static $STATUS_ACTIVE = 'Active';
    public static $STATUS_INACTIVE = 'Inactive';

    public function scopeActive($q)
    {
        return $q->where('status', static::$STATUS_ACTIVE);
    }

    public function scopeInactive($q)
    {
        return $q->where('status', static::$STATUS_INACTIVE);
    }

    public function setInactive()
    {
        $this->status = static::$STATUS_INACTIVE;
    }

    public function setActive()
    {
        $this->status = static::$STATUS_ACTIVE;
    }
}
