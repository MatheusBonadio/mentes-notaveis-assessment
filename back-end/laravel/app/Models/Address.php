<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @OA\Schema(
 *     schema="Address",
 *     title="Address",
 *     description="Address model",
 *     @OA\Property(
 *         property="id",
 *         type="string",
 *         description="The unique identifier for the address"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="The name of the address"
 *     ),
 *     @OA\Property(
 *         property="street",
 *         type="string",
 *         description="The street of the address"
 *     ),
 *     @OA\Property(
 *         property="user_id",
 *         type="string",
 *         description="The ID of the user associated with the address"
 *     ),
 *     @OA\Property(
 *         property="city_id",
 *         type="string",
 *         description="The ID of the city associated with the address"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         description="The date and time the address was created"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         description="The date and time the address was last updated"
 *     )
 * )
 */
class Address extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids;

    protected $fillable = ['name', 'street', 'user_id', 'city_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
