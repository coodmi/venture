<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $events = [
            [
                'title'             => 'VentureMatch Investor Summit 2026',
                'category'          => 'Summit',
                'summary'           => 'Annual flagship summit bringing together 300+ investors, founders, and ecosystem leaders for a full day of keynotes, panels, and deal-making.',
                'description'       => '<p>The VentureMatch Investor Summit is our flagship annual event — a full-day gathering of the most active investors, high-growth startups, and ecosystem enablers in the region.</p><p>Expect curated networking sessions, live startup pitches, expert panels on emerging sectors, and exclusive one-on-one meeting slots between investors and founders.</p><h3>What to Expect</h3><ul><li>Opening keynote by a leading regional VC</li><li>5 startup pitch sessions across sectors</li><li>Panel: The Future of Impact Investing</li><li>Investor-Founder speed networking</li><li>Gala dinner and awards ceremony</li></ul>',
                'event_type'        => 'offline',
                'venue'             => 'Radisson Blu Water Garden, Dhaka',
                'start_date'        => now()->addDays(36)->setTime(9, 0),
                'end_date'          => now()->addDays(36)->setTime(18, 0),
                'registration_open' => true,
                'max_attendees'     => 350,
                'status'            => 'published',
                'is_featured'       => true,
                'speakers'          => [
                    ['name' => 'Arif Rahman', 'title' => 'Managing Partner, Frontier Ventures'],
                    ['name' => 'Nadia Islam',  'title' => 'CEO, TechBridge BD'],
                    ['name' => 'Karim Hossain','title' => 'Director, Bangladesh Investment Authority'],
                ],
                'meta_title'        => 'VentureMatch Investor Summit 2026',
                'meta_description'  => 'Join 300+ investors and founders at the VentureMatch Investor Summit 2026 in Dhaka.',
            ],
            [
                'title'             => 'Startup Showcase: FinTech Edition',
                'category'          => 'Showcase',
                'summary'           => '10 curated FinTech startups pitch live to a panel of investors. Open to all registered investors on the platform.',
                'description'       => '<p>Our sector-focused Startup Showcase brings the best FinTech startups directly to investors in a structured, high-energy pitch format.</p><p>Each startup gets 8 minutes to pitch followed by 5 minutes of Q&A from the investor panel. After the pitches, attendees join breakout rooms for deeper conversations.</p><h3>Format</h3><ul><li>10 curated FinTech startups</li><li>8-minute pitch + 5-minute Q&A each</li><li>Live investor voting for top picks</li><li>Post-event networking on Zoom</li></ul>',
                'event_type'        => 'online',
                'venue'             => null,
                'online_link'       => 'https://zoom.us/j/venturematch',
                'start_date'        => now()->addDays(49)->setTime(14, 0),
                'end_date'          => now()->addDays(49)->setTime(17, 30),
                'registration_open' => true,
                'max_attendees'     => 200,
                'status'            => 'published',
                'is_featured'       => false,
                'speakers'          => [
                    ['name' => 'Samira Chowdhury', 'title' => 'Partner, FinTech Capital'],
                    ['name' => 'Reza Ahmed',        'title' => 'Angel Investor & Advisor'],
                ],
                'meta_title'        => 'FinTech Startup Showcase — VentureMatch',
                'meta_description'  => 'Watch 10 curated FinTech startups pitch live to investors on VentureMatch.',
            ],
            [
                'title'             => 'Investor Networking Night',
                'category'          => 'Networking',
                'summary'           => 'An exclusive evening of cocktails and conversations for VentureMatch members. Build relationships that turn into partnerships.',
                'description'       => '<p>An intimate, members-only networking evening designed for serious investors and founders to connect in a relaxed, high-quality setting.</p><p>No pitches, no panels — just meaningful conversations over dinner and drinks. Attendance is capped at 80 to ensure quality interactions.</p>',
                'event_type'        => 'offline',
                'venue'             => 'The Westin Dhaka, Executive Lounge',
                'start_date'        => now()->addDays(57)->setTime(18, 30),
                'end_date'          => now()->addDays(57)->setTime(21, 30),
                'registration_open' => true,
                'max_attendees'     => 80,
                'status'            => 'published',
                'is_featured'       => false,
                'speakers'          => [],
                'meta_title'        => 'Investor Networking Night — VentureMatch',
                'meta_description'  => 'Exclusive networking evening for VentureMatch investors and founders.',
            ],
            [
                'title'             => 'Due Diligence Masterclass',
                'category'          => 'Workshop',
                'summary'           => 'A hands-on workshop for investors covering financial modeling, term sheets, and startup valuation frameworks.',
                'description'       => '<p>This intensive half-day workshop is designed for angel investors and early-stage VCs who want to sharpen their due diligence process.</p><h3>Topics Covered</h3><ul><li>Startup financial model review</li><li>Cap table analysis and dilution</li><li>Term sheet negotiation tactics</li><li>Red flags in founder interviews</li><li>Portfolio construction strategy</li></ul>',
                'event_type'        => 'online',
                'venue'             => null,
                'online_link'       => 'https://zoom.us/j/venturematch-workshop',
                'start_date'        => now()->addDays(64)->setTime(10, 0),
                'end_date'          => now()->addDays(64)->setTime(13, 0),
                'registration_open' => true,
                'max_attendees'     => 120,
                'status'            => 'published',
                'is_featured'       => false,
                'speakers'          => [
                    ['name' => 'Dr. Tanvir Hasan', 'title' => 'CFO, Growth Equity Partners'],
                ],
                'meta_title'        => 'Due Diligence Masterclass — VentureMatch',
                'meta_description'  => 'Learn startup due diligence, valuation, and term sheet negotiation from experts.',
            ],
            [
                'title'             => 'AgriTech & CleanTech Deal Day',
                'category'          => 'Showcase',
                'summary'           => 'Sector-focused deal day featuring 8 vetted AgriTech and CleanTech startups seeking Series A and growth-stage capital.',
                'description'       => '<p>A dedicated deal day for investors focused on sustainable sectors. Eight pre-vetted startups across AgriTech and CleanTech will present their businesses to a curated investor audience.</p><p>This hybrid event allows both in-person and remote investors to participate fully.</p>',
                'event_type'        => 'hybrid',
                'venue'             => 'Pan Pacific Sonargaon, Dhaka',
                'online_link'       => 'https://zoom.us/j/venturematch-dealday',
                'start_date'        => now()->addDays(72)->setTime(11, 0),
                'end_date'          => now()->addDays(72)->setTime(16, 0),
                'registration_open' => false,
                'max_attendees'     => 150,
                'status'            => 'published',
                'is_featured'       => false,
                'speakers'          => [
                    ['name' => 'Fatema Begum',  'title' => 'Impact Investor, Green Capital'],
                    ['name' => 'Shafiq Ullah',  'title' => 'Partner, AgriVentures Fund'],
                ],
                'meta_title'        => 'AgriTech & CleanTech Deal Day — VentureMatch',
                'meta_description'  => 'Invest in the future of agriculture and clean energy at VentureMatch Deal Day.',
            ],
            [
                'title'             => 'Founder Bootcamp: Pitch Perfect',
                'category'          => 'Bootcamp',
                'summary'           => 'A 2-day intensive bootcamp for founders to refine their pitch, financial model, and investor narrative before going live on the platform.',
                'description'       => '<p>Pitch Perfect is our flagship founder preparation program. Over two intensive days, founders work with experienced investors and coaches to sharpen every aspect of their investor-facing materials.</p><h3>Day 1: Story & Strategy</h3><ul><li>Problem-solution narrative</li><li>Market sizing and competitive landscape</li><li>Business model deep dive</li></ul><h3>Day 2: Numbers & Pitch</h3><ul><li>Financial model review</li><li>Mock investor Q&A sessions</li><li>Final pitch presentation</li></ul>',
                'event_type'        => 'offline',
                'venue'             => 'VentureMatch HQ, Gulshan, Dhaka',
                'start_date'        => now()->addDays(85)->setTime(9, 0),
                'end_date'          => now()->addDays(86)->setTime(17, 0),
                'registration_open' => true,
                'max_attendees'     => 30,
                'status'            => 'published',
                'is_featured'       => false,
                'speakers'          => [
                    ['name' => 'Mehedi Hassan',   'title' => 'Venture Partner, Startup BD'],
                    ['name' => 'Priya Sharma',    'title' => 'Pitch Coach & Former Founder'],
                ],
                'meta_title'        => 'Founder Bootcamp: Pitch Perfect — VentureMatch',
                'meta_description'  => 'Prepare your startup pitch for investors with VentureMatch\'s Pitch Perfect Bootcamp.',
            ],
        ];

        foreach ($events as $data) {
            Event::firstOrCreate(
                ['title' => $data['title']],
                $data
            );
        }
    }
}
