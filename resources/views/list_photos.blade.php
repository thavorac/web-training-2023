<html>
    <body>
        <table style="border: 1px solid black">
            <tr style="border: 1px solid black">
                <th>No.</th>
                <th>Photo</th>
                <th>Actions</th>
            </tr>
            @foreach ($photos as $photo)
                <tr>
                    <td>{{$photo->id}}</td>
                    <td>
                        <img width="50px" src="{{str_replace('public', 'storage', $photo->photo)}}" />
                    </td>
                    <td>
                        <a href="/form-upload/{{$photo->id}}">edit</a>
                    </td>
                </tr>
            @endforeach

        </table>
    </body>
</html>
