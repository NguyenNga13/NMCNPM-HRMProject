<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Database\Query\Builder;

use App\Model\Role;
use App\User;
use App\Model\EmpProfile;
use App\Model\Department;
use App\Model\EmpPosition;
use App\Manager\EmpManager;
use App\Manager\PositionManager;
use App\Manager\DepartmentManager;
use App\Model\EmpLanguage;
use App\Model\EmpRelative;
use App\Crypt\AESCrypt;
use App\Crypt\AESCipher;
use App\Crypt\AESKey;
use App\Model\EmpLaborContract;
use App\Model\Notify;
use App\Manager\UserManager;
use App\Model\EmpUpdateProfile;
use App\Model\RoleUser;
use App\Model\PermissionRole;
use App\Model\Permission;
use App\Manager\RoleManager;

use App\Manager\NotifyManager;
use App\Model\Insurance;
use App\Model\Allowance;
use App\Model\AllowanceLevel;
use App\Manager\PermissionManager;
use App\Manager\EmpUpdateProfileManager;
use App\Manager\PayScaleManager;


Route::get('/home', function () {
	// return view('login');
	return view('login');
});

Route::get('t', function(){
	// $update = EmpUpdateProfile::find(18);
	// $update->status = EmpUpdateProfileManager::UPDATE_STATUS_LATER;
	// $update->confirmed_by = 2;
	// $update->save();
	// return $update;

	// $up = new EmpUpdateProfileManager();
	// $update = $up->confirm(18, 2, 2);
	// echo $update;
	// $payscale = new PayScaleManager();
	// $rate = $payscale->getPayRateBasic();
	// echo $rate;
	// if($rate)
	// 	echo 1;
	// else
	// 	echo 0;
	echo time() +60;
	echo "<br>";
	echo time();
	echo time()+ 3600;
});

Route::get('test', 'Admin\UserController@getExcel');

// Route::get('test', 'ChartController@index');
Route::get('test2', 'ChartController@barChart');
Route::get('test3', 'ChartController@pieChart');
Route::get('test4', 'ChartController@chart');
Route::get('test5', 'ChartController@data');
Route::get('test6', 'ChartController@chartDemo');

Route::get('login', 'Auth\LoginController@getlogin');
Route::post('login', 'Auth\LoginController@postLogin');

Route::get('logout', 'Auth\LoginController@getLogout');

Route::group(['prefix'=>'admin', 'middleware'=>'isAdmin'], function(){


	// for permission
	Route::get('permission', 'Admin\PermissionController@getList');
	Route::get('permission-detail/{id}', 'Admin\PermissionController@getDetail');
	Route::post('permission-add', 'Admin\PermissionController@postAdd');
	Route::put('permission-edit/{id}', 'Admin\PermissionController@postEdit');
	Route::get('permission-delete/{id}', 'Admin\PermissionController@getDelete');
	Route::get('permission-delete-group/{list}', 'Admin\PermissionController@getDeleteList');

	// for role
	Route::group(['prefix'=>'role'], function(){
		Route::get('/', 'Admin\RoleController@getList');
		Route::get('detail/{id}', 'Admin\RoleController@getDetail');
		Route::get('permission-not/{id}', 'Admin\RoleController@getListPermissionNotInRole');
		Route::post('add', 'Admin\RoleController@postAdd');
		Route::post('edit/{id}', 'Admin\RoleController@postEdit');
		Route::get('delete/{id}', 'Admin\RoleController@getDelete');
		Route::get('delete-group/{list_id}', 'Admin\RoleController@getDeleteList');
		Route::get('remove-permission/{id}', 'Admin\RoleController@getDeletePermissionRole');
	});
	
	

	Route::group(['prefix'=>'user'], function(){
		Route::get('/', 'Admin\UserController@getList');
		Route::get('detail/{id}', 'Admin\UserController@getDetail');
		Route::get('info/{id}', 'Admin\UserController@getInfoUser');
		Route::get('role-not/{id}', 'Admin\UserController@getRoleNotInUser');
		Route::get('create-mail/{emp_code}', 'Admin\UserController@getCreateEmpMail');
		Route::post('add', 'Admin\UserController@postAdd');
		Route::get('add-by-file', 'Admin\UserController@getAddByFile')->name('add-by-file');
		Route::post('add-by-file', 'Admin\UserController@postUploadFile');
		Route::post('confirm-add-by-file', 'Admin\UserController@postAddUserByFile');
		
		Route::put('edit/{id}', 'Admin\UserController@putEdit');

		Route::get('delete/{id}', 'Admin\UserController@getDelete');
		Route::get('remove-role/{id}', 'Admin\UserController@getDeleteRoleUser');
	});

	// Route::get('user', 'Admin\AdminController@indexUser');
});


