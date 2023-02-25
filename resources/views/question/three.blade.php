@extends('layout.app')

@section('title', '- Question #3')

@section('content')
  <main class="flex flex-col gap-8">
    <div>

      <h2>Description: </h2>
      <p class="mb-4">
        For this assignment, we assume that you already have PHP knowledge. You are allowed to use the
        internet for ideas and input, but are expected to do the coding yourself.
      </p>
      <i>
        Please note: we only entertain original code written by you, and will ask you to explain every step (we
        are aware of all circulating existing scripts).
      </i>
      <ul class="list-[lower-alpha] m-4 flex flex-col gap-2">
        <li>
          Create a word to number conversion and vice versa. The idea is for example that if you input
          “390”, then the output of the script would be: “three hundred and ninety” and if you input
          “three hundred and ninety” it should result in: “390”.
        </li>
        <li>
          The result of the above should be converted to USD by using live data from for any API that
          provides PHP to USD conversion. Example: <a
            href="https://free.currencyconverterapi.com/">https://free.currencyconverterapi.com/</a> or any other
          API.
        </li>
        <li>
          <b>BONUS QUESTION: </b>
          show some of your higher skills and add some basic error correcting (as
          fuzzy word recognition and spaceless input), eg. “Onehundred and ten”, should be read as “One hundred and ten”
          and
          converted accordingly.
        </li>
      </ul>
      <p>
        For this application, you can use plain PHP or Laravel. In both cases, make use of the MVC structure and
        make sure you follow standards. The frontend can be in plain HTML with simple CSS.
      </p>
    </div>
    <form class="space-y-2" action="{{ route('questions.three') }}" method="POST">
      @csrf
      <input class="rounded w-full" id="input" name="input" type="text" required autofocus>
      <button class="bg-slate-400 w-full py-2 rounded">Submit</button>
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
    </form>
  </main>
@endsection
