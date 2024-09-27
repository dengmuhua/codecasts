<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

class BaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function success(string $message = '', $data = null): array
    {
        return [
            'code' => 0,
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ];
    }
}
