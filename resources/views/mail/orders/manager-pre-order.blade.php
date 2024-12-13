<x-mail::message>
# Новый подзаказ
    @dd($data)
по товару: {{ $data->id }}
Пользователь: {{ $data->email }}
Комментарий: {{ $data->description }}

перейти по ссылке в админ панель:

<x-mail::button :url="url('/admin/resource/order-resource/detail-page?resourceItem=' . $data->id)">
    Перейти
</x-mail::button>

Спасибо за покупку,<br>
{{ config('app.name') }}
</x-mail::message>
