<tr>
    <td>
        {{ $basketProduct->id }}
    </td>
    <td>
        <a href="{{ route('products.show', $basketProduct->product) }}">
            <h4>{{ $basketProduct->product->name }}</h4>
        </a>
    </td>
    <td><strong>{{ $basketProduct->sum }}</strong></td>
    <td>{{ $basketProduct->quantity }}</td>
    <td>
        <button  type="button" class="btn btn-default" wire:click="increment">+</button>
        <button  type="button" class="btn btn-default" wire:click="decrement">-</button>
        <button type="button" class="btn btn-default" wire:click="remove">
            <i class="bi bi-trash3"></i>
        </button>
    </td>
</tr>
