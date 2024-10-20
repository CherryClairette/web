<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>apply</title>
</head>
<body>
    
    {{-- if user is logged in, autofill the form for he or she or they --}}
    @if(Auth::check()) 
        <div style="border: 3px solid black;">
            <h2>Apply for this post</h2>
            <form action="/apply/{{$post->id}}" method="POST">
                
                @csrf
                <table>
                    <tr>
                        <td>Your name</td>
                        <td><input name="name" type="text" value="{{$user->name}}"></td>
                        <td>Your email</td>
                        <td><input name="email" type="email" value="{{$user->email}}"></td>
                        <td>Your phone number</td>
                        <td><input name="phone" type="text" value="{{$user->phone}}"></td>
                    </tr>
                    <tr>
                        <td>Your message</td>
                        <td><textarea name="message_sent" type="text" placeholder="type your message here pls"></textarea></td>
                    </tr>
                </table>
                <button type="submit">Submit the application</button>
            </form>
        </div>
    @else
        <div style="border: 3px solid black;">
            <h2>Apply for this post</h2>
            <form action="/apply/{{$post ->id}}" method="POST">
                @csrf
                <table>
                    <tr>
                        <td>Your name</td>
                        <td><input name="name" type="text" placeholder="name pls"></td>
                        <td>Your email</td>
                        <td><input name="email" type="email" placeholder="email pls"></td>
                        <td>Your phone number</td>
                        <td><input name="phone" type="text" placeholder="phone number pls"></td>
                    </tr>
                    <tr>
                        <td>Your message</td>
                        <td><textarea name="message_sent" type="text" placeholder="type your message here pls"></textarea></td>
                    </tr>
                </table>
                <button>Submit the application</button>
            </form>
        </div>
    @endif

</body>
</html>
