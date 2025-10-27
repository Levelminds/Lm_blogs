@component('mail::message')
# New campus ambassador application

A new campus ambassador application has been submitted.

**Name:** {{ $data['fullname'] }}

**Email:** {{ $data['email'] }}

@if(!empty($data['phone']))
**Phone / WhatsApp:** {{ $data['phone'] }}

@endif
**College / University:** {{ $data['college'] }}

@if(!empty($data['linkedin']))
**LinkedIn:** {{ $data['linkedin'] }}

@endif
@if(!empty($data['plan']))
**Plan / Experience:**

{{ $data['plan'] }}

@endif
@endcomponent
