<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Business extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function toggleActive()
    {
        $this->active = (int) !$this->active;

        $this->save();
    }

    /**
     * Since phone_2 can be null but has to be unique when available,
     * we need to manually set it to NULL to avoid database integrity
     * constraint violation error.
     */
    public function setPhone2Attribute($value)
    {
        if (empty($value)) {
            $this->attributes['phone_2'] = NULL;
        } else {
            $this->attributes['phone_2'] = $value;
        }
    }
}
