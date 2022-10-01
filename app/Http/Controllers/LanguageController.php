<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
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
            'message_trnaslation' => 'Translation Added Successfully',
            'type_trnaslation' => 'success'
        ]);

    }


    public function setLangEnTranslations(Request $request){
        $jsonStringEn = file_get_contents(base_path('lang/en.json'));
        $dataEn = json_decode($jsonStringEn, true);

        // Update Key
        $dataEn[$request->lang_key] = $request->lang_value;

        // Write File
        $newJsonStringEn = json_encode($dataEn, JSON_PRETTY_PRINT);
        file_put_contents(base_path('lang/en.json'), stripslashes($newJsonStringEn));

        redirect()->back()->with([
            'message_trnaslation' => 'Translation Updated Successfully',
            'type_trnaslation' => 'success'
        ]);

    }

    public function setLangPtTranslations(Request $request){
        // Read File Brazil
        $jsonStringPt = file_get_contents(base_path('lang/pt.json'));

        $dataPt = json_decode($jsonStringPt, true);

        // Update Key
        $dataPt[$request->lang_key] = $request->lang_value;

        // Write File
        $newJsonStringPt = json_encode($dataPt, JSON_PRETTY_PRINT);

        file_put_contents(base_path('lang/pt.json'), stripslashes($newJsonStringPt));

        redirect()->back()->with([
            'message_trnaslation' => 'Translation Updated Successfully',
            'type_trnaslation' => 'success'
        ]);

    }
}
