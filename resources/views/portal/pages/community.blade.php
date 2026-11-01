@extends('layouts.app', ['title' => 'Student Community'])

@section('content')
  @include('pages.show', ['page' => [
    'title' => 'Student Community',
    'eyebrow' => 'Life at university',
    'intro' => 'Meet people, share ideas, and make the most of your time on campus.',
    'image' => 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&w=1400&q=85',
    'image_alt' => 'A group of friends spending time together outdoors',
    'sections' => [
      ['title' => 'Get involved', 'body' => 'Connect with classmates and take part in academic, cultural, and campus activities.'],
      ['title' => 'Learn together', 'body' => 'Build supportive study groups and celebrate the different perspectives students bring.'],
      ['title' => 'Stay connected', 'body' => 'Check university announcements and speak with your department about upcoming activities.'],
    ],
  ]])
@endsection
