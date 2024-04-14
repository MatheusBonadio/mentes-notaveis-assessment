<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @OA\Schema(
 *     description="City model",
 *     title="City",
 *     @OA\Property(
 *         property="id",
 *         type="string",
 *         description="The unique identifier for the city"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="The name of the city"
 *     ),
 *     @OA\Property(
 *         property="state_id",
 *         type="string",
 *         description="The ID of the state that the city belongs to"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         description="The date and time the city was created"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         description="The date and time the city was last updated"
 *     )
 * )
 */
class City extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids;

    protected $fillable = ['name', 'state_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
