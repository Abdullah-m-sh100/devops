<?php

namespace Modules\Subscription\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Companies\Models\Company;
use Modules\Subscription\Models\Plan;
use Modules\Subscription\Models\Subscription;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::with(['company', 'plan'])->latest()->paginate(15);

        return view('subscription::subscriptions.index', compact('subscriptions'));
    }

    public function create()
    {
        return view('subscription::subscriptions.create', [
            'companies' => Company::orderBy('name')->get(),
            'plans' => Plan::where('is_active', true)->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        Subscription::create($this->validateSubscription($request));

        return redirect()->route('subscriptions.index')->with('status', 'Subscription created successfully.');
    }

    public function edit(Subscription $subscription)
    {
        return view('subscription::subscriptions.edit', [
            'subscription' => $subscription,
            'companies' => Company::orderBy('name')->get(),
            'plans' => Plan::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Subscription $subscription)
    {
        $subscription->update($this->validateSubscription($request));

        return redirect()->route('subscriptions.index')->with('status', 'Subscription updated successfully.');
    }

    public function destroy(Subscription $subscription)
    {
        $subscription->delete();

        return redirect()->route('subscriptions.index')->with('status', 'Subscription deleted successfully.');
    }

    private function validateSubscription(Request $request): array
    {
        return $request->validate([
            'tenant_id' => ['required', 'exists:tenants,id'],
            'plan_id' => ['required', 'exists:plans,id'],
            'status' => ['required', 'in:active,trialing,past_due,canceled'],
            'starts_at' => ['nullable', 'date'],
            'ends_at' => ['nullable', 'date', 'after_or_equal:starts_at'],
        ]);
    }
}
