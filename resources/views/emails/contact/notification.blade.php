@component('mail::message')
# New contact enquiry

You have received a new contact enquiry from **{{ $data['name'] }}**.

**Email:** {{ $data['email'] }}

@if(!empty($data['subject']))
**Subject:** {{ $data['subject'] }}

@endif
**Message:**

{{ $data['message'] }}

@endcomponent
