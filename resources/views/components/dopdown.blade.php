<!-- resources/views/components/dropdown.blade.php -->
<div {{ $attributes->merge(['class' => 'dropdown']) }}>
    {{ $trigger }}
    {{ $content }}
</div>
