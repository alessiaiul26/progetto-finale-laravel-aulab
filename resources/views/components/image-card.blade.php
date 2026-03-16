@props(['src', 'alt' => ''])

<div class="image-container">
    <img 
        src="{{ $src }}" 
        alt="{{ $alt }}"
        class="object-cover w-full h-full rounded"
        style="aspect-ratio: 1/1; object-fit: cover;"
        loading="lazy"
    >
</div>

<style>
    .image-container {
        width: 300px;
        height: 300px;
        overflow: hidden;
        position: relative;
        border-radius: 0.375rem;
    }
</style>
