@extends('layouts.app', ['title' => 'Academic Records'])

@section('content')
  @include('pages.show', ['page' => [
    'title' => 'Academic Records',
    'eyebrow' => 'Your learning journey',
    'intro' => 'Keep your student profile and course information close at hand.',
    'image' => 'https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?auto=format&fit=crop&w=1400&q=85',
    'image_alt' => 'Books and notes arranged for study',
    'sections' => [
      ['title' => 'Student profile', 'body' => 'Review your personal details and the information associated with your student account.'],
      ['title' => 'Course information', 'body' => 'Your assigned subjects and academic information are available after you sign in.'],
      ['title' => 'Secure access', 'body' => 'Academic records are private. Sign in to view your own student information.'],
    ],
  ]])
@endsection
