@extends('layouts.app', ['title' => 'Knowledge and Discovery'])

@section('content')
  @include('pages.show', ['page' => [
    'title' => 'Knowledge and Discovery',
    'eyebrow' => 'Learning beyond the classroom',
    'intro' => 'Follow your curiosity through research, creativity, and lifelong learning.',
    'image' => 'https://images.unsplash.com/photo-1532094349884-543bc11b234d?auto=format&fit=crop&w=1400&q=85',
    'image_alt' => 'Scientific research equipment in a laboratory',
    'sections' => [
      ['title' => 'Ask better questions', 'body' => 'Start with a subject that interests you and explore it through reading, discussion, and practical work.'],
      ['title' => 'Share what you learn', 'body' => 'Exchange ideas with peers and faculty to turn new knowledge into useful perspectives.'],
      ['title' => 'Keep exploring', 'body' => 'Your academic profile helps you keep track of the courses and subjects that shape your journey.'],
    ],
  ]])
@endsection
