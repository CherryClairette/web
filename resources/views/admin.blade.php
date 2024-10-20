<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
</head>
<body>
    <p>congrats you are logged in as admin</p>
    <form action='/logout' method="POST">
        @csrf
        <button>logout</button>
    </form> 

    <div style="border: 3px solid black;">
        <h2>create a new job post</h2>
        <form action="/create-post" method="POST">
            @csrf
            <table>
                <tr>
                    <td>job title</td>
                    <td><input name="job_title" type="text" placeholder="job title"></td>
                </tr>
                <tr>
                    <td>job description</td>
                    <td><textarea name="full_description" type="text" placeholder="more information about this position"></textarea></td>
                </tr>
                <tr>
                    <td>company name</td>
                    <td><input name="company_name" type="text" placeholder="company name"></td>
                    <td>location</td>
                    <td><input name="location" type="text" placeholder="location"></td>
                    <td>wage</td>
                    <td><input name="wage" type="text" placeholder="wage"></td>
                    <td>working hours</td>
                    <td><input name="working_hrs" type="text" placeholder="working hours"></td>
                </tr>
                <tr>
                    <td>contact name</td>
                    <td><input name="contact_name" type="text" placeholder="contact person"></td>
                    <td>contact email</td>
                    <td><input name="contact_email" type="email" placeholder="contact email"></td>
                </tr>
            </table>
            <button>save this job post</button>
        </form>
    </div>

    {{-- display all posts --}}
    <div style="border: 3px solid black;">
        <h2>All posts</h2>
        @foreach ($posts as $post)
        <div style="background-color: antiquewhite; padding: 10px; margin: 10px">
            <ul>
                <li><strong>Job title: </strong>{{$post["job_title"]}}</li>
                <li><strong>Description: </strong>{{$post["full_description"]}}</li> 
                <li><strong>Wage: </strong>{{$post["wage"]}}</li>
                <li><strong>Working Hours: </strong>{{$post["working_hrs"]}}</li>
                <li><strong>Location: </strong>{{$post["location"]}}</li>
                <li><strong>Company: </strong>{{$post ->company->company_name}}</li>
            </ul>
            {{-- an edit link --}}
            <p><a href="/edit-post/{{$post->id}}">Edit</a></p>
            {{-- a delete button --}}
            <form action="/delete-post/{{$post->id}}" method="POST">
                @csrf
                @method('DELETE')
                <button>Delete</button>
            </form>
        </div>
        @endforeach
    </div>
</body>
</html>