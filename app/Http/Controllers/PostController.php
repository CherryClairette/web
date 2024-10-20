<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Company;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function applyPost (Post $post, Request $request){
        if (Auth::check()) {
            $validatedData = $request->validate([
                // I dont need to validate these since they are already stored in my databse
                "message_sent" => "required"
            ]);
            $validatedData["message_sent"] = strip_tags($validatedData["message_sent"]);
            //store them in application table
            Application::create([
                "post_id" => $post->id,
                "user_id" => auth()->user()->id,
                "message_sent" => $validatedData["message_sent"],
            ]);
        }

        else {
            $validatedData = $request->validate([
                "name" => "required",
                "email" => "required",
                "phone" => "required",
                "message_sent" => "required"
            ]);
            $validatedData["name"] = strip_tags($validatedData["name"]);
            $validatedData["email"] = strip_tags($validatedData["email"]);
            $validatedData["phone"] = strip_tags($validatedData["phone"]);
            $validatedData["message_sent"] = strip_tags($validatedData["message_sent"]);
            //store thenm in users table first, since it has the foreign key in applications table
            $user = User::create([
                "name" => $validatedData["name"],
                "email" => $validatedData["email"],
                "phone" => $validatedData["phone"],
            ]);

            Application::create([
                "post_id" => $post->id,
                "user_id" => $user->id,
                "message_sent" => $validatedData["message_sent"],
            ]);
        }

        return redirect('/');
    }

    public function showApplyScreen(Post $post) {
        $user = auth()->user();
        return view("apply", compact('post', 'user' ));
    }
    
    public function deletePost(Post $post) {
        $post ->delete();
        // return redirect('/');
        return redirect()->back();
        // return redirect("/admin-crud");
    }
    
    public function editPost(Post $post, Request $request) {
        //input edits
        $validatedData = $request->validate([
            'job_title' => 'nullable',
            'full_description' => 'nullable',
            'company_name' => 'nullable',
            'location' => 'nullable',
            'wage' => 'nullable',
            'working_hrs' => 'nullable',
            'contact_name' => 'nullable',
            'contact_email' => 'nullable',

        ]);

        $validatedData['job_title'] = strip_tags($validatedData['job_title']);
        $validatedData['full_description'] = strip_tags($validatedData['full_description']);
        $validatedData['company_name'] = strip_tags($validatedData['company_name']);
        $validatedData['location'] = strip_tags($validatedData['location']);
        $validatedData['wage'] = strip_tags($validatedData['wage']);
        $validatedData['working_hrs'] = strip_tags($validatedData['working_hrs']);
        $validatedData['contact_name'] = strip_tags($validatedData['contact_name']);
        $validatedData['contact_email'] = strip_tags($validatedData['contact_email']);

        $post->update($validatedData);
        // return redirect('/');
        return redirect('/admin-crud');
        // return redirect()->back();

    }

    public function showEditScreen(Post $post) {
        return view("edit-post", ['post' => $post ]);
    }
    public function createPost(Request $request) {
        $validatedData = $request -> validate([
            'job_title' => 'required',
            'full_description' =>'required',
            'company_name' =>'required',
            'location' =>'required',
            'wage' =>'required',
            'working_hrs' =>'required',
            'contact_name' =>'required', 
            'contact_email' =>'required' 
        ]);

        // to make sure no funny html tags to sabatage the application, there's must be another than to copy paste hundres of line but for now i leave it like this
        $validatedData['job_title'] = strip_tags($validatedData['job_title']);
        $validatedData['full_description'] = strip_tags($validatedData['full_description']);
        $validatedData['company_name'] = strip_tags($validatedData['company_name']);
        $validatedData['location'] = strip_tags($validatedData['location']);
        $validatedData['wage'] = strip_tags($validatedData['wage']);
        $validatedData['working_hrs'] = strip_tags($validatedData['working_hrs']);
        $validatedData['contact_name'] = strip_tags($validatedData['contact_name']);
        $validatedData['contact_email'] = strip_tags($validatedData['contact_email']);

        $company = Company::create([
            'company_name' => $validatedData['company_name'],
            'contact_name' => $validatedData['contact_name'],
            'contact_email' => $validatedData['contact_email'],
            ]);
        
        $company->posts()->create([
            'job_title' => $validatedData['job_title'],
            'full_description' => $validatedData['full_description'],
            'location' => $validatedData['location'],
            'wage' => $validatedData['wage'],
            'working_hrs' => $validatedData['working_hrs'],
            'company_id' => $company->id ]);

        return redirect('/admin-crud');
        
    }
}
