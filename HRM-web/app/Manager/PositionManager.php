<?php
namespace App\Manager;

use App\Model\Position;


/**
* Class quản lý chức vụ
*/
class PositionManager
{
	
	function __construct()
	{
	}


	/**
	 * Lấy danh sách chức vụ
	 */
	public function getList()
	{
		$position_list = Position::all();
		return $position_list;
	}

	/**
	 * Thêm chức vụ
	 */
	public function add($request)
	{
		if(!empty($request)){
			$pos = new Position;
			$pos->position = $request->position;
			$pos->date_established = $request->date_established;
			$pos->decided_established = $request->decided_established;
			$pos->description = $request->description;
			$pos->save();

			$last = Position::all()->last();
			$id = $last->id;
			return $id;
		}
		return 0;

	}

	public function edit($request)
	{
		$pos = Position::findOrFail($request->id);
		$pos->position = $request->position;
		$pos->date_established = $request->date_established;
		$pos->decided_established = $request->decided_established;
		$pos->description = $request->description;
		$pos->save();
	}

	public function delete($id)
	{
		Position::findOrFail($id)->delete();
	}
}
?>