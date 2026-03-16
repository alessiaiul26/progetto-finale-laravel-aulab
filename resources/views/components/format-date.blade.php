@props(['date'])

@php
    if ($date) {
        if (is_string($date)) {
            try {
                $formattedDate = \Carbon\Carbon::parse($date)->format('d/m/Y H:i');
            } catch (\Exception $e) {
                $formattedDate = $date;
            }
        } else {
            $formattedDate = $date->format('d/m/Y H:i');
        }
    } else {
        $formattedDate = 'N/A';
    }
@endphp

{{ $formattedDate }}
