<select name="{{ $name }}"
    {{ $attributes->merge(['class' => 'w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500']) }}>
    <option value="" disabled {{ is_null($selected) ? 'selected' : '' }}>Pilih opsi...</option>
    @foreach ($options as $key => $value)
        <option value="{{ $key }}" {{ $key == $selected ? 'selected' : '' }}>
            {{ $value }}
        </option>
    @endforeach
</select>
