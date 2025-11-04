<select 
    {!! $attributes->merge([
        'class' => 'border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 p-2'
    ]) !!}
>
    {{ $slot }}
</select>
