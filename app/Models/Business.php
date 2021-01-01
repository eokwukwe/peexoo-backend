<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Business extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Acitivate or deactivate a business listing
     */
    public function toggleActive(): void
    {
        $this->active = (int) !$this->active;

        $this->save();
    }

    /**
     * Scope a query to only include active business.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('active', 1);
    }

    /**
     * Scope a query to search listing by name and description.
     */
    public function scopeSearch(Builder $query, Request $request): Builder
    {
        $name = $request->query('name');
        $description = $request->query('description');

        return $query
            ->where('name', 'LIKE', "%{$name}%")
            ->orWhere('description', 'LIKE', "%{$description}%");
    }

    /**
     * Since phone_2 can be null but has to be unique when available,
     * we need to manually set it to NULL to avoid database integrity
     * constraint violation error.
     */
    public function setPhone2Attribute(string $value): void
    {
        if (empty($value)) {
            $this->attributes['phone_2'] = NULL;
        } else {
            $this->attributes['phone_2'] = $value;
        }
    }
}
