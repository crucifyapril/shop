<x-mail::message>
# Новый подзаказ

по товару: {{ $data->product_id }}
Пользователь: {{ $data->email }}
Комментарий: {{ $data->description }}

перейти по ссылке в админ панель:

<x-mail::button :url="url('/admin/resource/order-resource/detail-page?resourceItem=' . $data->product_id)">
    Перейти
</x-mail::button>

Спасибо за покупку,<br>
{{ config('app.name') }}
</x-mail::message>
