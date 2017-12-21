<?php

namespace App\Http\Controllers\Hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Manager\PayScaleManager;
use App\Http\Controllers\Auth\JWTAuth\JwtAuth;
use App\Manager\PermissionManager;


class PayScaleController extends Controller
{
	private $pay_scale_manager;

	function __construct()
	{
		$this->pay_scale_manager = new PayScaleManager();
	}

    public function getListPayScale()
    {
    	$pay_scale = $this->pay_scale_manager->getListPayScale();
        $pay_rate_basic = $this->pay_scale_manager->getPayRateBasic();
        return view('hrm.salary.pay_scale.pay_scale', ['pay_scale'=>$pay_scale, 'pay_rate_basic'=>$pay_rate_basic]);
    }

    public function getPayScale($id)
    {
    	$scale = $this->pay_scale_manager->getPayScale($id);
    	return response()->json($scale);
    }

    public function getNewPayScaleCode($scale)
    {
    	$code = $this->pay_scale_manager->createPayScaleCode($scale);
    	return response()->json($code);
    }

    /**
     * get add payscale => check permission to add payscale
     */
    public function getAddPayScale()
    {
        $auth = new JwtAuth();
        $checkPermission = $auth->checkPermission(PermissionManager::ID_PERMISSION_CREATE_PAYSCALE);
        return response()->json(['check'=>$checkPermission]);
    }

    public function postAddPayScale(Request $request)
    {
    	$scale = $this->pay_scale_manager->addPayScale($request);
    	return response()->json($scale);
    }

    public function postUpdatePayScale($id, Request $request)
    {
    	$scale = $this->pay_scale_manager->updatePayScale($id, $request);
    	return response()->json($scale);

    }

    public function putEditPayScale($id, Request $request)
    {
    	$scale = $this->pay_scale_manager->editPayScale($id, $request);
    	return response()->json($scale);
    }

    public function getDeletePayScale($id)
    {
    	$scale = $this->pay_scale_manager->deletePayScale($id);
    	return response()->json($scale);
    }

    public function getPayRateBasic()
    {
        $pay_rate_basic = $this->pay_scale_manager->getPayRateBasic();
        if($pay_rate_basic)
            return response()->json($pay_rate_basic);
        else {
            return response()->json(0);
        }

    }

    public function postUpdatePayRateBasic(Request $request)
    {
        $pay_rate_basic = $this->pay_scale_manager->addPayRateBasic($request);
        return response()->json($pay_rate_basic);
    }

    public function postEditPayRateBasic(Request $request)
    {
        $pay_rate_basic = $this->pay_scale_manager->editPayRateBasic($request);
        return response()->json($pay_rate_basic);
    }

    public function getRangeOfPayScale($code)
    {
        $range = $this->pay_scale_manager->getRangeOfPayScale($code);
        return response()->json($range);
    }


}
