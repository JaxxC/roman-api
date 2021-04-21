<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConvertNumber;
use App\Http\Resources\ConvertedNumber;
use App\Http\Resources\ConvertStatsCollection;
use App\Models\ConvertStat;
use App\Services\ConvertService;

class ConvertController extends Controller
{
    /**
     * Convert number to roman.
     */
    public function convert(ConvertNumber $request)
    {
        $convertService = new ConvertService($request->number);
        $result = $convertService->process();

        return new ConvertedNumber($result);
    }

    /**
     * Lists all the recently converted integers
     */
    public function recent()
    {
        $recent = ConvertStat::orderBy('last_convert_at', 'desc')->get();

        return new ConvertStatsCollection($recent);
    }

    /**
     * Lists the top 10 converted integers.
     */
    public function top()
    {
        $recent = ConvertStat::orderBy('convert_count', 'desc')->take(10)->get();

        return new ConvertStatsCollection($recent);
    }

}
