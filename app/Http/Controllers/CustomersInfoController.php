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
    public function index()
    {
        try {
            $pageTitle = 'List of Customer Info';
            $getCustomerInfo = CustomerInfo::paginate(10);
            return view('customer-info.index', compact('pageTitle', 'getCustomerInfo'));
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
    public function create()
    {
        try {
            $pageTitle = 'Crate New Customer Info';
            $form = Form::where('status', 1)->first();
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
    public function store(Request $request)
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
            CustomerInfo::create($data);
            return redirect('customer-info')->with('success', 'Successfully Create Customer Info');
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
    public function show($id)
    {
        try {
            $pageTitle = 'Show Customer Info';
            $customerInfo = CustomerInfo::findOrFail($id);
            return view('customer-info.show', compact('pageTitle', 'customerInfo'));
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
    public function edit($id)
    {
        try {
            $pageTitle = 'Edit Customer Info';
            $customerInfo = CustomerInfo::findOrFail($id);
            return view('customer-info.edit', compact('pageTitle', 'customerInfo'));
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
    public function update(Request $request, $id)
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
            return redirect('customer-info')->with('success', 'Successfully Updated Customer Info');
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
    public function destroy($id)
    {
        try {
            $customerInfo = CustomerInfo::findOrFail($id);
            $customerInfo->delete();
            return redirect('customer-info')->with('success', 'Successfully Deleted Customer Info');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return back()->with('error', $bug);
        }
    }
}
