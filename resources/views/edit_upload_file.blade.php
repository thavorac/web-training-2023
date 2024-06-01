<html>
    <head>
        <title>Edit Files</title>
    </head>
    <body>
        Edit: You are editing photo ID: {{ $photo->photo }}

        <form method="post" action="/update_upload/{{$photo->id}}" enctype="multipart/form-data">
            @csrf
            <input type="file" name="photo" />
            <button>Submit</button>
        </form>
    </body>
</html>
