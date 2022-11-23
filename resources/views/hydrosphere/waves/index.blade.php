<!DOCTYPE html>
<html>
<head>
    <title>Shark App</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('waves') }}">shark Alert</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ route('hydrosphere.waves.index') }}">View All Waves</a></li>
        <li><a href="{{ route('hydrosphere.waves.create') }}">Create a Waves</a>
    </ul>
</nav>

<h1>All the waves</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Description</td>
            <td>Language</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
    @foreach($waves as $key => $value)
        <tr>
            <td>{{ $value->id }}</td>
            <td>{{ $value->name }}</td>
            <td>{{ $value->description }}</td>
            <td>{{ $value->language_id }}</td>

            <!-- we will also add show, edit, and delete buttons -->
            <td>

                <!-- delete the shark (uses the destroy method DESTROY /waves/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->

                <!-- show the shark (uses the show method found at GET /waves/{id} -->
                <a class="btn btn-small btn-success" href="{{ URL::to('hydrosphere/waves/' . $value->id) }}">Show this shark</a>

                <!-- edit this shark (uses the edit method found at GET /waves/{id}/edit -->
                <a class="btn btn-small btn-info" href="{{ URL::to('hydrosphere/waves/' . $value->id . '/edit') }}">Edit this shark</a>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>

</div>
</body>
</html>