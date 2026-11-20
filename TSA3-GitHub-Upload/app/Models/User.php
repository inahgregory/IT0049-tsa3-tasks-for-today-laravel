<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
// A profile record for this read-only assessment; no login is required.
class User extends Model
{
    protected $fillable = ['username', 'full_name', 'email'];
}
