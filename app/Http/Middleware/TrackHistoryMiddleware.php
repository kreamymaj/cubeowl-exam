<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\History;
use Illuminate\Support\Facades\Auth;

class TrackHistoryMiddleware
{
    
    public function handle($request, Closure $next, ...$activity)
    {
        $response = $next($request);
    
        $user = Auth::user();
        $route = $request->route()->getName();
        $defaultActivity = null;
    
        if (count($activity) > 0) {
            $defaultActivity = $activity[0];
        }
        if ($request->isMethod('post') || $request->isMethod('delete')) {
            if ($defaultActivity === null) {
            // Use default activity descriptions based on route names
                if ($route === 'create_products') {
                    $defaultActivity = 'Added a product ' . $request->input('productName');
                } elseif ($route === 'update_products') {
                    $defaultActivity = 'Edited a product ' . $request->input('productName');
                } elseif ($route === 'delete_products') {
                    $defaultActivity = 'Deleted a product ' . $request->input('productID');
                }   elseif ($route === 'restore_product') {
                    $defaultActivity = 'Restored a Product ' . $request->input('productName');
                }   elseif ($route === 'destroy_product') {
                    $defaultActivity = 'Permanently Deleted a product ' . $request->input('productName');

                } elseif ($route === 'register') {
                    $defaultActivity = 'Added a user ' . $request->input('firstname');
                }  elseif ($route === 'update_user') {
                    $defaultActivity = 'Edited a user ' . $request->input('firstname');
                }  elseif ($route === 'delete_user') {
                    $defaultActivity = 'Deleted a user ' . $request->input('firstname');
                }   elseif ($route === 'restore_user') {
                    $defaultActivity = 'Restored a system user record ' . $request->input('firstname');
                }   elseif ($route === 'destroy_user') {
                    $defaultActivity = 'Permanently Deleted a system user record ' . $request->input('firstname');
                
                }   elseif ($route === 'create_stores') {
                    $defaultActivity = 'Added a store ' . $request->input('storeName');
                }   elseif ($route === 'update_stores') {
                    $defaultActivity = 'Edited a store ' . $request->input('storeName');
                }   elseif ($route === 'delete_stores') {
                    $defaultActivity = 'Deleted a store ' . $request->input('storeName');
                }   elseif ($route === 'restore_stores') {
                    $defaultActivity = 'Restored a Store ' . $request->input('storeName');
                }   elseif ($route === 'destroy_stores') {
                    $defaultActivity = 'Permanently Deleted a Store ' . $request->input('storeName');
                }
            }
        }
        if ($defaultActivity !== null) {
            $history = new History();
            $history->user()->associate($user);
            $history->activity = $defaultActivity;
            $history->save();
        }
    
        return $response;
    }
}
 