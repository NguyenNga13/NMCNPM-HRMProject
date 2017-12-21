<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Charts;
use App\User;
use DB;
use App\Model\EmpProfile;

class ChartController extends Controller
{
	public function index()
	{
		$user = User::where(DB::raw("(DATE_FORMAT(created_at, '%Y'))"), date('Y'))->get();
		$chart = Charts::database($user, 'bar', 'highcharts')
						->title("Monthly new Register Users")
						->elementLabel("Total Users")
						->dimensions(1000, 500)
						->responsive(false)
						->groupByMonth(date('Y'), true);
		return view('hrm.report.structure.structure', compact('chart'));
	}


	public function barChart()
	{
		$chart = Charts::multi('bar', 'material')
			            // Setup the chart settings
						->title("My Cool Chart")
			            // A dimension of 0 means it will take 100% of the space
			            ->dimensions(0, 400) // Width x Height
			            // This defines a preset of colors already done:)
			            ->template("material")
			            // You could always set them manually
			            // ->colors(['#2196F3', '#F44336', '#FFC107'])
			            // Setup the diferent datasets (this is a multi chart)
			            ->dataset('Element 1', [5,20,100])
			            ->dataset('Element 2', [15,30,80])
			            ->dataset('Element 3', [25,10,40])
			            // Setup what the values mean
			            ->labels(['One', 'Two', 'Three']);
		return view('hrm.report.structure.structure', compact('chart'));
    }
   


    public function pieChart(Request $request)
    {


    	$data = EmpProfile::select('gender', DB::raw('count(id) as aggregate'))->groupBy(DB::raw('gender'))->get();
    	$chart = Charts::create('pie', 'highcharts')
    					->title('Gender chart')
    					->elementLabel('gender')
    					->labels(['Nữ', 'Nam'])
    					->values($data->pluck('aggregate'))
    					->responsive(true);

    	if($request->ajax()){
    		$chart = Charts::create('pie', 'highcharts')
    					->title('Gender chart')
    					->elementLabel('gender')
    					->labels(['Nữ', 'Nam'])
    					->values([4,4])
    					->responsive(true);

    		return $chart->render();
    	}
    	return view('hrm.report.structure.structure', compact('chart'));
    }

    public function chart()
    {
    	$chart = Charts::url(url('http://localhost:8080/laravel/HRMProject/public/t'), 'pie', 'highcharts');
    	return view('hrm.report.structure.structure', compact('chart'));
    }

    public function data()
    {
    	return response()->json(['cols'=>[['id'=>"", "label"=>"Topping", "pattern"=>"","type"=>"string"], 
									  ["id"=>"","label"=>"Slices","pattern"=>"","type"=>"number"]],
							 'rows'=>[
							 	["c"=>[["v"=>"Mushrooms","f"=>null],["v"=>3,"f"=>null]]],
							 	["c"=>[["v"=>"Onions","f"=>null],["v"=>7,"f"=>null]]],
							 	["c"=>[["v"=>"Olives","f"=>null],["v"=>2,"f"=>null]]],
							 	["c"=>[["v"=>"Zucchini","f"=>null],["v"=>1,"f"=>null]]],
							 	["c"=>[["v"=>"Pepperoni","f"=>null],["v"=>2,"f"=>null]]],
							 ],
							]);
    }

    public function chartDemo()
    {
    	return view('hrm.report.structure.chart');
    }
 }