<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PartnersController extends Controller
{
    protected $data;
    protected $homeURL = 'admin/partners/show';

    private function initDataArr()
    {
        $this->data['items'] = Partner::all();
        $this->data['title'] = "Available Partners";
        $this->data['subTitle'] = "Manage all Available Partners - should appear on the logos footer on the home page";
        $this->data['cols'] = ['Image', 'Name', 'Url', 'Edit', 'Delete'];
        $this->data['atts'] = [
            ['assetImg' => ['att' => 'PRTR_IMGE']],
            'PRTR_NAME',
            ['remoteURL' => ['att' => 'PRTR_URL']],
            ['edit' => ['url' => 'admin/partners/edit/', 'att' => 'id']],
            ['del' => ['url' => 'admin/partners/delete/', 'att' => 'id', 'msg' => 'delete the partner from the footer bar']],
        ];
        $this->data['homeURL'] = $this->homeURL;
    }

    public function home()
    {
        $this->initDataArr();
        $this->data['formTitle'] = "Add Partner";
        $this->data['formURL'] = "admin/partners/insert";
        $this->data['isCancel'] = false;
        return view('settings.partners', $this->data);
    }

    public function edit($id)
    {
        $this->initDataArr();
        $this->data['partner'] = Partner::findOrFail($id);
        $this->data['formTitle'] = "Edit Partner ( " . $this->data['partner']->PRTR_NAME . " )";
        $this->data['formURL'] = "admin/partners/update";
        $this->data['isCancel'] = true;
        return view('settings.partners', $this->data);
    }

    public function insert(Request $request)
    {

        $request->validate([
            "name"      => "required|unique:partners,PRTR_NAME",
            "image"      => "required",
            "website"      => "required",
        ]);

        $partner = new Partner();
        $partner->PRTR_NAME = $request->name;
        $partner->PRTR_URL = $request->website;
        if ($request->hasFile('image')) {
            $partner->PRTR_IMGE = $request->image->store('images/partners/' . $partner->PRTR_NAME, 'public');
        }

        $partner->save();
        return redirect($this->homeURL);
    }

    public function update(Request $request)
    {
        $request->validate([
            "id" => "required",
        ]);
        $partner = Partner::findOrFail($request->id);
        
        $request->validate([
            "name" => ["required",  Rule::unique('partners', "PRTR_NAME")->ignore($partner->PRTR_NAME, "PRTR_NAME"),],
            "website"      => "required",
        ]);

        $partner->PRTR_NAME = $request->name;
        $partner->PRTR_URL = $request->website;
        if ($request->hasFile('image')) {
            $this->deleteOldPartnerPhoto($partner->PRTR_IMGE);
            $partner->PRTR_IMGE = $request->image->store('images/partners/' . $partner->PRTR_NAME, 'public');
        }
        $partner->save();

        return redirect($this->homeURL);
    }

    public function delete($id)
    {
        $partner = Partner::findOrFail($id);
        $partner->delete();
    
        return back();
    }

    private function deleteOldPartnerPhoto($partnerFilePath)
    {
        if (isset($partnerFilePath) && $partnerFilePath != '') {
            try {
                unlink(public_path('storage/' . $partnerFilePath));
            } catch (Exception $e) {
            }
        }
    }
}
