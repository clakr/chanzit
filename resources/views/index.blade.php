@extends('layout.app')

@section('content')
  <main>
    <ul>
      <li>
        <a href={{ route('questions.three') }}>Question #3</a>
      </li>
    </ul>
  </main>
@endsection
