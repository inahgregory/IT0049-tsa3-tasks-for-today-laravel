<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
class Task extends Model
{
    protected $fillable = ['title', 'status', 'task_date'];
    protected $attributes = ['status' => 'pending'];

    protected function casts(): array
    {
        return ['task_date' => 'date'];
    }

    public function scopeForDate(Builder $query, $date): Builder
    {
        return $query->whereDate('task_date', $date);
    }
}
