<?php

namespace App\Http\Controllers;

use App\Models\Doc;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\User;
use PhpOffice\PhpWord\Shared\Html;
use PhpOffice\PhpWord\TemplateProcessor;

class DocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        date_default_timezone_set("Asia/Taipei");
        Carbon::setLocale('zh-TW');
        return View::make('docs.index')
            ->with('docs',$user->docs->sortByDesc('created_at'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('docs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //dd($request->all());
        if(Auth::check()){
            Auth::user()->docs()->create($request->all());
        }

        return redirect()->to(route('docs.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doc  $doc
     * @return \Illuminate\Http\Response
     */
    public function show(Doc $doc)
    {
        $templateProcessor = new TemplateProcessor(resource_path('asset/template1.docx'));


        $receiver = User::find($doc->receiver)->name ?? "";
         $templateProcessor->setValue('speed', $doc->speed);
        //$templateProcessor->setValue('explanation', Html::addHtml($doc->explanation));
        $templateProcessor->setValue('confidentiality', $doc->confidentiality);
        $templateProcessor->setValue('date', $doc->date);
        $templateProcessor->setValue('subject', $doc->subject);
         $templateProcessor->setValue('sender', $receiver);
        $templateProcessor->setValue('receiver', $receiver);

        /*TODO:
        把 parse html地方弄好
        https://github.com/PHPOffice/PHPWord/issues/902#issuecomment-564561115
        注意細節
        */


        //$xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($templateProcessor, 'Word2007');
        try {
            $templateProcessor->saveAs(storage_path($doc->id.'.docx'));
        } catch (Exception $e) {
        }

        return response()->download(storage_path($doc->id.'.docx'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doc  $doc
     * @return \Illuminate\Http\Response
     */
    public function edit(Doc $doc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doc  $doc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doc $doc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doc  $doc
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doc $doc)
    {
        //
    }
}
