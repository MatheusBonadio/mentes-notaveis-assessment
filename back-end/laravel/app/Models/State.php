<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @OA\Schema(
 *     title="State",
 *     description="State model",
 *     @OA\Property(
 *         property="id",
 *         type="string",
 *         description="The unique identifier for the state"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="Name"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         description="The date and time the state was created"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         description="The date and time the state was last updated"
 *     )
 * )
 */
class State extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids;

    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
