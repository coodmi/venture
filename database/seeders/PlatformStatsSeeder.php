<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PlatformStat;

class PlatformStatsSeeder extends Seeder
{
    public function run(): void
    {
        $stats = [
            ['key' => 'total_investors',  'label' => 'Investors',       'value' => '500+',  'icon' => 'users',        'sort_order' => 1],
            ['key' => 'total_seekers',    'label' => 'Startups',        'value' => '1200+', 'icon' => 'rocket',       'sort_order' => 2],
            ['key' => 'total_projects',   'label' => 'Projects',        'value' => '350+',  'icon' => 'briefcase',    'sort_order' => 3],
            ['key' => 'active_deals',     'label' => 'Active Deals',    'value' => '80+',   'icon' => 'handshake',    'sort_order' => 4],
            ['key' => 'total_members',    'label' => 'Members',         'value' => '3000+', 'icon' => 'id-card',      'sort_order' => 5],
            ['key' => 'conferences_held', 'label' => 'Conferences',     'value' => '25+',   'icon' => 'microphone',   'sort_order' => 6],
        ];

        foreach ($stats as $stat) {
            PlatformStat::firstOrCreate(['key' => $stat['key']], $stat);
        }
    }
}
