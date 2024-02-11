@component('mail::layout')
{{-- Header --}}
@slot('header')
@include('email.admin.includes.header')
@endslot
{{-- Body --}}
<!-- Email Body -->
{{-- Greeting --}}
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# @lang('Whoops!')
@else
# Hello {{ $user->first_name.'  '.$user->last_name }},
@endif
@endif
<p>Please use below security code to sign in.</p>
<strong>{{ $securityCode }}</strong>

<br />
@if (! empty($salutation))
<p>{{ $salutation }}</p>
@endif
{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset
{{-- Footer --}}
@slot('footer')
@include('email.admin.includes.footer')
@endslot
@endcomponent
