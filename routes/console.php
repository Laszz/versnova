<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('orders:expire')->everyMinute();
Schedule::command('flashsale:expire')->everyMinute();
Schedule::command('rental:expire')->everyMinute();
Schedule::command('database:backup')->daily();
