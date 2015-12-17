<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Database\Eloquent\SoftDeletes;

class Timesheet extends Model implements AuthenticatableContract,
                                    AuthorizableContract
{
    use Authenticatable, Authorizable, SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'emp_timesheet';

    protected $guarded = array(
        // Any columns you don't want to be mass-assignable.
        // Or just empty array if all is mass-assignable.
    );
}
