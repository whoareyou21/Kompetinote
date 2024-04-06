<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UsesUuidAndModifiedUser;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\CategoryCompetition;
use App\Models\User;

class StudentCompetition extends Model
{
    use HasFactory, UsesUuidAndModifiedUser, SoftDeletes;

    public function category() {
        return $this->belongsTo(CategoryCompetition::class, 'category_id', 'id');
    }

    public function leader() {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    public function lecture() {
        return $this->belongsTo(User::class, 'supervisor_id', 'id');
    }
}
