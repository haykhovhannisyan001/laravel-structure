<?php

function appraisalStatuses() {
	$statuses = [];
	foreach (App\Models\Appraisal\Status::all() as $value) {
		$statuses[$value->id] = $value->descrip;
	}
	return $statuses;
}