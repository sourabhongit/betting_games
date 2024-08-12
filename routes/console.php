<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('app:create-head-and-tail-log')->everyMinute();
Schedule::command('app:create-dragon-tiger-log')->everyMinute();