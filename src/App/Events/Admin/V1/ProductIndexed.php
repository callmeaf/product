<?php

namespace Callmeaf\Product\App\Events\Admin\V1;

use Callmeaf\Product\App\Models\Product;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProductIndexed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @param Collection<Product> $products
     * Create a new event instance.
     */
    public function __construct(Collection $products)
    {
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
