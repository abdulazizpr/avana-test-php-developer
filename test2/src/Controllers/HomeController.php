<?php

namespace App\Controllers;

use App\Helpers\ExcelHelper;

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
            'Type_B.xlsx'
        ];

        foreach ($files as $file) {
            echo 'File: ' . $file . '</br>';
            
            $dir = PUBLICPATH . 'files/' . $file;
            $excel= (new ExcelHelper($dir));

            echo $this->showTables($excel->validations()) . '</br>';
        }
    }

    /**
     * Show Tables
     * 
     * @return string
    */
    protected function showTables($data) {
        $table = '<table border=1>';
        $table .= '<thead>';
            $table .= '<tr>';
                $table .= "<th>Row</th>";
                $table .= "<th>Error</th>";
            $table .= '</tr>';
        $table .= '</thead>';

        $table .= '<tbody>';
        foreach ($data as $row => $message) {
            $table .= '<tr>';
                $table .= "<td>" . ($row+1) . "</td>";
                $table .= "<td>" . $message . "</td>";
            $table .= '</tr>';
        }
        $table .= '</tbody>';

        $table .= '</table>';

        return $table;
    }
}