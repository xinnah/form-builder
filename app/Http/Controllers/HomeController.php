<?php

namespace App\Http\Controllers;

use App\CustomerInfo;
use DB;
use Illuminate\Http\Request;
use jazmy\FormBuilder\Models\Form;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function statusUpdate(Request $request)
    {
        $input = $request->all();
        DB::beginTransaction();
        try {
            $form = Form::findOrFail($input['id']);
            $status = 1;
            if($form->status == 1){
                $status = 0;
            }

            // select form set status active
            $form->update(['status' => $status]);
            DB::commit();
            return back()->with('success', "Now '{$form->name}' Form is Active.");
        } catch (\Exception $e) {
            DB::rollback();
            $bug = $e->getMessage();
            return back()->with('error', $bug);
        }
        return $input;
    }

    public function activeForms()
    {
        $forms = Form::where('status', 1)->orderBy('id', 'desc')->get();
        return view('active-forms-info.index', compact('forms'));
    }

    // public function customerInfo($id)
    // {
    //     try {
    //         $form = Form::findOrFail($id);
    //         if($form != ''){
    //             $pageTitle = 'List of Customer Info';
    //             $getCustomerInfo = CustomerInfo::where('form_id', $id)->paginate(10);
    //             return view('customer-info.index', compact('pageTitle', 'getCustomerInfo', 'form'));
    //         }
    //         return redirect('form-builder/forms')->with('error', 'No Form Found!');
    //     } catch (\Exception $e) {
    //         $bug = $e->getMessage();
    //         return back()->with('error', $bug);
    //     }
    // }
}
