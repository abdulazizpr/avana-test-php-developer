<?php

namespace Abdulazizpr\Controllers;

use Abdulazizpr\Helpers\ExcelHelper;

class HomeController
{
    /**
     * Index Page
     * 
     * @return void
    */
    public function index()
    {
        $files = [
            'Type_A.xlsx',
            'Type_B.xlsx',
            'Type_C.xls',
        ];

        foreach ($files as $file) {
            echo 'File: ' . $file . '</br>';
            
            $dir = PUBLICPATH . 'files/' . $file;
            
            $excel = (new ExcelHelper($dir));
            
            echo $excel->showErrorsTable();
        }
    }
}