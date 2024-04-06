<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UsesUuidAndModifiedUser;

class Role extends Model
{
    use HasFactory, UsesUuidAndModifiedUser;
}
