<?php

namespace App\OpenApi\Schemas;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Notebook",
 *     type="object",
 *     required={"name", "phone", "email"},
 *     @OA\Property(property="name", type="string", example="John Doe"),
 *     @OA\Property(property="phone", type="string", example="1234567890"),
 *     @OA\Property(property="email", type="string", example="john.doe@example.com"),
 *     @OA\Property(property="company", type="string", nullable=true, example="Example Inc."),
 *     @OA\Property(property="birth_date", type="string", format="date", nullable=true, example="1990-01-01"),
 *     @OA\Property(property="photo", type="string", nullable=true, example="photos/image.jpg"),
 * )
 */
class Notebook
{
}
