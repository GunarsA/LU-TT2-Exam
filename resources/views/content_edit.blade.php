<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Content</title>
</head>

<body>
    <form method="POST" action={{ action([App\Http\Controllers\ContentController::class, 'update'], ['content' => $content]) }}>
        @csrf
        @method('PUT')

        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="{{old('title', $content->title)}}" required>

        <label for="content_type">Content Type</label>
        <select name="content_type" id="content_type">
            @foreach($types as $type)
            <option value="{{ $type->id }}" {{old('content_type', $content->type->id) == $type->id ? "selected" : ""}}>{{ $type->type }}</option>
            @endforeach
        </select>

        <label for="episode_cnt">Episode Count</label>
        <input type="number" name="episode_cnt" id="episode_cnt" value="{{old('episode_cnt', $content->episode_cnt)}}" required>

        <label for="length">Length</label>
        <input type="number" name="length" id="length" value="{{old('length', $content->length)}}" required>

        <label for="year">Year</label>
        <input type="number" name="year" id="year" value="{{old('year', $content->year)}}" required>
        <br>

        <label for="genre">Genre</label>
        <select name="genre[]" id="genre" multiple>
            @foreach($genres as $genre)
            <option value="{{ $genre->id }}">{{ $genre->genre }}</option>
            @endforeach
        </select>
        
        <label for="studio">Studio</label>
        <select name="studio[]" id="studio" multiple>
            @foreach($studios as $studio)
            <option value="{{ $studio->id }}">{{ $studio->studio }}</option>
            @endforeach
        </select>

        @foreach($positions as $position)
        <label for="{{ $position->position }}">{{ $position->position }}</label>
        <select name="{{ $position->position }}[]" id="{{ $position->position }}" multiple>
            @foreach($staff as $stafff)
            <option value="{{ $stafff->id }}">{{ $stafff->name }}</option>
            @endforeach
        </select>
        @endforeach

        <input type="submit" value="Submit">
    </form>

</body>

</html>