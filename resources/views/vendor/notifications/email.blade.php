@component('mail::message')
# Reset Password Request

Kami menerima permintaan untuk mereset password Anda. Klik tombol di bawah untuk melanjutkan:

@isset($actionText)
@component('mail::button', ['url' => $actionUrl, 'color' => 'success'])
Reset Password
@endcomponent
@endisset

Jika Anda tidak meminta penggantian password, abaikan email ini.

Terima kasih,<br>
Persamaan Hotel & Resort
@endcomponent
