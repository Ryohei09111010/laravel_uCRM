<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Services\AnalysisService;
use App\Services\DecileService;
use App\Services\RFMService;

class AnalysisController extends Controller
{
    public function index(Request $request)
    {

        $subQuery = Order::betweenDate($request->startDate, $request->endDate);
        // if($request->type === 'perDay') {
        //     // ������������ѿ��˳�Ǽ���뤿�� list() ��Ȥ�
        //     list($data, $labels, $totals) = AnalysisService::perDay($subQuery);
        // }

        // if($request->type === 'perDay') {
        //     // ������������ѿ��˳�Ǽ���뤿�� list() ��Ȥ�
        //     list($data, $labels, $totals) = AnalysisService::perDay($subQuery);
        // }

        // if($request->type === 'perDay') {
        //     // ������������ѿ��˳�Ǽ���뤿�� list() ��Ȥ�
        //     list($data, $labels, $totals) = AnalysisService::perDay($subQuery);
        // }

        switch ($request->type){
            // ����
            case 'perDay':
                list($data, $labels, $totals) = AnalysisService::perDay($subQuery);
                break;
            // ����
            case 'perMonth':
                list($data, $labels, $totals) = AnalysisService::perMonth($subQuery);
                break;
            // ǯ��
            case 'perYear':
                list($data, $labels, $totals) = AnalysisService::perYear($subQuery);
                break;
            case 'decile':
                list($data, $labels, $totals) = DecileService::decile($subQuery);
                break;
            case 'rfm':
                list($data, $totals, $eachCount) = RFMService::rfm($subQuery, $request->rfmPrms);
                // Ajax�̿��ʤΤ�Json���ֵѤ���ɬ�פ�����
                // json���ֵѤ���ݤ�Inertia����ѤǤ��ʤ��Τ�response����Ѥ���
                return response()->json([
                    'data' => $data,
                    'type' => $request->type,
                    'eachCount' => $eachCount,
                    'totals' => $totals
                ], Response::HTTP_OK);
                break;

        }

        return response()->json([
            'data' => $data,
            'type' => $request->type,
            'labels' => $labels,
            'totals' => $totals
        ], Response::HTTP_OK);
    }
}
