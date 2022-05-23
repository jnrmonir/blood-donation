<?php

namespace App\Http\Livewire\Admin;

use App\Models\City;
use App\Models\Post;
use App\Models\User;
use App\Models\State;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Country;
use App\Models\Reports;
use Livewire\Component;
use App\Models\Category;
use App\Models\Feedback;
use App\Models\BloodRequest;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{

    public function render()
    {
        if(Auth::user()->role_id != 1){
            return abort(403);
        }else{
            $total_users = User::count();
            $total_donars = User::bloodDonar()->count();
            $total_blood_requests = BloodRequest::count();
            $total_categories = Category::count();
            $total_comments = Comment::count();
            $total_reports = Reports::count();
            $total_feedbacks = Feedback::count();
            $total_posts = Post::count();
            $total_countries = Country::count();
            $total_states = State::count();
            $total_cities = City::count();
            $total_messages = Contact::count();
            return view('livewire.admin.dashboard',[
                'total_users' => $total_users,
                'total_donars' => $total_donars,
                'total_blood_requests' => $total_blood_requests,
                'total_categories' => $total_categories,
                'total_posts' => $total_posts,
                'total_countries' => $total_countries,
                'total_states' => $total_states,
                'total_cities' => $total_cities,
                'total_messages' => $total_messages,
                'total_comments' => $total_comments,
                'total_reports' => $total_reports,
                'total_feedbacks' => $total_feedbacks])->extends('layouts.base');
        }

    }
}
