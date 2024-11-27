@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Persamaan Hotel & Ressort')
<img src="https://images2.imgbox.com/f3/74/iu1bEWcV_o.png" class="logo" alt="Persamaan Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
