<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(title="Mentes notáveis", version="1.0")
 * @OA\Tag(
 *   name="Authentication"
 * ),
 * @OA\Tag(
 *   name="User"
 * ),
 * @OA\Tag(
 *   name="Address"
 * ),
 * @OA\Tag(
 *   name="City"
 * ),
 * @OA\Tag(
 *   name="State"
 * ),
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
