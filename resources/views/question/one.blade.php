@extends('layout.app')

@section('title', '- Question #1')

@section('content')
  <main>
    <h2>Description: </h2>
    <p>
      Rewrite the following function without using loops (for, while, foreach etc).
    </p>
    <pre>

      const parseFilterUrl = (url) => {
        const parts = url.split('|');
        const filters = [];

        for (let i = 0; i < parts.length; i++) {
          const part = parts[i];
          const split = part.split(':');
          const obj = {};
          obj[split[0]] = split[1].split(',');
          filters.push(obj);
        }

        return filters;
      }
      
      const filters = parseFilterUrl(
        'regions:the-north|people:hodor,the-hound|omg:true
      ');
      window.console.log({filters});
    </pre>
    <h2>
      Answer:
    </h2>
    <pre>

      const parseFilterUrl = (url) => {
        const parts = url.split("|")
      
        return parts.map((part) => {
          const [key, values] = part.split(":")
          return {
            [key]: values.split(","),
          }
        })
      }
      
      const filters = parseFilterUrl(
        "regions:the-north|people:hodor,the-hound|omg:true"
      )
      console.log(filters)
    </pre>
  </main>
@endsection