Route::group(['prefix'=>'emp', 'middleware'=>'isEmployee'], function(){
	Route::group(['prefix'=>'profile'], function(){
		Route::get('/', 'Emp\ProfileController@getProfile');

		Route::group(['prefix'=>'update'], function(){
			Route::post('profile', 'Emp\ProfileController@postUpdateProfile');

		});
	});
	
});

Route::group(['prefix'=>'hrm', 'middleware'=>'isHrm'], function(){

	Route::get('test', 'Hrm\HrmController@testPermission');
	Route::get('test2', 'Hrm\HrmController@test');


	Route::group(['prefix'=>'notify'], function(){
		Route::get('/{id}', 'NotifyController@getNotify');
	});


	Route::group(['prefix'=>'report'], function(){
		Route::group(['prefix'=>'structure'], function(){
			Route::get('gender', 'ReportController@genderReport');
		});


	});

	Route::group(['prefix'=>'organize'], function(){
		Route::get('dep_list', 'Hrm\DepartmentController@getList');
		Route::get('dep_detail/{id}', 'Hrm\DepartmentController@getDetail');
		Route::post('dep_add', 'Hrm\DepartmentController@postAdd');
		Route::post('dep_edit', 'Hrm\DepartmentController@postEdit');
		Route::get('dep_delete/{id}', 'Hrm\DepartmentController@getDelete');


		Route::get('pos_list', 'Hrm\PositionController@getList');
		Route::post('pos_add', 'Hrm\PositionController@postAdd');
		Route::post('pos_edit', 'Hrm\PositionController@postEdit');
		Route::get('pos_delete/{id}', 'Hrm\PositionController@getDelete');



	});
	Route::group(['prefix'=>'emp'], function(){
		Route::get('list', 'Hrm\ProfileController@getList');
		Route::get('detail/{id}', 'Hrm\ProfileController@getDetail');
		Route::get('add', 'Hrm\ProfileController@getAdd');
		Route::post('add', 'Hrm\ProfileController@postAdd');
		Route::post('edit', 'Hrm\ProfileController@postEdit');

		Route::get('pos_dept_list', 'Hrm\HrmController@getPosDept');
		Route::get('salary_source', 'Hrm\HrmController@getSalarySource');
		Route::get('pay_range/{code}', 'Hrm\PayScaleController@getRangeOfPayScale');

		// Confirm update by hrm
		Route::group(['prefix'=>'update'], function(){
			Route::get('/{id}', 'Hrm\HrmController@confirmUpdate');
			Route::post('profile', 'Hrm\HrmController@confirmUpdateProfile');
			Route::post('message', 'Hrm\HrmController@postSendMessage');
		});





		Route::group(['prefix'=>'relatives'], function(){
			Route::get('detail/{id}', 'Hrm\RelativesController@getDetail');

			Route::get('add/{id_emp}', 'Hrm\RelativesController@getAdd' );
			Route::post('add', 'Hrm\RelativesController@postAdd');

			Route::put('edit/{id}', 'Hrm\RelativesController@putEdit');
			Route::get('delete/{id}', 'Hrm\RelativesController@getDelete');
		});


		Route::group(['prefix'=>'degree'], function(){
			// Route::get('add/{id_emp}', 'DegreeController@add');
			Route::get('add/{id_emp}', 'Hrm\DegreeController@getAdd');

			Route::group(['prefix'=>'specialized'], function(){
				Route::get('detail/{id}', 'Hrm\DegreeController@detailSpecialized');
				Route::post('add', 'Hrm\DegreeController@addSpecialized');
				Route::put('edit/{id}', 'Hrm\DegreeController@editSpecialized');
				Route::get('delete/{id}', 'Hrm\DegreeController@deleteSpecialized');
			});

			Route::group(['prefix'=>'language'], function(){
				Route::get('detail/{id}', 'Hrm\DegreeController@detailLanguage');
				Route::post('add', 'Hrm\DegreeController@postAddLanguage');
				Route::put('edit/{id}', 'Hrm\DegreeController@editLanguage');
				Route::get('delete/{id}', 'Hrm\DegreeController@deleteLanguage');
			});
		});

		Route::group(['prefix'=>'position'], function(){
			Route::get('detail/{id}', 'Hrm\EmpPositionController@getDetail');

			Route::get('add/{id_emp}', 'Hrm\EmpPositionController@getAdd');
			Route::post('add', 'Hrm\EmpPositionController@postAdd');

			Route::put('edit/{id}', 'Hrm\EmpPositionController@putEdit');
			Route::get('delete/{id}', 'Hrm\EmpPositionController@getDelete');
		});

		Route::group(['prefix'=>'contract'], function(){

			Route::get('detail/{id}', 'Hrm\ContractController@detail');

			Route::get('add/{id_emp}', 'Hrm\ContractController@add');
			Route::post('add', 'Hrm\ContractController@postAdd');

			Route::put('edit/{id}', 'Hrm\ContractController@edit');
			Route::get('delete/{id}', 'Hrm\ContractController@delete');
		});

	});

	Route::group(['prefix'=>'contract'], function(){
		Route::get('list', 'Hrm\ContractController@getList');
		Route::get('detail/{id}', 'Hrm\ContractController@getDetail');
		Route::get('detail_number/{number}', 'Hrm\ContractController@getDetailByContractNumber');

		Route::get('add', 'Hrm\ContractController@getAdd');
		Route::post('add', 'Hrm\ContractController@postAdd');
		
		Route::put('edit/{id}', 'Hrm\ContractController@putEdit');
		Route::get('delete/{id}', 'Hrm\ContractController@getDelete');
	});

	Route::group(['prefix'=>'training'], function(){

	});

	Route::group(['prefix'=>'recruit'], function(){

	});		

	Route::group(['prefix'=>'salary'], function(){
		Route::group(['prefix'=>'source'], function(){
			Route::group(['prefix'=>'allowance'], function(){
				Route::get('allowance', 'Hrm\AllowanceController@getListAllowance')->name('salary-allowance');
				Route::get('new-code/{name}', 'Hrm\AllowanceController@getNewAllowanceCode');
				Route::post('add', 'Hrm\AllowanceController@postAddAllowance');
				Route::post('level/add', 'Hrm\AllowanceController@postAddAllowanceLevel');
				Route::get('list-level/{id}', 'Hrm\AllowanceController@getLevelOfAllowance');
				Route::get('allowance/{id}', 'Hrm\AllowanceController@getAllowance');
				Route::post('update/{id}', 'Hrm\AllowanceController@putUpdateAllowance');
				Route::put('edit/{id}', 'Hrm\AllowanceController@putEditAllowance');
				Route::get('delete/{id}', 'Hrm\AllowanceController@getDeleteAllowance');
			});

			Route::group(['prefix'=>'payscale'], function(){
				Route::get('scale', 'Hrm\PayScaleController@getListPayScale');
				Route::get('scale/{id}', 'Hrm\PayScaleController@getPayScale');
				Route::get('new-code/{scale}', 'Hrm\PayScaleController@getNewPayScaleCode');
				Route::get('get-add', 'Hrm\PayScaleController@getAddPayScale');
				Route::post('add', 'Hrm\PayScaleController@postAddPayScale');
				Route::post('update/{id}', 'Hrm\PayScaleController@postUpdatePayScale');
				Route::put('edit/{id}', 'Hrm\PayScaleController@putEditPayScale');
				Route::get('delete/{id}', 'Hrm\PayScaleController@getDeletePayScale');

				// for pay rate basic
				Route::get('pay-rate-basic', 'Hrm\PayScaleController@getPayRateBasic');
				Route::post('pay-rate-basic/update', 'Hrm\PayScaleController@postUpdatePayRateBasic');
				Route::post('pay-rate-basic/edit', 'Hrm\PayScaleController@postEditPayRateBasic');
			});
		});

		Route::group(['prefix'=>'emp'], function(){
			Route::get('list', 'Hrm\SalaryController@getList');
			Route::get('emp-salary/{id}', 'Hrm\SalaryController@getEmpSalary');
			Route::get('allowance-list', 'Hrm\AllowanceController@getJsonListAllowance');
			Route::get('allowance-level/{code}', 'Hrm\AllowanceController@getLevelOfAllowanceByCode');
			Route::get('emp-allowance/{id}', 'Hrm\SalaryController@getEmpAllowanceById');

			Route::post('allowance/add', 'Hrm\SalaryController@postAddEmpAllowance');
			Route::post('allowance/edit/{id}', 'Hrm\SalaryController@postEditEmpAllowance');
			Route::post('allowance/update/{id}', 'Hrm\SalaryController@postUpdateEmpAllowance');
			Route::get('allowance/delete/{id}', 'Hrm\SalaryController@getDeleteEmpAllowance');

			Route::post('pay-scale/edit/{id_emp}', 'Hrm\SalaryController@postEditEmpPayScale');
			Route::post('pay-scale/update/{id_emp}', 'Hrm\SalaryController@postUpdateEmpPayScale');

			Route::get('emp-scale/{id_emp}', 'Hrm\SalaryController@getEmpPayScale');

			Route::get('search-emp/{code}', 'Hrm\SalaryController@getSearchEmp');


		});

		Route::group(['prefix'=>'paysheet'], function(){
			Route::get('table', 'Hrm\PaySheetController@getPaySheetTable');

			Route::get('add', 'Hrm\PaySheetController@getAddPaySheet');
			Route::get('list-dep', 'Hrm\PaySheetController@getListDep');
			Route::get('get-dep-by-id/{id}', 'Hrm\PaySheetController@getDepById');
			Route::get('get-dep-by-name/{name}', 'Hrm\PaySheetController@getDepByName');
			Route::get('get-emp-by-code/{code}', 'Hrm\PaySheetController@getEmpNameByCode');
			Route::get('get-emp-by-name/{name}', 'Hrm\PaySheetController@getEmpCodeByName');

			Route::get('get-emp-add/{id_emp}', 'Hrm\PaySheetController@getAddEmpPaySheet');
			Route::get('emp-paysheet/{id_emp}', 'Hrm\PaySheetController@getPaySheetByEmp');
			Route::get('paysheet/{id_paysheet}', 'Hrm\PaySheetController@getPaySheet');
		});
	});	

	Route::group(['prefix'=>'insurance'], function(){
		Route::get('insurance', 'Hrm\InsuranceController@getList');
		Route::get('detail/{id}', 'Hrm\InsuranceController@getDetail');
		Route::post('add', 'Hrm\InsuranceController@postAdd');
		Route::put('update/{id}', 'Hrm\InsuranceController@putUpdate');
		Route::get('delete/{id}', 'Hrm\InsuranceController@getDelete');
	});

});

Route::group(['prefix'=>'ajax'], function(){
	Route::get('address/{province}', 'AjaxController@getAddress');
	Route::get('province/{district}', 'AjaxController@getProvince');
});


use App\Manager\EmpSalaryManager;
use App\Manager\EmpPaySheetManager;


Route::get('demo', function(){
	
	$salary = new EmpPaySheetManager();
	
	$emp = $salary->getEmpWorkday(22);
	if(!$emp){
		
		echo "null";
	}else{
		echo $emp;
	}
	



});


