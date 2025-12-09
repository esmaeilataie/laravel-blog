@props(['messages'])

@if ($messages)
    <div style="margin: -10px 0 5px 0; color: red; text-align: right; font-size: 12px; padding-right: 5px">
        <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 space-y-1']) }}>
            @foreach ((array) $messages as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
@endif
