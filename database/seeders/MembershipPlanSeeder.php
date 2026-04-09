<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MembershipPlan;

class MembershipPlanSeeder extends Seeder
{
    public function run(): void
    {
        $plans = [
            [
                'name'            => 'General Member',
                'category'        => 'general',
                'description'     => 'Basic access to the VentureMatch ecosystem.',
                'benefits'        => ['Access to public listings', 'Newsletter subscription', 'Event registration'],
                'fee'             => 0,
                'duration_months' => 12,
                'is_public'       => true,
                'sort_order'      => 1,
            ],
            [
                'name'            => 'Investor Member',
                'category'        => 'investor',
                'description'     => 'Full investor access with deal flow and matching.',
                'benefits'        => ['Full opportunity access', 'Investor dashboard', 'Deal pipeline', 'Direct messaging', 'Priority matching'],
                'fee'             => 299,
                'duration_months' => 12,
                'is_public'       => true,
                'sort_order'      => 2,
            ],
            [
                'name'            => 'Startup / Seeker',
                'category'        => 'founder',
                'description'     => 'Submit opportunities and connect with investors.',
                'benefits'        => ['Opportunity submission', 'Investor interest tracking', 'Seeker dashboard', 'Profile visibility'],
                'fee'             => 99,
                'duration_months' => 12,
                'is_public'       => true,
                'sort_order'      => 3,
            ],
            [
                'name'            => 'Premium Partner',
                'category'        => 'partner',
                'description'     => 'Strategic partnership access and co-branding.',
                'benefits'        => ['All investor benefits', 'Co-branding opportunities', 'Event sponsorship', 'Featured listing', 'Dedicated support'],
                'fee'             => 999,
                'duration_months' => 12,
                'is_public'       => true,
                'sort_order'      => 4,
            ],
        ];

        foreach ($plans as $plan) {
            MembershipPlan::firstOrCreate(['name' => $plan['name']], $plan);
        }
    }
}
