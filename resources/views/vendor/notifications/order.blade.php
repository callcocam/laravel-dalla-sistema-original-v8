@component('mail::message')
    # Order Shipped

    Your order has been shipped!

    @component('mail::button', ['url' => route('admin.orders.show', $id)])
        View Order
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
