<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Show payment form
     */
    public function showForm($subscription_id = null)
    {
        $subscription = null;

        if ($subscription_id) {
            $subscription = Subscription::where('id', $subscription_id)
                ->where('user_id', Auth::id())
                ->firstOrFail();
        }

        return view('student.payment_form', compact('subscription'));
    }

    /**
     * Process payment
     */
    public function processPayment(Request $request)
    {
        $validated = $request->validate([
            'subscription_id' => 'required|exists:subscriptions,id',
            'card_number' => 'required|string|min:16|max:19',
            'card_name' => 'required|string',
            'expiry_date' => 'required|string',
            'cvv' => 'required|string|size:3',
        ]);

        // Get subscription
        $subscription = Subscription::where('id', $validated['subscription_id'])
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Create payment record
        $payment = Payment::create([
            'user_id' => Auth::id(),
            'subscription_id' => $subscription->id,
            'amount' => $this->getPlanPrice($subscription->plan_type),
            'payment_date' => now(),
        ]);

        // Activate subscription
        $subscription->status = 'active';
        $subscription->save();

        return redirect()->route('student.dashboard')
            ->with('success', 'Payment successful! Your subscription is now active.');
    }

    /**
     * Get plan price based on plan type
     */
    private function getPlanPrice($planType)
    {
        $prices = [
            'basic' => 9.99,
            'standard' => 19.99,
            'premium' => 29.99
        ];

        return $prices[$planType] ?? 9.99;
    }
}
