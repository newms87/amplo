<?php

namespace App\Http\Controllers;

class TestController extends Controller
{
	public function myAccount()
	{
		return view('test.my-account');
	}
}
