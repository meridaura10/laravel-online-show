<div class="mb-5">
   <div class="container">
       <hr>
       <table class="table">
           <thead>
           <tr>
               <th scope="col">id</th>
               <th scope="col">title</th>
               <th scope="col">total</th>
               <th scope="col">count</th>
               <th scope='col'>actions</th>
           </tr>
           </thead>
           @foreach (\App\Helpers\basket()->getItems() as $basketProduct)
               @livewire('basket-product', compact('basketProduct'), key($basketProduct->id))
           @endforeach
           <tr>
               <td colspan="5">Basket Total:  {{ \App\Helpers\basket()->sum() }}</td>
           </tr>
       </table>
       <div>
           <a href="{{route('orders.create')}}">   <button type="button" class="btn btn-success">оформити замовлення</button></a>
       </div>
   </div>
</div>

