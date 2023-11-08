<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\admin\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Inquiry;
use Illuminate\Support\Str;
use Carbon\Carbon;

class InquiryController extends BaseController
{
    public function index() {
	    return view('admin.inquiry')->with([
			'title' => 'Inquiry', 
			'segment' => 'inquiry',
		]);
	}

	public function show(Inquiry $inquiry) {

		// $dayDiff = Carbon::parse(Carbon::now())->diffInDays($inquiry->created_at->format('Y-m-d'));

		$inquiry->date = $inquiry->created_at->format('D, M d Y, h:i A'); 

		return $this->sendResponse($inquiry, 'Inquiry');
	}

	public function populate(Request $request) {

		$page = $request->page;

		$inquiries = Inquiry::where([ 'deleted' => 0 ])->orderBy('created_at', 'DESC')->get();
		

		foreach ($inquiries as $inquiry) {
			
			$inquiry->name = Str::title($inquiry->name);
			$inquiry->subject = Str::title($inquiry->subject);
			$inquiry->message = $inquiry->message;
			$inquiry->inquiry = $inquiry->inquiry;
			$inquiry->date = $inquiry->created_at->format('m/d/Y');
		}

		return $this->sendResponse($inquiries, 'Inquiries');
	}

	public function store(Request $request) {
		
		$inquiry = new Inquiry();

		$inquiry->name = $request->name;
		$inquiry->email_address = $request->email_address;
		$inquiry->contact_number = $request->contact_number;
		$inquiry->subject = $request->subject;
		$inquiry->message = $request->message;
		$inquiry->inquiry = isset($request->inquiry) ? $request->inquiry : '';
		$inquiry->save();

		if( $inquiry->inquiry_id ) {

			if( $request->page == 'contact' ){
				return redirect()->route('contact-us')->with( 
					'status', [
						'header' => 'Inquiry sent', 
						'message' => 'Thank you for your inquiry.'
					]
				);
			}
			
			return response()->json(['status' => 'success', 'message' => 'Inquiry Sent!']);
		}else{

			if( $request->page == 'contact' ){

				return redirect()->route('contact-us')->with( 
					'status', [
						'header' => 'Inquiry was not sent!', 
						'message' => 'Something Went Wrong!'
					]
				);

			}

			return response()->json(['status' => 'error', 'message' => 'Something Went Wrong!']);
		}
	}

	public function destroy($id) {

		$inquiries = Inquiry::whereIn('inquiry_id', explode(',', $id))->get();

		foreach ($inquiries as $inquiry) {
			$inquiry->delete();
		}

		return $this->sendResponse($id, 'Delete');
	}

}
