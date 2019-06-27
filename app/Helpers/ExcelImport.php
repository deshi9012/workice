<?php
namespace App\Helpers;

use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ExcelImport
{
    /**
     * The filename of the uploaded file.
     *
     * @var string
     */
    protected static $headersLoaded = false;
    /**
     * @var int 
     */
    protected static $rowCollection = [];
    /**
     * The headers for the imported rows.
     *
     * @var array
     */
    protected static $headers = [];
    /**
     * @param mixed $file
     *
     * @return \Illuminate\Support\Collection
     */
    public static function load($file)
    {
        $filename = $file instanceof \SplFileInfo ? $file->getPathname() : $file;
        $reader = IOFactory::createReaderForFile($filename);
        $reader->setLoadAllSheets();
        $spreadsheet = $reader->load($file);
        $sheetCollection = Collection::make($spreadsheet->getAllSheets());
        return $sheetCollection->map(
            function ($sheet) {
                return Collection::make($sheet->toArray(null, true, true, true))
                ->map(
                    function ($rowCollection) {
                        return static::mapRowNamesToData($rowCollection);
                    }
                )->filter();
            }
        );
    }
    /**
     * Map a row to its coresponding name.
     *
     * @param array $row
     *
     * @return mixed
     */
    protected static function mapRowNamesToData($row)
    {
        // unset the previous mapped row
        static::$rowCollection = [];
        // Che if we are loading the first row
        // if true then format it to a valid property name
        if (!static::$headersLoaded) {
            foreach ($row as $column => $header) {
                static::$headers[$column] = snake_case(strtolower($header));
            }
            // Set the column headers as loaded
            static::$headersLoaded = true;
            return false;
        } else {
            foreach ($row as $item => $value) {
                static::$rowCollection[static::$headers[$item]] = $value;
            }
        }
        // return new Row(static::$rowCollection);
        return static::$rowCollection;
    }

    public function getData($path)
    {
        $data = $this->load(
            $path, function ($reader) {
            }
        )->first()->toArray();
        return array_values($data);
    }
}
