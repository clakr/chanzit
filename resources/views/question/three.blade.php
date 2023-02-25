@extends('layout.app')

@section('title', '- Question #3')

@section('content')
  <main class="min-h-screen flex flex-col gap-4 p-8 bg-slate-200">
    <form class="w-full flex flex-col gap-4" action={{ route('questions.three.post') }} method="POST">
      @csrf
      <div class="flex flex-col gap-2">
        <label class="px-2 font-medium" for="question">Question #3</label>
        <input class="form-input" id="question" name="question" type="text">
      </div>
      <button class="bg-slate-400 p-2 rounded font-medium text-sm">Submit</button>
    </form>

    @isset($result)
      <p>
        <b>Result: </b>
        {{ $result }}
      </p>
    @endisset
    @isset($conversion)
      <p>
        <b>Conversion: </b>
        {{ $conversion }} USD
      </p>
    @endisset
  </main>
@endsection
