<?php

namespace App\Http\Controllers;

use App\CustomerInfo;
use Illuminate\Http\Request;
use jazmy\FormBuilder\Models\Form;

class CustomersInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($formId)
    {
        try {
            $form = Form::findOrFail($formId);
            if($form != ''){
                $pageTitle = 'List of Customer Info';
                $getCustomerInfo = CustomerInfo::where('form_id', $formId)->paginate(10);
                return view('customer-info.index', compact('pageTitle', 'getCustomerInfo', 'form'));
            }
            return redirect('form-builder/forms')->with('error', 'No Form Found!');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return back()->with('error', $bug);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($formId)
    {
        try {
            $pageTitle = 'Crate New Customer Info';
            $form = Form::where('id', $formId)->first();
            if($form == ''){
                return redirect('/customer-info')->with('error', 'First Create Form / Select Any One Active in a Forms');
            }
            return view('customer-info.create', compact('pageTitle', 'form'));

        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return back()->with('error', $bug);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $formId)
    {
        $user = $request->user();
        $value = array();
        $data = array();
        $request->except('_token');
        $input = $request->all();
        try {
            $totalData = count($input['data']);
            for ($i=0; $i < $totalData; $i++) { 
                $inputData = json_decode($input['data'][$i]);
                $name = $inputData->name;
                $inputData->value = $request->get($name);
                $value[] = $inputData;
            }

            $data['value'] = json_encode($value);
            $data['user_id'] = $user->id;
            $data['form_id'] = $input['form_id'];
            CustomerInfo::create($data);
            return redirect("/forms/$formId/customer-info")->with('success', 'Successfully Create Customer Info');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return back()->with('error', $bug);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($formId, $id)
    {
        try {
            $pageTitle = 'Show Customer Info';
            $customerInfo = CustomerInfo::findOrFail($id);
            return view('customer-info.show', compact('pageTitle', 'customerInfo', 'formId'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return back()->with('error', $bug);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($formId, $id)
    {
        try {
            $pageTitle = 'Edit Customer Info';
            $customerInfo = CustomerInfo::findOrFail($id);
            return view('customer-info.edit', compact('pageTitle', 'customerInfo', 'formId'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return back()->with('error', $bug);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $formId, $id)
    {
        $customerInfo = CustomerInfo::findOrFail($id);
        $user = $request->user();
        $value = array();
        $data = array();
        $request->except('_token');
        $input = $request->all();

        try {
            $totalData = count($input['data']);
            for ($i=0; $i < $totalData; $i++) { 
                $inputData = json_decode($input['data'][$i]);
                $name = $inputData->name;
                $inputData->value = $request->get($name);
                $value[] = $inputData;
            }

            $data['value'] = json_encode($value);
            $data['user_id'] = $user->id;
            $customerInfo->update($data);
            return redirect("/forms/$formId/customer-info")->with('success', 'Successfully Updated Customer Info');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return back()->with('error', $bug);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($formId, $id)
    {
        try {
            $customerInfo = CustomerInfo::findOrFail($id);
            $customerInfo->delete();
            return redirect("/forms/$formId/customer-info")->with('success', 'Successfully Deleted Customer Info');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return back()->with('error', $bug);
        }
    }
}
