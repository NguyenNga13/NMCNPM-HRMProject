<?php
namespace App\Manager;

use Carbon\Carbon;

use App\Model\Allowance;
use App\Model\AllowanceLevel;

/**
* 
*/
class AllowanceManager
{
	/**
	 * create allowance_code from allowance name
	 */
	public function createAllowanceCode($str)
	{
		$allwance = Allowance::where('allowance', '=', $str)->first();
		if($allwance){
			return 0;
		}
		$str = stripUnicode(trim($str));
		$arr = explode(' ', $str);
		$length = count($arr);
		$code = "";
		for($i = 0; $i<count($arr); $i++){
			$code = $code.substr($arr[$i], 0, 1);
		}
		$code = strtoupper($code);
		$i = 1;
		while (Allowance::where('allowance_code', '=', $code)->first()) {
			$code = $code.(string)$i;
			$i++;
		}

		return $code;

	}

	/**
	 * add allowance
	 */
	public function addAllowance($request)
	{
		$allowance = new Allowance;
		$allowance->allowance = $request->allowance;
		$allowance->allowance_code = $request->allowance_code;
		$allowance->applied_begin = $request->applied_begin;
		$allowance->applied_finish = $request->applied_finish;
		$allowance->value = $request->value;
		$allowance->note = $request->note;
		$allowance->save();
		return $allowance;
	}

	public function getListAllowance()
	{
		$current_date =  Carbon::now()->format('Y-m-d');
		$allowance = Allowance::where([
			['applied_finish','=', null],
			['applied_begin', '<=', $current_date],
		])
		->orWhere([
			['applied_finish', '>', $current_date],
			['applied_begin', '<=', $current_date],
		])
		->get();

		return $allowance;
	}

	/**
	 * get level of allowance by id
	 */
	public function getLevelOfAllowance($id)
	{
		$allowance = Allowance::find($id);
		$level_list = $allowance->value;
		return json_decode($level_list);
	}

	/**
	 * get level of allowance by allowance_code
	 */
	public function getLevelOfAllowanceByCode($code)
	{
		$current_date =  Carbon::now()->format('Y-m-d');
		$allowance = Allowance::where([
			['allowance_code', '=', $code],
			['applied_finish','=', null],
			['applied_begin', '<=', $current_date],
		])
		->orWhere([
			['allowance_code', '=', $code],
			['applied_finish', '>', $current_date],
			['applied_begin', '<=', $current_date],
		])
		->first();

		return json_decode($allowance->value);

	}

	/**
	 * get allowance by code
	 * 
	 * @param   $code [allowance_code]
	 * @return        [object of allowance]
	 */
	public function getAllowanceByCode($code){
		$current_date =  Carbon::now()->format('Y-m-d');
		$allowance = Allowance::where('allowance_code', '=', $code)
		->where([
			['applied_finish','=', null],
			['applied_begin', '<=', $current_date],
		])
		->orWhere([
			['applied_finish', '>', $current_date],
			['applied_begin', '<=', $current_date],
		])
		->first();
		return $allowance;
	}


	public function addAllowanceLevel($request)
	{
		$allowance = $this->getAllowanceByCode($request->allowance_code);

		if($allowance){
			$level = new AllowanceLevel;
			$level->id_allowance = $allowance->id;
			$level->level = $request->level;
			$level->rate = $request->rate;
			$level->value = $request->value;
			$level->note = $request->note;
			$level->save();

			$allowance->value = json_encode(AllowanceLevel::where('id_allowance', '=', $allowance->id)->get());
			$allowance->save();

			return $level;
		}
		return 0;
		// return $allowance;
	}

	/**
	 * get allowance by id
	 */
	public function getAllowance($id)
	{
		if($id == 0){
			$current_date =  Carbon::now()->format('Y-m-d');
			$allowance = Allowance::where([
				['applied_finish','=', null],
				['applied_begin', '<=', $current_date],
			])
			->orWhere([
				['applied_finish', '>', $current_date],
				['applied_begin', '<=', $current_date],
			])
			->first();
			return $allowance;
		}
		$allowance = Allowance::find($id);
		return $allowance;
	}

	/**
	 * edit allowance when info were wrong
	 */
	public function editAllowance($id, $request)
	{
		$allowance = Allowance::find($id);
		if($allowance){
			$allowance->allowance = $request->allowance;
			$allowance->allowance_code = $request->allowance_code;
			$allowance->applied_begin = $request->applied_begin;
			$allowance->applied_finish = $request->applied_finish;
			$allowance->value = $request->value;
			$allowance->note = $request->note;
			$allowance->save();
			return $allowance;
		}
		return $id;
	}

	/**
	 * update allowance when change info
	 */
	public function updateAllowance($id, $request)
	{
		$allowance = Allowance::find($id);
		if($allowance){
			$allowance->applied_finish = $request->applied_begin;
			$allowance->save();

			// $new = new Allowance;
			// $new->allowance = $request->allowance;
			// $new->allowance_code = $request->allowance_code;
			// $new->applied_begin = $request->applied_begin;
			// $new->applied_finish = $request->applied_finish;
			// $new->value = $request->value;
			// $new->note = $request->note;
			// $new->save();
			$new = $this->addAllowance($request);
			return $new;
		}
		return 0;
		
	}

	/**
	 * detele all of a allowance
	 */
	public function deleteAllowance($id)
	{
		$allowance = Allowance::find($id);
		$all = Allowance::where('allowance_code', '=', $allowance->allowance_code)->delete();
		return $allowance;
	}
}