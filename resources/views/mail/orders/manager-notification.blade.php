<x-mail::message>
# Новый заказ оформлен

Заказ ID: {{ $data->id }}
Сумма заказа: {{ $data->total_amount }}

перейти по ссылке в админ панель:

<x-mail::button :url="url('/admin/resource/order-resource/detail-page?resourceItem=' . $data->id)">
    Перейти
</x-mail::button>

Спасибо за покупку,<br>
{{ config('app.name') }}
</x-mail::message>
