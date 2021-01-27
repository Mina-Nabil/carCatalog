<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Downpayment;
use App\Models\Insurance;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CalculatorController extends Controller
{

    public function index()
    {
        $data = self::getCalculatorData();
        return view('meta.calculator', $data);
    }
    //plans functions
    function addPlan(Request $request){
        $request->validate([
            "downpayment"   => "required|exists:downpayments,id",
            "bank"          => "required|exists:banks,id",
            "interest"      => "required|numeric",
            "years"         => "required|numeric"
        ]);

        $plan = new Plan();
        $plan->PLAN_BANK_ID = $request->bank;
        $plan->PLAN_DOWN_ID = $request->downpayment;
        $plan->PLAN_INTR = $request->interest;
        $plan->PLAN_INSR = $request->isInsurance ? 1:0 ;
        $plan->PLAN_EMPL = $request->isEmployed ? 1:0 ;
        $plan->PLAN_YEAR = $request->years;

        $plan->save();
        return redirect("admin/manage/calculator");
    }

    function editPlan(Request $request){
        $request->validate([
            "downpayment"   => "required|exists:downpayments,id",
            "bank"          => "required|exists:banks,id",
            "interest"      => "required|numeric",
            "years"         => "required|numeric",
            "id"         => "required|exists:plans,id",
        ]);

        $plan = Plan::findOrFail($request->id);
        $plan->PLAN_BANK_ID = $request->bank;
        $plan->PLAN_DOWN_ID = $request->downpayment;
        $plan->PLAN_INTR = $request->interest;
        $plan->PLAN_INSR = $request->isInsurance ? 1:0 ;
        $plan->PLAN_EMPL = $request->isEmployed ? 1:0 ;
        $plan->PLAN_YEAR = $request->years;

        $plan->save();
        return redirect("admin/manage/calculator");
    }

    function deletePlan($id){
        $plan = Plan::findOrFail($id);
        $plan->delete();
        return redirect('admin/manage/calculator');
    }
    ///banks functions
    function addBank(Request $request)
    {

        $request->validate([
            "name" => "required|unique:banks,BANK_NAME",
            "expenses" => "required"
        ]);

        $bank = new Bank();
        $bank->BANK_NAME = $request->name;
        $bank->BANK_EXPN = $request->expenses;
        $bank->save();
        return $bank->id;
    }
    function editBank(Request $request)
    {

        $request->validate([
            "id"   => "required",
        ]);

        $bank = Bank::findOrFail($request->id);

        $request->validate([
            "id"   => "required",
            "name" => ["required", Rule::unique('banks', "BANK_NAME")->ignore($bank->BANK_NAME, "BANK_NAME"),],
            "expenses" => "required"
        ]);

        $bank->BANK_NAME = $request->name;
        $bank->BANK_EXPN = $request->expenses;
        $bank->save();
        return $bank->id;
    }

    function deleteBank(Request $request){
        $request->validate([
            "id"   => "required",
        ]);

        $bank = Bank::findOrFail($request->id);
        $bank->deleteAll();
        return "1";

    }

    ////insurance functions
    function addInsurance(Request $request)
    {

        $request->validate([
            "name" => "required|unique:insurances,INSR_NAME",
            "rate" => "required"
        ]);

        $insurance = new Insurance();
        $insurance->INSR_NAME = $request->name;
        $insurance->INSR_VLUE = $request->rate;
        $insurance->save();
        return $insurance->id;
    }
    function editInsurance(Request $request)
    {

        $request->validate([
            "id"   => "required",
        ]);

        $insurance = Insurance::findOrFail($request->id);

        $request->validate([
            "id"   => "required",
            "name" => ["required", Rule::unique('insurances', "INSR_NAME")->ignore($insurance->INSR_NAME, "INSR_NAME"),],
            "rate" => "required"
        ]);

        $insurance->INSR_NAME = $request->name;
        $insurance->INSR_VLUE = $request->rate;
        $insurance->save();
        return $insurance->id;
    }

    function deleteInsurance(Request $request){
        $request->validate([
            "id"   => "required",
        ]);

        $insurance = Insurance::findOrFail($request->id);
        $insurance->delete();
        return "1";

    }

    ////////data function
    private static function getCalculatorData()
    {
        $data['banks']          = Bank::all();
        $data['insurances']     = Insurance::all();
        $data['downpayments']   = Downpayment::all();
        $data['items']          = Plan::with("bank", "downpayment")->get();

        $data['title'] = "Available Brands";
        $data['subTitle'] = "Check all Available Loan Plans";
        $data['cols'] = ['%', 'Years', 'Bank', 'Interest', 'Insurance', 'Employed', 'Edit', 'Delete'];
        $data['atts'] = [
            ['foreign' => ['rel' => 'downpayment', 'att' => 'DOWN_VLUE']],
            'PLAN_YEAR',
            ['foreign' => ['rel' => 'bank', 'att' => 'BANK_NAME']],
            'PLAN_INTR',
            [
                'state' => [
                    "att"   =>  "PLAN_INSR",
                    "states" => [
                        "1" => "True",
                        "0" => "False",
                    ],
                    "classes" => [
                        "1" => "label-success",
                        "0" => "label-danger",
                    ],
                    "text" => [
                        "1" => "Required",
                        "0" => "Not required",
                    ],
                ]
            ],
            [
                'state' => [
                    "att"   =>  "PLAN_EMPL",
                    "states" => [
                        "1" => "True",
                        "0" => "False",
                    ],
                    "classes" => [
                        "1" => "label-success",
                        "0" => "label-danger",
                    ],
                    "text" => [
                        "1" => "Employed",
                        "0" => "Self-employed",
                    ],
                ]
            ],
            ['editJS' => ['func' => 'editPlan', 'att' => 'id']],
            ['del' => ['url' => 'admin/delete/plan/', 'att' => 'id', 'msg' => 'delete the plan']],
            ['hidden' => ["id" => 'planYear', "valueAtt" =>"PLAN_YEAR"]],
            ['hidden' => ["id" => 'planInterest', "valueAtt" =>"PLAN_INTR"]],
            ['hidden' => ["id" => 'planInsurance', "valueAtt" =>"PLAN_INSR"]],
            ['hidden' => ["id" => 'planEmployed', "valueAtt" =>"PLAN_EMPL"]],
            ['hidden' => ["id" => 'planBank', "valueAtt" =>"PLAN_BANK_ID"]],
            ['hidden' => ["id" => 'planDown', "valueAtt" =>"PLAN_DOWN_ID"]],
        ];

        $data['addBankURL'] = url('admin/add/bank');
        $data['editBankURL'] = url('admin/edit/bank');
        $data['delBankURL'] = url('admin/delete/bank');
        $data['addInsuranceURL'] = url('admin/add/insurance');
        $data['editInsuranceURL'] = url('admin/edit/insurance');
        $data['delInsuranceURL'] = url('admin/delete/insurance');
        $data['addPlanURL'] = url('admin/add/plan');
        $data['editPlanURL'] = url('admin/edit/plan');
        $data['delPlanURL'] = url('admin/delete/plan');

        return $data;
    }
}
