<html>
    <head>
        <title>Uploading Files</title>
    </head>
    <body>
        <form method="post" action="/upload" enctype="multipart/form-data">
            @csrf
            <input type="file" name="photo" />
            <button>Submit</button>
        </form>
    </body>
</html>
