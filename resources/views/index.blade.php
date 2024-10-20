<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Job broad</title>
</head>

<body>

    {{-- if users is logged in, show a log out button and a message that he or she is logged in, and display all posts --}}
    @auth
        <p>congrats you are logged in</p>
        <form action='/logout' method="POST">
            @csrf
            <button>logout</button>
        </form>
    
        {{-- if not logged in, show login and register session --}}
        @else
        {{-- login and register session --}}
            <div style="border: 3px solid black;">
                <h2>register</h2>
                <form action="/register" method = "POST">
                    @csrf 
                    <input name="name" type="text" placeholder="your name"/>
                    <input name="email" type="text" placeholder="email">
                    <input name="phone" type="text" placeholder="phone number">
                    <input name="password" type="password" placeholder="set up your pwd here">
                    <button>Register</button>
                </form>
            </div>

            <div style="border: 3px solid black;">
                <h2>Login</h2>
                <form action="/login" method = "POST">
                    @csrf 
                    <input name="loginemail" type="text" placeholder="email">
                    <input name="loginpassword" type="password" placeholder="put your pwd here">
                    <button>Login</button>
                </form>
            </div>

    @endauth

    {{-- display all jobs either way --}}
    <div style="border: 3px solid black;" class="read-more-container">
        <h2>All posts</h2>
        @foreach ($posts as $post)
        <div style="background-color: antiquewhite; padding: 10px; margin: 10px" class="container">
            <ul>
                <li><strong>Job title: </strong>{{$post["job_title"]}}</li>
                <li><strong>Short description: </strong>{{substr($post['full_description'], 0, 30) }}</li>
                <span class="mybox1" style="display: none;">
                    <li><strong>Description: </strong>{{$post["full_description"]}}</li> 
                    <li><strong>Wage: </strong>{{$post["wage"]}}</li>
                    <li><strong>Working Hours: </strong>{{$post["working_hrs"]}}</li>
                    <li><strong>Location: </strong>{{$post["location"]}}</li>
                    <li><strong>Company: </strong>{{$post ->company->company_name}}</li>
                </span>
            </ul>
            <button onclick="changeLearnMore(this)" class="learn-more-btn" >Learn more</button>
            <a href="/apply/{{ $post->id }}">
                <button>Apply</button>
            </a> 
        </div>
        
        @endforeach
    </div>

    <script>
        // passed by THIS
        function changeLearnMore(button) {
            const mycontainer = button.closest('.container');
            const mycontent = mycontainer.querySelector(".mybox1");

            if (mycontent.style.display === 'none'
                || mycontent.style.display === '') {
                mycontent.style.display = 'block';
                button.textContent = 'Learn Less';
            } else {
                mycontent.style.display = 'none';
                button.textContent = 'Learn More';
            }
        }
    </script>
</body>
</html>