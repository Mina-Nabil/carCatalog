<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\SiteInfo;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    protected $homeURL = 'admin/manage/site';
    protected $updateURL = 'admin/update/site';
    protected $addFieldURL = 'admin/add/field';
    protected $deleteFieldURL = 'admin/delete/field/';
    protected $toggleSectionURL = 'admin/toggle/section/';
    protected $data;

    function home()
    {
        $this->data['siteSections'] = Section::all();
        foreach ($this->data['siteSections'] as $section) {
            $this->data['maindata'][$section->id] = SiteInfo::where('MAIN_SECT_ID', $section->id)->get();
        }
        $this->data['formTitle'] = 'Manage Home Page & Site data';
        $this->data['formURL'] = url($this->updateURL);
        $this->data['addFieldURL'] = url($this->addFieldURL);
        $this->data['deleteFieldURL'] = url($this->deleteFieldURL);
        $this->data['toggleSectionURL'] = url($this->toggleSectionURL);
        return view('meta.siteinfo', $this->data);
    }

    function deleteField(Request $request)
    {
        $request->validate([
            "id" => 'required|exists:maindata,id'
        ]);
        $siteInfoRow = SiteInfo::find($request->id);
        echo $siteInfoRow->delete();
    }

    function addNew(Request $request)
    {
        $siteInfoRow = SiteInfo::firstOrNew(['MAIN_ITEM' => $request->field, "MAIN_SECT_ID" => $request->section]);
        if (!$siteInfoRow->exists) {
            $siteInfoRow->MAIN_TYPE = $request->type;
            $siteInfoRow->MAIN_ITEM = $request->field;
            $siteInfoRow->MAIN_SECT_ID = $request->section;
            echo $siteInfoRow->save();
        } else {
            echo "-1";
        }
    }

    function toggle($id)
    {
        $section = Section::findOrFail($id);
        echo $section->toggle();
    }

    function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $siteInfoRow = SiteInfo::findOrFail($request->id);
        if($request->hasFile('content')){
            $siteInfoRow->MAIN_CNTN = $request->content->store('images/site/' . $request->id, 'public');
        } else {
            $siteInfoRow->MAIN_CNTN = $request->content ?? NULL;
        }

        echo $siteInfoRow->save();
    }

    function activateSection($id)
    {
        $section = Section::findOrFail($id);
        echo $section->activate();
    }
}
