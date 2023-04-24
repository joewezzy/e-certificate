<x-mail::message>
{{-- # Introduction --}}

Hello {{ $mailData['name'] }},

Congratulations on attending the Oxygen Africa Health Forum {{date('Y')}}  🎉🎉!

To celebrate this achievement, we would like to present you with a Certificate of attendance. This certificate awarded to you by the Oxygen Africa Health Forum Team recognizes your efforts in the 2023 forum.

Download your certificate here - {{$mailData['link']}}.



Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
