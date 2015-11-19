<?php

namespace App\Http\Controllers\Admin;

use App\Dvarchar;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    /**
     * Export all data from Dvarchar to Excel document
     */
    public function exportAll()
    {
        Excel::create('Laravel Excel', function($excel) {

            $excel->sheet('Collections', function($sheet) {
                $registros = Dvarchar::all();
                $sheet->fromArray($registros);
            });

        })->export('xls');
    }

}
