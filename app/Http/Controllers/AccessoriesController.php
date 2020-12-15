<?php

namespace App\Http\Controllers;

use App\Models\Accessories;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AccessoriesController extends Controller
{
    protected $data;
    protected $homeURL = 'admin/accessories/show';

    private function initDataArr()
    {
        $this->data['items'] = Accessories::all();
        $this->data['title'] = "Available Types";
        $this->data['subTitle'] = "Manage all Available Accessories/Options such as: Power Steering - ABS - Airbags";
        $this->data['cols'] = ['Name', 'Arabic', 'Edit'];
        $this->data['atts'] = [
            'ACCS_NAME',
            'ACCS_ARBC_NAME',
            ['edit' => ['url' => 'admin/accessories/edit/', 'att' => 'id']],
        ];
        $this->data['homeURL'] = $this->homeURL;
    }

    public function home()
    {
        $this->initDataArr();
        $this->data['formTitle'] = "Add Type";
        $this->data['formURL'] = "admin/accessories/insert";
        $this->data['isCancel'] = false;
        return view('settings.accessories', $this->data);
    }

    public function edit($id)
    {
        $this->initDataArr();
        $this->data['accessory'] = Accessories::findOrFail($id);
        $this->data['formTitle'] = "Edit Type ( " . $this->data['accessory']->ACCS_NAME . " )";
        $this->data['formURL'] = "admin/accessories/update";
        $this->data['isCancel'] = false;
        return view('settings.accessories', $this->data);
    }

    public function insert(Request $request)
    {

        $request->validate([
            "name"      => "required|unique:accessories,ACCS_NAME",
        ]);

        $accessory = new Accessories();
        $accessory->ACCS_NAME = $request->accessory;
        $accessory->ACCS_ARBC_NAME = $request->arbcName;

        $accessory->save();
        return redirect($this->homeURL);
    }

    public function update(Request $request)
    {
        $request->validate([
            "id" => "required",
        ]);
        $accessory = Accessories::findOrFail($request->id);

        $request->validate([
            "name" => ["required",  Rule::unique('accessories', "ACCS_NAME")->ignore($accessory->ACCS_NAME, "ACCS_NAME"),],
            "id"        => "required",
        ]);

        $accessory->ACCS_NAME = $request->accessory;
        $accessory->ACCS_ARBC_NAME = $request->arbcName;
        $accessory->save();

        return redirect($this->homeURL);
    }

}
