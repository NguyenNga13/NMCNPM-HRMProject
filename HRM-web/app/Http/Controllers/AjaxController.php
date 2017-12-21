<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    //
	public function getAddress($province)
	{
		$string = file_get_contents('json/tree.json');
		$json = json_decode($string, true);
		foreach ($json as $key => $value){
			if($value['name'] == $province){
				foreach ($value['quan-huyen'] as $key => $value) {
					echo "<option value='".$value['name']."'>".$value['name']."</option>";
				}

			}
		}
	}

	public function getProvince($district)
	{
		$string = file_get_contents('json/tree.json');
		$json = json_decode($string, true);
		foreach ($json as $key => $value) {
			$province = $value['name'];
			foreach ($value['quan-huyen'] as $key => $value) {
				if($value['name'] == $district){
					return $province;
				}	
			}
		}
	}
}
