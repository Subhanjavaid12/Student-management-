@extends('layouts.app', ['title' => 'University Help Desk'])

@section('content')
  @include('pages.show', ['page' => [
    'title' => 'University Help Desk',
    'eyebrow' => 'Support and guidance',
    'intro' => 'Find a starting point when you need help using the student portal.',
    'image' => 'https://www.csudh.edu/Assets/csudh-sites/dh-home/images/student-services-08-11-2022.jpg',
    'image_alt' => 'A student receiving assistance at a campus service desk',
    'sections' => [
      ['title' => 'Account access', 'body' => 'Use the Forgot Password link on the sign-in page if you cannot access your account.'],
      ['title' => 'Profile details', 'body' => 'Sign in and open your profile to review or update your personal information.'],
      ['title' => 'Academic questions', 'body' => 'For course or department questions, contact your department through the university’s usual support channels.'],
    ],
  ]])
@endsection
