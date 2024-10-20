<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    <div style="border: 3px solid black;">
        <h2>edit a post</h2>
        <form action="/edit-post/{{$post -> id}}" method="POST">
            @csrf
            @method('PUT')
            <table>
                <tr>
                    <td>job title</td>
                    <td><input name="job_title" type="text" value="{{$post->job_title}}"></td>
                </tr>
                <tr>
                    <td>job description</td>
                    <td><textarea name="full_description" type="text">{{$post->full_description}}</textarea></td>
                </tr>
                <tr>
                    <td>company name</td>
                    <td><input name="company_name" type="text" value="{{$post->company->company_name}}"></td>
                    <td>location</td>
                    <td><input name="location" type="text" value="{{$post->location}}"></td>
                    <td>wage</td>
                    <td><input name="wage" type="text" value="{{$post->wage}}"></td>
                    <td>working hours</td>
                    <td><input name="working_hrs" type="text" value="{{$post->working_hrs}}"></td>
                </tr>
                <tr>
                    <td>contact name</td>
                    <td><input name="contact_name" type="text" value="{{$post->company->contact_name}}"></td>
                    <td>contact email</td>
                    <td><input name="contact_email" type="email" value="{{$post->company->contact_email}}"></td>
                </tr>
            </table>
            <button>save the update</button>
        </form>
    </div>
</body>
</html>
