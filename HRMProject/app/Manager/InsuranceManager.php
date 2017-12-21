<?php
namespace App\Manager;

use App\Model\Insurance;
use Carbon\Carbon;

/**
 * class manager insurance
 */
class InsuranceManager
{

	public function getListInsurance()
	{
		$current_date =  Carbon::now()->format('Y-m-d');
		$insurance = Insurance::where([
			['applied_finish','=', null],
			['applied_begin', '<=', $current_date],
		])
		->orWhere([
			['applied_finish', '>', $current_date],
			['applied_begin', '<=', $current_date],
		])
		->get();
		return $insurance;
	}

	public function getDetail($id)
	{
		$insurance = Insurance::findOrFail($id);
		return $insurance;
	}

	public function addInsurance($request)
	{
		if(Insurance::where('insurance', '=', $request->insurance)->first()){
			return 0;
		}

		$insurance = new Insurance;
		$insurance->insurance = $request->insurance;
		$insurance->rate_for_business = $request->rate_for_business;
		$insurance->rate_for_laborer = $request->rate_for_laborer;
		$insurance->applied_begin = $request->applied_begin;
		$insurance->note = $request->note;
		$insurance->save();
		return $insurance;
	}

	public function updateInsurance($id, $request)
	{
		$insurance = Insurance::findOrFail($id);
		if($insurance){
			if($request->rate_for_laborer != $insurance->rate_for_laborer || $request->rate_for_business != $insurance->rate_for_business){
				$new = new Insurance;
				$new->insurance = $request->insurance;
				$new->rate_for_business = $request->rate_for_business;
				$new->rate_for_laborer = $request->rate_for_laborer;
				$new->applied_begin = $request->applied_begin;
				$new->note = $request->note;
				$new->save();
				$insurance->applied_finish = $request->applied_begin;
				$insurance->save();
				return $new;
			}else{
				$insurance->insurance = $request->insurance;
				$insurance->applied_begin = $request->applied_begin;
				$insurance->note = $request->note;
				$insurance->save();
				return $insurance;
			}
		}
		return 0;
	}

	public function deleteInsurance($id)
	{
		$insurance = Insurance::findOrFail($id);
		Insurance::where('insurance', '=', $insurance->insurance)->delete();
		$insurance->delete();
		return $insurance;
	}

}