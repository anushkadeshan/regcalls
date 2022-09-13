<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function setLangItems(Request $request){

        $request->validate([
            'lang_key' => ['required'],
            'english' => ['required'],
            'portuguese' => ['required'],
        ]);
        // Read File English
        $jsonStringEn = file_get_contents(base_path('lang/en.json'));

        // Read File Brazil
        $jsonStringPt = file_get_contents(base_path('lang/pt.json'));

        $dataEn = json_decode($jsonStringEn, true);
        $dataPt = json_decode($jsonStringPt, true);

        // Update Key
        $dataEn[$request->lang_key] = $request->english;
        $dataPt[$request->lang_key] = $request->portuguese;

        // Write File
        $newJsonStringEn = json_encode($dataEn, JSON_PRETTY_PRINT);
        $newJsonStringPt = json_encode($dataPt, JSON_PRETTY_PRINT);

        file_put_contents(base_path('lang/en.json'), stripslashes($newJsonStringEn));
        file_put_contents(base_path('lang/pt.json'), stripslashes($newJsonStringPt));

        redirect()->back()->with([
            'message' => 'Translation Addded Successfully',
            'type' => 'success'
        ]);

    }
}
