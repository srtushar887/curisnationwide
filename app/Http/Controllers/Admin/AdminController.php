<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\all_document;
use App\Models\document_data;
use App\Models\pdf_file_data;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Rap2hpoutre\FastExcel\FastExcel;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function index()
    {
        $practice = all_document::distinct()->select('practice')->get();
        $count = all_document::count();
        return view('admin.index',compact('practice','count'));
    }

    public function upload_document(Request $request)
    {
        $users = (new FastExcel())->import($request->doc_file, function ($line) {
            return document_data::updateOrCreate([
                'document_url' => $line['document_url'],
            ],[
                'practice' => $line['practice'],
                'patient_name' => $line['patient_name'],
                'account_number' => $line['account_number'],
                'dos' => Carbon::parse($line['dos'])->format('m/d/Y'),
                'document_name' => $line['document_name'],
                'type' => $line['type'],
                'status' => $line['status'],
            ]);
        });

        return back();


    }


    public function upload_file(Request $request)
    {
        return view('admin.pdffile');
    }

    public function upload_file_save(Request $request)
    {
        if($request->hasFile('file')) {
//        $path = $request->file('file')->store('pdffiles','s3');

            $filename1 = $request->file('file')->getClientOriginalName();

            $a = Storage::disk('s3')->put($filename1,fopen($request->file('file'),'r+'),'public');
            Storage::disk('s3')->setVisibility($filename1,'public');

        }

    }


    public function not_exists_file()
    {



        return view('admin.notexists');
    }

    public function not_exists_file_get(Request $request)
    {
        $type = $request->type_name;

        $data = DB::table('all_documents')
            ->where('type',$type)
            ->orderBy('dos','desc');


        return DataTables::of($data)
            ->addColumn('action',function ($data){
            })
            ->editColumn('action',function ($data){
                $s3url = "https://nationwidebackup.s3.ap-south-1.amazonaws.com/".$data->document_name.'.pdf';
                $path = $data->document_name.'.pdf';
                $file = Storage::disk('s3')->exists($path);
                if ($file) {
                    return '<a href="'.$s3url.'"  target="_blank">  <i class="far fa-file-pdf" style="font-size: 20px;padding-right: 5px;"></i></a>';
                }else{
                    return $path;
                }

            })
            ->editColumn('dos',function ($data){
                return Carbon::parse($data->dos)->format('m/d/Y');
            })
            ->toJson();
    }






}
