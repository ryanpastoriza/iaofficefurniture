<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\admin\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends BaseController {
    
	public function index() {
		return view('admin.company')->with([
			'title' => 'Company', 
			'segment' => 'company',
		]);
	}

	public function show() {

		$company = Company::find(1);
		return $this->sendResponse($company, 'Company');

	}

	public function update(Request $request, Company $company) {

		$input = $request->all();
		$company->name = $input['name'];
		$company->address = $input['address'];
		$company->phone = $input['phone'];
		$company->mobile = $input['mobile'];
		$company->facebook = $input['facebook'];
		$company->twitter = $input['twitter'];
		$company->instagram = $input['instagram'];
		$company->linkedin = $input['linkedin'];
		$company->save();

		return $this->sendResponse($company, 'Company has been updated');
	}

}
