<?php

namespace App\Helpers;

use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Xls;

class ExcelHelper
{
    /**
     * Define fileName
     * 
     * @var string $fileName
    */
    protected $fileName;

    /**
     * Define extensions
     * 
     * @var string $fileName
    */
    protected $extensions = ['xlsx', 'xls', 'csv'];

    /**
     * Define path info
     * 
     * @var string $fileName
    */
    protected $pathInfo = null;

    /**
     * Define header
     * 
     * @var string $fileName
    */
    protected $header = 0;

    /**
     * The constructor
     * 
     * @return void
    */
    public function __construct(string $file = '', int $header = 0)
    {
        $this->file = $file;
        $this->header = $header;

        if ($this->file && !empty($this->file)) {
            $this->pathInfo = \pathinfo($this->file);
        }

        if (!$this->checkFileExists()) {
            echo 'File does not exists' . \PHP_EOL;

            return;
        }

        if (!$this->checkFileExtension()) {
           echo 'File must be ' . \implode(', ', $this->extensions) . \PHP_EOL;

           return;
        }
    }

    /**
     * Check file is exists
     * 
     * @return bool
    */
    protected function checkFileExists()
    {
        return file_exists($this->file);
    }

    /**
     * Check file extension
     * 
     * @return bool
    */
    protected function checkFileExtension()
    {
        return $this->pathInfo && \in_array($this->pathInfo['extension'], $this->extensions);
    }

    /**
     * Get Reader
     * 
     * @return Csv|Xlsx|Xls|null
    */
    protected function getReader()
    {
        switch ($this->pathInfo['extension']) {
            case 'csv':
                return new Csv();
            case 'xlsx':
                return new Xlsx();
            case 'xls':
                return new Xls();
        }

        return null;
    }

    /**
     * Get Data
     * 
     * @return array
    */
    public function getData()
    {
        $reader = $this->getReader();

        if (!$reader && empty($reader)) {
            return [];
        }
        
        $spreadSheet = $reader->load($this->file);
        
        return $spreadSheet
            ->getActiveSheet()
            ->toArray();
    }

    /**
     * Check validation data
     * 
     * @return array
    */
    public function validations()
    {
        $errorDefinition = $this->validateHeaders();
        $data = array_slice($this->getData(), $this->header + 1, null, true);
        $error = [];

        foreach ($data as $key => $columns) {
            $messages = [];
            
            $countNull = 0;
            foreach ($columns as $columnKey => $value) {
                //For counter null on all column cell
                if (!$value && $value != 'null') {
                    $countNull++;
                }

                //check if value empty or null
                if (
                    (!$value && $value != 'null') && 
                    (
                        isset($errorDefinition[$columnKey]) && 
                        $errorDefinition[$columnKey]['validation'] === 'required'
                    )
                ) {
                    $messages[$columnKey] = 'Missing value in ' . $errorDefinition[$columnKey]['column'];
                }

                //check if value contains 
                if (
                    strpos($value, ' ') !== false && 
                    (
                        isset($errorDefinition[$columnKey]) && 
                        $errorDefinition[$columnKey]['validation'] === 'space'
                    )
                ) {
                    $messages[$columnKey] = $errorDefinition[$columnKey]['column'] . ' should not contain any space';
                }
            }

            //if any messages and columns cell null is any
            if (\count($messages) > 0 && $countNull != count($columns)) {
                $error[$key] = \implode(', ', $messages);
            }
        }

        return $error;
    }

    /**
     * Check validation headers
     * 
     * @return array
    */
    protected function validateHeaders()
    {
        $errorDefinition = [];
        $cell = $this->getData();
        $header = $cell[$this->header] ?? [];
        
        //check header for first character is # or last character is *
        foreach ($header as $key => $column) {
            $firstChar = $column[0];
            $lastChar = $column[strlen($column)-1];

            if ($firstChar === '#') {
                $errorDefinition[$key] = [
                    'validation' => 'space',
                    'column' => $column
                ];
            }

            if ($lastChar === '*') {
                $errorDefinition[$key] = [
                    'validation' => 'required',
                    'column' => $column
                ];
            }
        }

        return $errorDefinition;
    }
}