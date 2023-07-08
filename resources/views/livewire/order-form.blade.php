<div class="container">
    <h2 class="mb-4 mt-3">Замовлення</h2>
    <h3>Виберіть спосіб оплати:</h3>
    @error('paymentMethod')
    <div class="alert alert-danger" role="alert">
        {{ $message }}
    </div>
    @enderror
    <div class="mb-3">
        <input class="form-check-input" type="radio" id="payment_method_cash" wire:model="paymentMethod" value="cash">
        <label class="form-check-label" for="payment_method_cash">Готівкою при отриманні</label>
    </div>

    <div class="mb-3">
        <input class="form-check-input" type="radio" id="payment_method_card" wire:model="paymentMethod" value="card">
        <label class="form-check-label" for="payment_method_card">Оплата карткою</label>
    </div>
    <h3>Виберіть пункт прийому та місто:</h3>
    @error('city')
    <div class="alert alert-danger" role="alert">
        {{ $message }}
    </div>
    @enderror
    @error('werehouse')
    <div class="alert alert-danger" role="alert">
        {{ $message }}
    </div>
    @enderror
    <livewire:nova-poshta/>
    <button class="btn btn-primary" wire:click="submitOrder">Оформити замовлення</button>
</div>
