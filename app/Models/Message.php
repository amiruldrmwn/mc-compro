<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * A message sent from the website's contact form.
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $phone
 * @property string $body
 * @property string|null $ip
 * @property Carbon|null $read_at
 * @property Carbon|null $created_at
 */
#[Fillable(['name', 'email', 'phone', 'body', 'ip', 'read_at'])]
class Message extends Model
{
    protected function casts(): array
    {
        return ['read_at' => 'datetime'];
    }
}
