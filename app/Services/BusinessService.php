<?php

namespace App\Services;

use App\Models\Business;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\BusinessRequest;
use App\Http\Resources\BusinessResource;

class BusinessService
{
    /**
     * Fetch a business list from storgae
     */
    public function fetchBusiness(Business $business): BusinessResource
    {
        $business->increment('views');

        return new BusinessResource($business);
    }

    /**
     * Add new business listing to storgae
     */
    public function addBusiness(BusinessRequest $request): BusinessResource
    {
        $businessData = $request->except('categories');
        $categoryIds = collect($request->categories)->pluck('id')->all();

        DB::beginTransaction();

        try {
            $business = Business::create($businessData);

            $business->categories()->attach($categoryIds);

            DB::commit();
        } catch (\Throwable $ex) {

            Log::info($ex->getMessage());

            DB::rollback();

            return response()->json([
                'message' => 'Cannot save business details. Try again.'
            ], 409);
        }

        return new BusinessResource($business);
    }

    /**
     * Update a business listing in storgae
     */
    public function updateBusiness(
        BusinessRequest $request,
        Business $business
    ): BusinessResource {

        $businessData = $request->except('categories');
        $categoryIds = collect($request->categories)->pluck('id')->all();

        DB::beginTransaction();

        try {
            $business->update($businessData);

            $business->categories()->syncWithoutDetaching($categoryIds);

            DB::commit();
        } catch (\Throwable $ex) {

            Log::info($ex->getMessage());

            DB::rollback();

            return response()->json([
                'message' => 'Cannot update business details. Try again.'
            ], 409);
        }

        return new BusinessResource($business);
    }

    /**
     * Delete a business listing from storage
     */
    public function deleteBusiness(Business $business): JsonResponse
    {
        $business->categories()->detach();

        $business->delete();

        return response()->json([
            'message' => 'Business deleted successfully'
        ], 200);
    }

    /**
     * Toggle a business listing active/inactive
     */
    public function toggleBusinessActivation(Business $business): JsonResponse
    {
        $business->toggleActive();

        return response()->json([
            'message' => $business->active == 1 ? 'Business listing has been activated' : 'Business listing has been deactivated'
        ], 200);
    }
}
