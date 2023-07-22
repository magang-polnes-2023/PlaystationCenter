<!-- resources/views/components/x-dropdown.blade.php -->
<div>
    <div {{ $attributes->merge(['class' => 'dropdown']) }}>
        {{ $trigger }}
    </div>

    {{ $content }}
</div>
