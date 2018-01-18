<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model{

	protected $table = 'vouchers';

	private $timestamp = true;

    public function getCreatedAtAttribute($value)
    {
    	return Date("d/m/Y",strtotime($value));
    }

    public function getExpiryDateAttribute($value)
    {
    	return Date("d/m/Y",strtotime($value));
    }

    public function getUsageDateAttribute($value)
    {
    	if(is_null($value) || empty($value))
    	{
    		return 'N/A';
    	}else{
    		return Date("d/m/Y",strtotime($value));
    	}
    }

    public function scopeCheckCode($query,$str="")
    {
    	if($str == '') return false;

    	return $query->where('code',$str);
    }

	public function recepient()
	{
		return $this->belongsTo('App\Recepient');
	}

	public function offer()
	{
		return $this->belongsTo('App\Offer');
	}

}