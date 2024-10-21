<?php

namespace App\Http\Controllers;

use App\Filter\CompanyScreener;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Models\Exchange;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ScreenerController extends Controller {
    public function screen(Request $request): AnonymousResourceCollection|JsonResponse {
        if (!$request->exists('exchanges') || !$request->exists('screens')) {
            abort(403, "Missing query parameters");
        }
        $exchangeIds = collect(explode(',', trim($request->query('exchanges'), '[]')))->map(function(string $exchange) {
            return Exchange::where('symbol', 'like', '%' . $exchange . '%')->first()?->id;
        })->filter(fn($id) => $id !== null)->toArray();

        $companyIds = Company::whereIn('exchange_id', $exchangeIds)->pluck('id')->toArray();

        $screener = new CompanyScreener($companyIds);

        $screenParams = explode('|', $request->query('screens'));

        foreach ($screenParams as $params) {
            $screenSettings = [];
            $paramsArray = explode(',', trim($params, '[]'));
            foreach ($paramsArray as $value) {
                $exploded = explode('=', $value);
                $screenSettings[$exploded[0]] = $exploded[1];
            }
            $screener->filter($screenSettings['limit'], $screenSettings['function'] ?? 'sum', $screenSettings['operator'], $screenSettings['value'], [
                'guid' => $screenSettings['guid'],
                'type' => $screenSettings['type'],
            ]);
        }
        $companies = Company::findMany($screener->getKeys());
        dd($companies);
        return CompanyResource::collection($screener->getKeys());
    }
}
