<?php

namespace App;


use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Notifiable, Billable;
}
