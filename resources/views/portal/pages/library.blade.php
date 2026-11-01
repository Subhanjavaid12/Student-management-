@extends('layouts.app', ['title' => 'University Library'])

@section('content')
  @include('pages.show', ['page' => [
    'title' => 'University Library',
    'eyebrow' => 'Campus resources',
    'intro' => 'A welcoming place to study, read, and explore new ideas.',
    'image' => 'https://images.unsplash.com/photo-1507842217343-583bb7270b66?auto=format&fit=crop&w=1400&q=85',
    'image_alt' => 'Tall shelves filled with books in a library',
    'sections' => [
      ['title' => 'Study spaces', 'body' => 'Find a quiet corner for focused work or meet classmates for a group study session.'],
      ['title' => 'Explore and learn', 'body' => 'Use the library to build research skills, discover new subjects, and make reading part of your university life.'],
      ['title' => 'Need assistance?', 'body' => 'The University Help Desk page has guidance for getting support with portal and campus services.'],
    ],
  ]])
@endsection
