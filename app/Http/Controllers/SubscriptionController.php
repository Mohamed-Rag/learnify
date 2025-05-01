<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    /**
     * Display available subscription plans
     */
    public function showPlans()
    {
        // Here you would normally fetch plans from database
        // For simplicity, we'll define them here
        $plans = [
            [
                'id' => 'basic',
                'name' => 'Basic Plan',
                'price' => 9.99,
                'duration' => 30, // days
                'description' => 'monthly access to courses'
            ],
            [
                'id' => 'standard',
                'name' => 'Standard Plan',
                'price' => 19.99,
                'duration' => 120, // days
                'description' => 'quarterly access to courses'
            ],
            [
                'id' => 'premium',
                'name' => 'Premium Plan',
                'price' => 29.99,
                'duration' => 365, // days
                'description' => 'yearly access to courses'
            ]
        ];

        // Check if user has an active subscription
        $activeSubscription = null;
        if (Auth::check()) {
            $activeSubscription = Subscription::where('user_id', Auth::id())
                ->where('status', 'active')
                ->where('end_date', '>=', now())
                ->first();
        }

        return view('student.subscription_plans', compact('plans', 'activeSubscription'));
    }

    /**
     * Create a subscription and redirect to payment
     */
    public function subscribe(Request $request)
    {
        $validatedData = $request->validate([
            'plan_type' => 'required|string|in:basic,standard,premium',
        ]);

        // Create subscription with pending status
        $startDate = now();

        // Duration based on plan type
        $duration = 30; // Default 30 days

        $subscription = Subscription::create([
            'user_id' => Auth::id(),
            'plan_type' => $validatedData['plan_type'],
            'start_date' => $startDate,
            'end_date' => $startDate->copy()->addDays($duration),
            'status' => 'pending', // Will be set to active after payment
        ]);

        // Redirect to payment with subscription ID
        return redirect()->route('payment.form', ['subscription_id' => $subscription->id]);
    }

    /**
     * Display user's subscriptions
     */
    public function mySubscriptions()
    {
        $subscriptions = Subscription::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('student.my_subscriptions', compact('subscriptions'));
    }
}
