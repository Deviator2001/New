<?php

Admin::menu()->url('/')->label('Start page')->icon('fa-dashboard');
Admin::menu(App\Permit::class)->label('Права')->icon('fa-key');
