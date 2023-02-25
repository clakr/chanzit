@extends('layout.app')

@section('content')
  <main class="min-h-screen flex flex-col justify-center items-center gap-4">
    <div>
      <h1 class="font-bold text-4xl">Clark Kenneth C. Tolosa</h1>
      <span class="font-medium text-xl">Repository:
        <a href="https://github.com/clakr/chanzit" target="_blank">https://github.com/clakr/chanzit</a>
      </span>
    </div>
    <ul class="flex flex-col gap-2 font-medium">
      <li>
        <a href={{ route('questions.one') }}>Question #1</a>
      </li>
      <li>
        <a href={{ route('questions.two') }}>Question #2</a>
      </li>
      <li>
        <a href={{ route('questions.three') }}>Question #3</a>
      </li>
    </ul>
  </main>
@endsection
