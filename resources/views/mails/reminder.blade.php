<html>
<body>

<h1>Hello, dear {{ $user->firstname }}</h1>

@if ($type == 'new')
    <p> We would like to tell about our new  book  </p>
    <div>
        {{$book->title}}{{$book->author}}
    </div>
@endif

@if ($type == 'return')
    <p> We would like to remind to return the book  </p>
    <div>
        {{$book->title}}{{$book->author}}
    </div>
@endif

<p> Best, regards, your eLibrary </p>

</body>
</html>