<?php
namespace App\Manager;

use Carbon\Carbon;

use App\Model\PayScale;
use App\Model\PayRateBasic;

/**
 * Class manager pay scale
 */
class PayScaleManager
{

	/**
	 * get current list of pay scale
	 */
	public function getListPayScale()
	{
		$current_date =  Carbon::now()->format('Y-m-d');
		$scale = PayScale::where([
			['applied_finish','=', null],
			['applied_begin', '<=', $current_date],
		])->orWhere([
			['applied_finish', '>', $current_date],
			['applied_begin', '<=', $current_date],
		])->get();
		return $scale;
	}


	/**
	 * get a pay scale by id
	 */
	public function getPayScale($id)
	{
		$scale = PayScale::find($id);
		return $scale;
	}
	
	/**
	 * create pay_scale_code from pay_scale name
	 */
	public function createPayScaleCode($name)
	{
		$scale = PayScale::where('pay_scale', '=', $name)->first();
		if($scale){
			return 0;
		}

		$name = stripUnicode(trim($name));
		$arr = explode(' ', $name);
		$length = count($arr);
		$code = "";
		for($i = 0; $i<count($arr); $i++){
			$code = $code.substr($arr[$i], 0, 1);
		}
		$code = strtoupper($code);
		$i = 1;
		while (PayScale::where('pay_scale_code', '=', $code)->first()) {
			$code = $code.(string)$i;
			$i++;
		}
		return $code;
	}

	/**
	 * add pay scale
	 */
	public function addPayScale($request)
	{
		$scale = new PayScale;
		$scale->pay_scale = $request->pay_scale;
		$scale->pay_scale_code = $request->pay_scale_code;
		$scale->range = $request->range;
		$scale->applied_begin = $request->applied_begin;
		$scale->applied_finish = $request->applied_finish;
		$scale->note = $request->note;
		$scale->save();
		return $scale;
	}

	/**
	 * edit pay scale when info were wrong
	 */
	public function editPayScale($id, $request)
	{
		$scale = PayScale::find($id);
		if($scale){
			$scale->pay_scale = $request->pay_scale;
			$scale->pay_scale_code = $request->pay_scale_code;
			$scale->range = $request->range;
			$scale->applied_begin = $request->applied_begin;
			$scale->applied_finish = $request->applied_finish;
			$scale->note = $request->note;
			$scale->save();
			return $scale;
		}
		return 0;
	}


	/**
	 * update when change info
	 */
	public function updatePayScale($id, $request)
	{
		$scale = PayScale::find($id);
		if($scale){
			$scale->applied_finish = $request->applied_begin;
			$scale->save();

			$new = $this->addPayScale($request);
			return $new;
		}
		return 0;
	}

	/**
	 * delete all info of pay scale
	 */
	public function deletePayScale($id)
	{
		$scale = PayScale::find($id);
		$all = PayScale::where('pay_scale_code', '=', $scale->pay_scale_code)->delete();
		return $scale;
	}

	/**
	 * get current applied pay rate basic
	 */
	public function getPayRateBasic()
	{
		$current_date =  Carbon::now()->format('Y-m-d');
		$payrate = PayRateBasic::where([
			['applied_finish','=', null],
			['applied_begin', '<=', $current_date],
		])->orWhere([
			['applied_finish', '>', $current_date],
			['applied_begin', '<=', $current_date],
		])->first();
		return $payrate;
	}

	/**
	 * add new pay rate basic - when update
	 */
	public function addPayRateBasic($request)
	{
		$old = $this->getPayRateBasic();
		if($old){
			if($old->pay_rate_basic == $request->pay_rate_basic){
				return -1; //pay rate unchange
			}
			$old->applied_finish = $request->applied_begin;
			$old->save();
		}
		$new = new PayRateBasic;
		$new->pay_rate_basic = $request->pay_rate_basic;
		$new->applied_begin = $request->applied_begin;
		$new->note = $request->note;
		$new->save();
		return $new;
	}

	/**
	 * edit pay rate basic when something wrong
	 */
	public function editPayRateBasic($request)
	{
		$payrate = $this->getPayRateBasic();
		if($payrate){
			$payrate->pay_rate_basic = $request->pay_rate_basic;
			$payrate->applied_begin = $request->applied_begin;
			$payrate->note = $request->note;
			$payrate->save();
			return $payrate;
		}else{
			return -1; //not found
		}
	}

	/**
	 * get range of pay scale by pay_scale_code
	 */
	public function getRangeOfPayScale($code)
	{
		$current_date =  Carbon::now()->format('Y-m-d');
		$scale = PayScale::where([
			['pay_scale_code', '=', $code],
			['applied_finish','=', null],
			['applied_begin', '<=', $current_date],
		])->orWhere([
			['pay_scale_code', '=', $code],
			['applied_finish', '>', $current_date],
			['applied_begin', '<=', $current_date],
		])->first();
		$range = json_decode($scale->range);
		return $range;
	}
}