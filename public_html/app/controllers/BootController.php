<?php

class BootController extends BaseController {
	public function getIndex () {
		$v = Vendedor::where("user_id","=",Auth::user()->id)->first();
		return View::make("dashboard.layouts.default")->with(array("v" => $v));
	}
}