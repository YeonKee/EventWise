@php
    $selectedLayout = session('selected_layout', 'layoutFront'); // Get the selected layout from the session
@endphp

@extends($selectedLayout)