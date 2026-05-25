<?php

namespace Modules\Subscription\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\Subscription\Models\Plan;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::latest()->paginate(15);

        return view('subscription::plans.index', compact('plans'));
    }

    public function create()
    {
        return view('subscription::plans.create');
    }

    public function store(Request $request)
    {
        $data = $this->validatePlan($request);
        $data['slug'] = Str::slug($data['name']);
        $data['is_active'] = $request->boolean('is_active');

        Plan::create($data);

        return redirect()->route('plans.index')->with('status', 'Plan created successfully.');
    }

    public function show(Plan $plan)
    {
        return redirect()->route('plans.edit', $plan);
    }

    public function edit(Plan $plan)
    {
        return view('subscription::plans.edit', compact('plan'));
    }

    public function update(Request $request, Plan $plan)
    {
        $data = $this->validatePlan($request, $plan);
        $data['slug'] = Str::slug($data['name']);
        $data['is_active'] = $request->boolean('is_active');

        $plan->update($data);

        return redirect()->route('plans.index')->with('status', 'Plan updated successfully.');
    }

    public function destroy(Plan $plan)
    {
        $plan->delete();

        return redirect()->route('plans.index')->with('status', 'Plan deleted successfully.');
    }

    private function validatePlan(Request $request, ?Plan $plan = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:191', 'unique:plans,name,'.($plan?->id ?? 'NULL')],
            'price' => ['required', 'numeric', 'min:0'],
            'billing_period' => ['required', 'in:monthly,yearly'],
            'max_users' => ['required', 'integer', 'min:1'],
            'max_messages' => ['required', 'integer', 'min:1'],
        ]);
    }
}
