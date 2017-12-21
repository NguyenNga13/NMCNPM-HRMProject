<?php

namespace App\Http\Controllers\Hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Charts;
use DB;
use App\Model\EmpProfile;

class ReportController extends Controller
{

	public function genderReport(Request $request)
	{
		if($request->ajax()){

			// $type = $request->type;
			// $begin = $request->begin;
			// $finish = $request->finish;

			// $data = EmpProfile::select('gender',DB::raw('count(id) as num'))
			// ->where('date_begin', '<' , $finish)
			// ->groupBy(DB::raw('gender'))
			// ->get();

			// $num;
			// $i = 0;
			// foreach ($data as $key => $value) {
			// 	$num[$i] = $value->num;
			// 	$i++;
			// }

			// $male = round($num[1]/($num[0] + $num[1])*100, 1);
			// $female = round($num[0]/($num[0] + $num[1])*100, 1);

			// $json = json_encode([["no"=>1,"gender"=>"Nữ", "num"=>$num[0], "rate"=>$female], ["no"=>2, "gender"=>"Nam", "num"=>$num[1], "rate"=>$male]]);
			// $json = json_decode($json);


			$chart = Charts::create('pie', 'highcharts')
			->title('Gender chart')
			->elementLabel('gender')
			->labels(['Nữ', 'Nam'])
			->values([4,4])
			->responsive(false);
    		// $chart = $chart->render();
			// return response()->json(['data'=>$json, 'chart'=>$chart]);
			return $chart->render();
		}




		$data = EmpProfile::select('gender', DB::raw('count(id) as num'))->groupBy(DB::raw('gender'))->get();
		$chart = Charts::create('pie', 'highcharts')
		->title('Gender chart')
		->elementLabel('gender')
		->labels(['Nữ', 'Nam'])
		->values($data->pluck('num'))
		->responsive(false);

    	// if($request->ajax()){
    	// 	$chart = Charts::create('pie', 'highcharts')
    	// 				->title('Gender chart')
    	// 				->elementLabel('gender')
    	// 				->labels(['Nữ', 'Nam'])
    	// 				->values([4,4])
    	// 				->responsive(true);

    	// 	return$chart->render();
    	// }
		$num;
		$i = 0;
		foreach ($data as $key => $value) {
			$num[$i] = $value->num;
			$i++;
		}

		$male = round($num[1]/($num[0] + $num[1])*100, 1);
		$female = round($num[0]/($num[0] + $num[1])*100, 1);

		$json = json_encode([["no"=>1,"gender"=>"Nữ", "num"=>$num[0], "rate"=>$female], ["no"=>2, "gender"=>"Nam", "num"=>$num[1], "rate"=>$male]]);
		$json = json_decode($json);
		return view('hrm.report.structure.structure', ['data'=>$json, 'chart'=>$chart]);
	}
}
