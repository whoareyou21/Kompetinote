<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UsesUuidAndModifiedUser;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryCompetition extends Model
{
    use HasFactory, UsesUuidAndModifiedUser, SoftDeletes;
}
