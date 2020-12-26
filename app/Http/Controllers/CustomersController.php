<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CustomersController extends Controller
{
    protected $data;
    protected $homeURL = 'admin/customers/show';

    private function initDataArr()
    {
        $this->data['items'] = Customer::all();
        $this->data['title'] = "Available Customers";
        $this->data['subTitle'] = "Manage all Available Customers that should appear on this website such as Peugeot";
        $this->data['cols'] = ['Logo', 'Name', 'Title', 'Qoute', 'Active', 'Edit', 'Delete'];
        $this->data['atts'] = [
            ['assetImg' => ['att' => 'CUST_IMGE']],
            'CUST_NAME',
            'CUST_TTLE',
            ['comment' => ['att' => 'CUST_TEXT']],
            [
                'toggle' => [
                    "att"   =>  "CUST_ACTV",
                    "url"   =>  "admin/customers/toggle/",
                    "states" => [
                        "1" => "True",
                        "0" => "False",
                    ],
                    "actions" => [
                        "1" => "hide the customer card",
                        "0" => "show the customer card",
                    ],
                    "classes" => [
                        "1" => "label-success",
                        "0" => "label-danger",
                    ],
                ]
            ],
            ['edit' => ['url' => 'admin/customers/edit/', 'att' => 'id']],
            ['del' => ['url' => 'admin/customers/delete/', 'att' => 'id', 'msg' => 'delete the customer card']],
        ];
        $this->data['homeURL'] = $this->homeURL;
    }

    public function home()
    {
        $this->initDataArr();
        $this->data['formTitle'] = "Add Customer";
        $this->data['formURL'] = "admin/customers/insert";
        $this->data['isCancel'] = false;
        return view('settings.customers', $this->data);
    }

    public function edit($id)
    {
        $this->initDataArr();
        $this->data['customer'] = Customer::findOrFail($id);
        $this->data['formTitle'] = "Edit Customer ( " . $this->data['customer']->CUST_NAME . " )";
        $this->data['formURL'] = "admin/customers/update";
        $this->data['isCancel'] = true;
        return view('settings.customers', $this->data);
    }

    public function insert(Request $request)
    {

        $request->validate([
            "name"      => "required|unique:customers,CUST_NAME",
            "title"      => "required_if:isActive,on",
            "text"       => "required_if:isActive,on",
            "image"      => "required_if:isActive,on",
        ]);

        $customer = new Customer();
        $customer->CUST_NAME = $request->name;
        $customer->CUST_TTLE = $request->title;
        $customer->CUST_TEXT = $request->text;
        if ($request->hasFile('image')) {
            $customer->CUST_IMGE = $request->image->store('images/customers/' . $customer->CUST_NAME, 'public');
        }
        $customer->CUST_ACTV = $request->isActive == 'on' ? 1 : 0;

        $customer->save();
        return redirect($this->homeURL);
    }

    public function update(Request $request)
    {
        $request->validate([
            "id" => "required",
        ]);
        $customer = Customer::findOrFail($request->id);

        $request->validate([
            "name"       => ["required",  Rule::unique('customers', "CUST_NAME")->ignore($customer->CUST_NAME, "CUST_NAME"),],
            "title"      => "required_if:isActive,on",
            "text"       => "required_if:isActive,on",
            "image"      => "required_if:isActive,on",

        ]);

        $customer->CUST_NAME = $request->name;
        $customer->CUST_TTLE = $request->title;
        $customer->CUST_TEXT = $request->text;
        if ($request->hasFile('image')) {
            $this->deleteOldCustomerPhoto($customer->CUST_IMGE);
            $customer->CUST_IMGE = $request->image->store('images/customers/' . $customer->CUST_NAME, 'public');
        }
        $customer->CUST_ACTV = $request->isActive == 'on' ? 1 : 0;
        $customer->save();

        return redirect($this->homeURL);
    }

    public function toggle($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->toggle();
        return back();
    }

    public function delete($id){
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return back();
    }

    private function deleteOldCustomerPhoto($customerFilePath)
    {
        if (isset($customerFilePath) && $customerFilePath != '') {
            try {
                unlink(public_path('storage/' . $customerFilePath));
            } catch (Exception $e) {
            }
        }
    }
}
