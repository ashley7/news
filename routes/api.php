<?php
use Illuminate\Http\Request;
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', 'NewContentController@login')->name('login');

Route::get('test',function(){

	function get_combinations($arrays) {
		$result = array(array());
		foreach ($arrays as $property => $property_values) {
			$tmp = array();
			foreach ($result as $result_item) {
				foreach ($property_values as $property_value) {
					$tmp[] = array_merge($result_item, array($property => $property_value));
				}
			}
			$result = $tmp;
		}
		return $result;
	}

	$combinations = get_combinations(
		array(
			'Ticket 1' => array('A', 'B','1'),
			'Ticket 2' => array('C', 'D','3'),
			'Ticket 3' => array('E', 'F','4'),
			'Ticket 4' => array('E', 'R','4'),
		)
	);

	foreach (($combinations) as $value) {
		echo json_encode($value)."<br>";
	}

});

