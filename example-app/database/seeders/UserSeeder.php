<?php

use Illuminate\Support\Facades\DB;

DB::table('users')->insert([
	[
		'name' => 'admin',
		'email' => 'admin@gmail.com',
		'password' => bcrypt('123456'),
        'image' => '1715002389_download.jpg',
        'phonenumber' => '0398765432',
	],
]);


