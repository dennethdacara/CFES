<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = [];

    const _ADMIN = 1;
    const _STUDENT = 2;
    const _FACULTY = 3;
}
