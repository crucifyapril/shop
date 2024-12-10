<x-mail::message>
# Ваш заказ #{{ $data->id }} оформлен

Данный заказ можно посмотреть во вкладке "Мои заказы".

    либо перейти по ссылке ниже:

<x-mail::button :url="route('order.show', $data['id'])">
    Перейти
</x-mail::button>

Спасибо за покупку,<br>
{{ config('app.name') }}
</x-mail::message>
