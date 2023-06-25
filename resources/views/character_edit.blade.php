<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Character</title>
</head>

<body>
    <h1>Edit Character</h1>
    <form method="POST" action={{ action([App\Http\Controllers\CharacterController::class, 'update'], ['character' => $character]) }}>
        @csrf
        @method('PUT')
        
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="{{old('name', $character->name)}}" required>
    </form>
</body>

</html>