@extends('layout.app')

@section('title', '- Question #2')

@section('content')
  <main>
    <h2>Description: </h2>
    <p>
      You work in the scrum team and last sprint you did a few bug fixes at a website. They've been tested
      and approved, so you've now been asked to put the fixes on production.
    </p>
    <ul class="list-disc m-4">
      <li>
        The version now on production is '1.3.8'.
      </li>
      <li>
        Your work is in the git branch 'release/1.3.x'.
      </li>
      <li>
        You'll find out that someone from another team has also done commits in this branch, but
        they're not allowed to live yet.
      </li>
    </ul>
    <p>
      Describe what you would do to get your code right on production.
    </p>
    <h2 class="mt-4">Answer: </h2>
    <ul class="list-disc flex flex-col gap-2">
      <li>
        First, I would switch to a different branch to isolate what I need to change & not affect my other co-developers
        commits in the current branch.
      </li>
      <li>
        Then, using <code>git log</code> or with GitHub or GitLab, I will track my commits' hashes which I will be needing
        since I will revert the other team's commits using <code>git revert</code>.
      </li>
      <li>
        After that, I will rerun the tests to make sure that all commits that I reverted is not affecting the fixes that I
        made initially.
      </li>
      <li>
        Finally, I will open a pull request to merge my fixes to the Production branch. Stating in the pull request, the
        description and solution to the fix, also noting that I reverted all the other commits the other team made to
        avoid shipping unapproved code in the Production branch.
      </li>
    </ul>
  </main>
@endsection
