<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\TravelRecommendations;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function welcome()
    {
        return view('home.welcome');
    }

    public function recommend()
    {
        return view('home.recommend');
    }

    public function showRecommendations(Request $request)
    {
        // For GET requests, show a default view or redirect
        if ($request->isMethod('get')) {
            return redirect()->route('recommend')->with('info', 'Please fill out the form to get recommendations.');
        }

        // Validate the request for POST requests
        $request->validate([
            'budget' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'activities' => 'required|array|min:1',
        ]);

        // Get the submitted data
        $budget = $request->input('budget');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $activities = $request->input('activities');

        // Mock destinations based on budget and activities
        $destinations = $this->getMockDestinations($budget, $activities);

        return view('home.results', [
            'destinations' => $destinations,
            'budget' => $budget,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'activities' => $activities
        ]);
    }

    public function generatePdf(Request $request)
    {
        // Validate the request
        $request->validate([
            'budget' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'activities' => 'required|array|min:1',
        ]);

        // Get the submitted data
        $budget = $request->input('budget');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $activities = $request->input('activities');

        // Mock destinations based on budget and activities
        $destinations = $this->getMockDestinations($budget, $activities);

        // Generate PDF
        $pdf = PDF::loadView('home.recommendation_pdf', [
            'destinations' => $destinations,
            'budget' => $budget,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'activities' => $activities
        ]);

        // Return the PDF for download
        return $pdf->download('travel-recommendations.pdf');
    }

    public function sendEmail(Request $request)
    {
        // Validate the request
        $request->validate([
            'budget' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'activities' => 'required|array|min:1',
            'email' => 'required|email',
        ]);

        // Get the submitted data
        $budget = $request->input('budget');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $activities = $request->input('activities');
        $email = $request->input('email');

        // Mock destinations based on budget and activities
        $destinations = $this->getMockDestinations($budget, $activities);

        // Send email
        Mail::to($email)->send(new TravelRecommendations(
            $destinations,
            $budget,
            $startDate,
            $endDate,
            $activities
        ));

        return redirect()->back()->with('success', 'Recommendations have been sent to your email!');
    }

    private function getMockDestinations($budget, $activities)
    {
        // Define all possible destinations
        $allDestinations = [
            [
                'name' => 'Bali, Indonesia',
                'image' => 'https://images.unsplash.com/photo-1537995904922-cc041dde977d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'description' => 'Tropical paradise with beautiful beaches, rich culture, and affordable luxury.',
                'cost' => 1500,
                'tags' => ['beach', 'nature', 'food']
            ],
            [
                'name' => 'Barcelona, Spain',
                'image' => 'https://images.unsplash.com/photo-1583422409516-2895a77efded?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'description' => 'Vibrant city with stunning architecture, beaches, and world-class cuisine.',
                'cost' => 2000,
                'tags' => ['beach', 'museums', 'nightlife', 'food']
            ],
            [
                'name' => 'Swiss Alps',
                'image' => 'https://images.unsplash.com/photo-1531366936337-7c912a4589a7?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'description' => 'Breathtaking mountain landscapes perfect for adventure and nature lovers.',
                'cost' => 3000,
                'tags' => ['adventure', 'nature']
            ],
            [
                'name' => 'Tokyo, Japan',
                'image' => 'https://images.unsplash.com/photo-1540959733332-eab4e40140cb?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'description' => 'Fascinating blend of ultra-modern and traditional culture.',
                'cost' => 2500,
                'tags' => ['museums', 'food', 'nightlife']
            ],
            [
                'name' => 'Costa Rica',
                'image' => 'https://images.unsplash.com/photo-1544989164-31dc8c27b5f7?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'description' => 'Eco-friendly paradise with rainforests, beaches, and adventure activities.',
                'cost' => 1800,
                'tags' => ['adventure', 'nature', 'beach']
            ],
            [
                'name' => 'New York City, USA',
                'image' => 'https://images.unsplash.com/photo-1522083165195-3424ed129620?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'description' => 'The city that never sleeps, offering museums, nightlife, and diverse food scene.',
                'cost' => 2200,
                'tags' => ['museums', 'nightlife', 'food']
            ]
        ];

        // Filter destinations based on budget and activities
        $filteredDestinations = array_filter($allDestinations, function($destination) use ($budget, $activities) {
            // Check if destination cost is within budget (with 20% buffer)
            $withinBudget = $destination['cost'] <= $budget * 1.2;
            
            // Check if destination has at least one of the selected activities
            $hasMatchingActivity = !empty(array_intersect($destination['tags'], $activities));
            
            return $withinBudget && $hasMatchingActivity;
        });

        // If we have more than 3 destinations, randomly select 3
        if (count($filteredDestinations) > 3) {
            $keys = array_rand($filteredDestinations, 3);
            $result = [];
            foreach ($keys as $key) {
                $result[] = $filteredDestinations[$key];
            }
            return $result;
        }

        // If we have fewer than 3 destinations, return all of them
        return array_values($filteredDestinations);
    }
} 