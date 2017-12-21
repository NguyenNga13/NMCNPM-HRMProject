<?php

namespace App\Http\Controllers\Hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Manager\PositionManager;

class PositionController extends Controller
{
	private $pos_manager;

	public function __construct()
	{
		$this->pos_manager= new PositionManager();
	}

    /**
	 * Danh sách chức vụ
	 */
    public function getList()
    {
    	$pos_list = $this->pos_manager->getList();

    	return view('hrm.organize.position.list', ['pos_list'=>$pos_list]);
    }

    /**
     * Thêm chức vụ
     */
    public function postAdd(Request $request)
    {
    	$result = $this->pos_manager->add($request);
		if($result)
			return redirect('hrm/organize/pos_list')->with('notify', 'Thêm thành công');
		else
			return redirect('hrm/organize/pos_list')->with('notify', 'Thêm thất bại');

    }

    /**
     * Sửa chức vụ
     */
    public function postEdit(Request $request)
    {
    	$this->pos_manager->edit($request);
		return redirect('hrm/organize/pos_list')->with('notify', 'Sửa thành công thông tin chức vụ');
    }

    /**
     * Xóa chức vụ
     */
    public function getDelete($id)
    {
    	$this->pos_manager->delete($id);
    	return redirect('hrm/organize/pos_list')->with('notify', 'Xóa thành công');
    }

}
