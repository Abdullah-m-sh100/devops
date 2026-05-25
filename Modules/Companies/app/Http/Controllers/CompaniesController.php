<?php

namespace Modules\Companies\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Modules\Companies\Models\Company;
use Stancl\Tenancy\Jobs\CreateDatabase;
use Stancl\Tenancy\Jobs\DeleteDatabase;

class CompaniesController extends Controller
{
    public function index()
    {
        $companies = Company::with(['domains', 'activeSubscription.plan'])->latest()->paginate(15);

        return view('companies::companies.index', compact('companies'));
    }

    public function create()
    {
        return view('companies::companies.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:191'],
            'email' => ['nullable', 'email', 'max:191'],
            'phone' => ['nullable', 'string', 'max:50'],
            'domain' => ['required', 'string', 'max:191', 'unique:domains,domain'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $company = Company::create([
            'id' => Str::slug($data['name']).'-'.Str::lower(Str::random(6)),
            'name' => $data['name'],
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'] ?? null,
            'status' => $data['status'],
        ]);

        $company->domains()->create(['domain' => $data['domain']]);
        CreateDatabase::dispatchSync($company);
        Artisan::call('tenants:migrate', ['--tenants' => [$company->id]]);
        Artisan::call('tenants:seed', ['--tenants' => [$company->id], '--class' => 'TenantDatabaseSeeder']);

        return redirect()->route('companies.index')->with('status', 'Company created successfully.');
    }

    public function show(Company $company)
    {
        $company->load(['domains', 'subscriptions.plan']);

        return view('companies::companies.show', compact('company'));
    }

    public function edit(Company $company)
    {
        $company->load('domains');

        return view('companies::companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $domainId = $company->domains()->first()?->id;

        $data = $request->validate([
            'name' => ['required', 'string', 'max:191'],
            'email' => ['nullable', 'email', 'max:191'],
            'phone' => ['nullable', 'string', 'max:50'],
            'domain' => ['required', 'string', 'max:191', 'unique:domains,domain,'.($domainId ?? 'NULL')],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $company->update($data);
        $company->domains()->updateOrCreate(['id' => $domainId], ['domain' => $data['domain']]);

        return redirect()->route('companies.index')->with('status', 'Company updated successfully.');
    }

    public function destroy(Company $company)
    {
        DeleteDatabase::dispatchSync($company);
        $company->delete();

        return redirect()->route('companies.index')->with('status', 'Company deleted successfully.');
    }
}
