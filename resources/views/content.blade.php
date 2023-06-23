<!DOCTYPE html>
<html>

<head>
    <title>Content Page</title>
</head>

<body>
    <h1>Content Page</h1>
    <table>
        <thead>
            <tr>
                <th> Title </th>
                <th> Episode Count </th>
                <th> Length </th>
                <th> Year </th>
            </tr>
        </thead>
        <tbody>
            @foreach($content as $content)
            <tr>
                <td> {{ $content->title }} </td>
                <td> {{ $content->episode_cnt }} </td>
                <td> {{ $content->length }} </td>
                <td> {{ $content->year }} </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>