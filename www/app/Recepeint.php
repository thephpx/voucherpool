<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recepient extends Model{
	
	protected  $table = 'recepients';

	private $timestamp = false;

	public function vouchers()
	{
		return $this->hasMany('App\Voucher');
	}
}