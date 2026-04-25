<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AboutContent;

class AboutContentSeeder extends Seeder
{
    public function run(): void
    {
        $siteName = \App\Models\Setting::get('site_name', config('app.name', 'VentureMatch'));

        $sections = [
            [
                'section'    => 'hero',
                'title'      => 'Building the Bridge Between Capital & Innovation',
                'content'    => $siteName . ' was founded with a single belief — that the right connection between an investor and a founder can change the world.',
                'extra'      => ['badge' => 'Our Story'],
                'sort_order' => 1,
            ],
            [
                'section'    => 'overview',
                'title'      => 'The Investment Ecosystem Platform',
                'content'    => '<p>' . $siteName . ' is a curated investment ecosystem platform that connects investors, founders, startups, and ecosystem partners on a single, powerful platform.</p><p>We believe that capital should flow to the best ideas — regardless of geography, network, or background.</p><p>From angel investors to venture capital firms, from early-stage startups to growth-stage companies — ' . $siteName . ' serves the entire investment lifecycle.</p>',
                'sort_order' => 2,
            ],
            [
                'section'    => 'vision',
                'title'      => 'Our Vision',
                'content'    => 'To become the most trusted investment ecosystem platform in emerging markets — where every great idea finds the capital it deserves.',
                'sort_order' => 3,
            ],
            [
                'section'    => 'mission',
                'title'      => 'Our Mission',
                'content'    => 'To democratize access to investment opportunities by building a transparent, efficient, and inclusive platform that empowers investors and founders.',
                'sort_order' => 4,
            ],
            [
                'section'    => 'founder_message',
                'title'      => 'Founder & CEO',
                'content'    => "I've seen firsthand how difficult it is for brilliant founders to get in front of the right investors. " . $siteName . " was born to solve exactly that — making the investment ecosystem more accessible, transparent, and impactful for everyone involved.",
                'sort_order' => 5,
            ],
            [
                'section'    => 'highlights',
                'title'      => 'Highlights',
                'extra'      => [
                    ['value' => '500+',  'label' => 'Registered Investors'],
                    ['value' => '200+',  'label' => 'Startups Listed'],
                    ['value' => '$50M+', 'label' => 'Capital Connected'],
                    ['value' => '15+',   'label' => 'Countries Reached'],
                ],
                'sort_order' => 6,
            ],
            [
                'section'    => 'board_members',
                'title'      => 'Board Members',
                'extra'      => [
                    ['name' => 'Dr. Kamal Hossain',  'role' => 'Chairman',             'org' => 'VentureMatch Foundation', 'bio' => 'Former Governor of Bangladesh Bank with 30+ years in financial regulation and investment policy.'],
                    ['name' => 'Fatima Rahman',       'role' => 'Vice Chairperson',     'org' => 'Impact Capital BD',       'bio' => 'Pioneer in impact investing across South Asia with a portfolio of 50+ social enterprises.'],
                    ['name' => 'Arif Chowdhury',      'role' => 'Board Director',       'org' => 'TechVentures Ltd',        'bio' => 'Serial entrepreneur and angel investor with exits in FinTech and AgriTech sectors.'],
                    ['name' => 'Nadia Islam',         'role' => 'Independent Director', 'org' => 'BRAC Investments',        'bio' => 'Expert in corporate governance and sustainable finance with 20+ years of board experience.'],
                    ['name' => 'Tanvir Ahmed',        'role' => 'Board Director',       'org' => 'Dhaka Ventures',          'bio' => 'Venture capitalist focused on early-stage technology startups in emerging markets.'],
                    ['name' => 'Sabrina Malik',       'role' => 'Advisory Member',      'org' => 'Global Impact Fund',      'bio' => 'International development finance expert with experience at IFC and ADB.'],
                ],
                'sort_order' => 7,
            ],
        ];

        foreach ($sections as $data) {
            AboutContent::updateOrCreate(
                ['section' => $data['section']],
                array_merge($data, ['is_published' => true])
            );
        }
    }
}
