<?php

namespace App\Http\Traits;

use Illuminate\Support\Str;

trait UsesUuidAndModifiedUser
{
    private $user;
    protected static function bootUsesUuidAndModifiedUser()
    {
        $user = auth()->user();
        static::creating(function ($model) use($user) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
            if($user){
                $model->created_by = $user->name;
                $model->updated_by = $user->name;
            }
        });

        static::updating(function ($model) use ($user) {
            if ($user) {
                $model->updated_by = $user->name;
            }
        });

        static::deleting(function ($model) use ($user) {
            if ($user) {
                $model->deleted_by = $user->name;
                $model->save();
            }
        });
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}