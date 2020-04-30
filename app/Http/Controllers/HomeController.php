<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use jazmy\FormBuilder\Models\Form;
use DB;
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
            // all form are update status inactive
            DB::table('forms')->update(['status' => 0]);

            // select form set status active
            $form->update(['status' => 1]);
            DB::commit();
            return back()->with('success', "Now '{$form->name}' Form is Active.");
        } catch (\Exception $e) {
            DB::rollback();
            $bug = $e->getMessage();
            return back()->with('error', $bug);
        }
        return $input;
    }
}
