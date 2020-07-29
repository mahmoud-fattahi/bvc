<?php

namespace App;
use Laravel\Cashier\Billable;
use Illuminate\Database\Eloquent\Model;


class User extends Authenticatable
{
    use Billable;
}
