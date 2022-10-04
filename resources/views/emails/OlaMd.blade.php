@component('mail::message')
# Olá T91 MD

Lorem ipsum **dolor** sit amet consectetur adipisicing elit. Saepe impedit labore, vel rem consectetur vitae, aut iusto dolor modi nisi illum, dolore eveniet fugiat perspiciatis cupiditate voluptatem unde earum vero.

## titulo 2

### titulo 3

- item
- item 2

@component('mail::button', ['url' => 'http://uol.com.br'])
    OUL
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
