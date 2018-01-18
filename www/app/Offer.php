<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model{
	
	protected  $table = 'offers';

	private $timestamp = false;

	public function vouchers()
	{
		return $this->hasMany('App\Voucher');
	}
}