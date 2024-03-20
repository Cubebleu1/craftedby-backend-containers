<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @OA\Schema(
 *     schema="Order",
 *     type="object",
 *     required={"user_id", "total_without_tax", "tax_amount", "total_tax_included", "payment_status"},
 *
 *     @OA\Property(
 *         property="order_number",
 *         type="string",
 *         description="Unique order number"
 *     ),
 *
 *     @OA\Property(
 *         property="user_id",
 *         type="string",
 *         format="uuid",
 *         description="UUID of the user associated with the order"
 *     ),
 *
 *     @OA\Property(
 *         property="total_without_tax",
 *         type="number",
 *         format="float",
 *         description="Total order amount without tax"
 *     ),
 *
 *     @OA\Property(
 *         property="tax_amount",
 *         type="number",
 *         format="float",
 *         description="Amount of tax applied to the order"
 *     ),
 *
 *     @OA\Property(
 *         property="total_tax_included",
 *         type="number",
 *         format="float",
 *         description="Total order amount including tax"
 *     ),
 *
 *     @OA\Property(
 *         property="payment_status",
 *         type="boolean",
 *         description="Status of the order's payment (true for paid, false for unpaid)"
 *     )
 * )
 */
class Order extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'orders';
    protected $fillable = [
        'order_number',
        'user_id',
        'total_without_tax',
        'tax_amount',
        'total_tax_included',
        'payment_status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

}
