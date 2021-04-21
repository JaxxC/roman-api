<?php

namespace App\Services;

use App\Models\{ConvertHistory, ConvertStat};
use Carbon\Carbon;

class ConvertService
{
    protected $number;
    protected $converted;
    protected $requestTime;

    private $convertTable = [1, 'I', 4, 'IV', 5, 'V', 9, 'IX', 10, 'X', 40, 'XL', 50, 'L', 90, 'XC', 100, 'C', 400, 'CD', 500, 'D', 900, 'CM', 1000, 'M'];

    public function __construct($number)
    {
        $this->number = $number;
    }

    public function process()
    {
        $this->convertToRoman();

        return $this->saveStats();
    }

    protected function convertToRoman()
    {
        $this->converted = '';
        $this->requestTime = Carbon::now();
        $processingNumber = $this->number;
        do {
            $roman = array_pop($this->convertTable);
            $arabic = array_pop($this->convertTable);
            while($processingNumber >= $arabic){
                $this->converted .= $roman;
                $processingNumber = $processingNumber - $arabic;
            }
        } while ($processingNumber > 0);
    }

    protected function saveStats()
    {
        $stat = ConvertStat::firstOrNew(['number' => $this->number, 'roman' => $this->converted]);
        $stat->last_convert_at = $this->requestTime;
        $stat->convert_count++;
        $stat->save();

        return $stat;
    }
}
