<?php

namespace app\modules\core\components;

use Yii;
use yii\base\Component;

/**
 * Class Export
 *
 * @author Stableflow
 */
class Export extends Component {

    const FILE_TYPE_CSV = 'csv';

    protected $tmp;
    protected $extension;

    public function export($data, $properties, $fileType = 'csv') {
        $this->extension = $fileType;
        switch ($fileType) {
            case static::FILE_TYPE_CSV:
                $this->toCSV($data, $properties);
                break;
        }
        return $this;
    }

    /**
     * Export data to csv
     * 
     * @param array|object $data
     * @param array $properties 
     * @return string
     */
    protected function toCSV($data, $properties) {
        ob_start();
        $df = fopen("php://output", 'w');
        fputcsv($df, $properties);
        foreach ($data as $row) {
            $item = [];
            foreach ($properties as $property) {
                if (is_object($row)) {
                    $parts = explode(':', $property);
                    if (count($parts) > 1) {
                        if (isset($row->{$parts[0]}) && is_array($row->{$parts[0]})) {
                            $rowData = [];
                            foreach ($row->{$parts[0]} as $relRow) {
                                if (isset($relRow->{$parts[1]})) {
                                    $rowData[] = $relRow->{$parts[1]};
                                }
                            }
                            $item[$property] = implode(',', $rowData);
                        }elseif(isset($row->{$parts[0]}) && is_object($row->{$parts[0]}) && isset($row->{$parts[0]}->{$parts[1]})){
                            $item[$property] = $row->{$parts[0]}->{$parts[1]};
                        } else {
                            $item[$property] = null;
                        }
                    } else {
                        if (isset($row->{$property})) {
                            $item[$property] = $row->{$property};
                        } else {
                            $item[$property] = null;
                        }
                    }
                } else {
                    if (isset($row[$property])) {
                        $item[$property] = $row[$property];
                    } else {
                        $item[$property] = null;
                    }
                }
            }
            fputcsv($df, $item);
        }
        fclose($df);

        $this->tmp = ob_get_clean();
    }

    /**
     * Download file
     * 
     * @param string $filename
     */
    public function download($filename) {
        $now = gmdate("D, d M Y H:i:s");
        header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
        header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
        header("Last-Modified: {$now} GMT");

        // force download  
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");

        // disposition / encoding on response body
        header("Content-Disposition: attachment;filename=$filename.{$this->extension}");
        header("Content-Transfer-Encoding: binary");
        
        echo $this->tmp;
    }

    /**
     * Save file to local dir
     * 
     * @param string $filename
     * @param string $filePath
     * @return string
     */
    public function saveAs($filename, $filePath) {
        
    }

}
