<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            [
                'type'        => 'news',
                'title'       => 'VentureMatch Facilitates $2.5M Seed Round for AgriTech Startup GreenHarvest',
                'category'    => 'Deal News',
                'summary'     => 'GreenHarvest, a precision agriculture startup, has closed a $2.5M seed round through connections made on the VentureMatch platform, with participation from three angel investors.',
                'body'        => '<p>VentureMatch is proud to announce that GreenHarvest, a precision agriculture technology startup based in Dhaka, has successfully closed a $2.5 million seed funding round — with all three lead investors discovered through the VentureMatch platform.</p><p>GreenHarvest uses IoT sensors and AI-driven analytics to help smallholder farmers optimize irrigation, fertilization, and harvest timing. The company has already deployed its technology across 1,200 farms in three districts.</p><p>"VentureMatch gave us access to investors who truly understood our sector," said GreenHarvest CEO Rafiqul Islam. "Within 60 days of listing, we had 12 investor expressions of interest and closed our round in under 4 months."</p><p>The funding will be used to expand operations to five new districts and develop a mobile-first platform for farmers with limited internet access.</p>',
                'author'      => 'VentureMatch Editorial',
                'tags'        => ['AgriTech', 'Seed Round', 'Deal News', 'Startup'],
                'is_featured' => true,
                'status'      => 'published',
                'published_at'=> now()->subDays(2),
                'meta_title'  => 'VentureMatch Facilitates $2.5M Seed Round for GreenHarvest',
                'meta_description' => 'GreenHarvest closes $2.5M seed round through VentureMatch investor connections.',
            ],
            [
                'type'        => 'news',
                'title'       => 'Bangladesh Investment Landscape 2026: Trends Every Investor Should Know',
                'category'    => 'Market Insights',
                'summary'     => 'Our annual market report reveals a 34% increase in early-stage investments in Bangladesh, with FinTech and HealthTech leading deal volume in Q1 2026.',
                'body'        => '<p>The Bangladesh startup ecosystem is experiencing its most dynamic period yet. According to VentureMatch\'s Q1 2026 Investment Landscape Report, total disclosed early-stage investments grew 34% year-over-year, reaching an estimated $48M in the first quarter alone.</p><h3>Key Trends</h3><ul><li><strong>FinTech dominates:</strong> 28% of all deals were in financial technology, driven by mobile payment and SME lending solutions.</li><li><strong>HealthTech surges:</strong> Post-pandemic digital health adoption has pushed HealthTech to second place with 19% deal share.</li><li><strong>Ticket sizes growing:</strong> Average seed round size increased from $180K to $340K, signaling growing investor confidence.</li><li><strong>Female founders rising:</strong> 22% of funded startups had at least one female co-founder, up from 14% in 2024.</li></ul><p>The report also highlights increasing interest from diaspora investors, with 31% of capital coming from Bangladeshi investors based abroad.</p>',
                'author'      => 'Research Team, VentureMatch',
                'tags'        => ['Market Report', 'Bangladesh', 'Investment Trends', 'FinTech'],
                'is_featured' => true,
                'status'      => 'published',
                'published_at'=> now()->subDays(5),
                'meta_title'  => 'Bangladesh Investment Landscape 2026 Report',
                'meta_description' => 'Key investment trends in Bangladesh for 2026 — FinTech, HealthTech, and more.',
            ],
            [
                'type'        => 'news',
                'title'       => 'VentureMatch Launches New Investor Verification Program',
                'category'    => 'Platform Update',
                'summary'     => 'All investor profiles on VentureMatch will now go through a three-step verification process to ensure quality, trust, and better matching outcomes for seekers.',
                'body'        => '<p>Starting May 1, 2026, VentureMatch is rolling out a comprehensive Investor Verification Program designed to raise the quality bar for all investor profiles on the platform.</p><h3>The Three-Step Process</h3><ol><li><strong>Identity Verification:</strong> Government-issued ID and selfie verification via our secure KYC partner.</li><li><strong>Investment History Review:</strong> Submission of at least one verifiable past investment or fund affiliation.</li><li><strong>Profile Interview:</strong> A 20-minute video call with a VentureMatch team member to confirm investment thesis and sector focus.</li></ol><p>Verified investors will receive a blue checkmark badge on their profile and gain access to exclusive deal flow, priority event invitations, and direct founder introductions.</p><p>"This program is about building trust on both sides," said VentureMatch CEO. "Founders deserve to know that the investors viewing their pitches are serious and qualified."</p>',
                'author'      => 'VentureMatch Team',
                'tags'        => ['Platform', 'Verification', 'Investors', 'Trust'],
                'is_featured' => false,
                'status'      => 'published',
                'published_at'=> now()->subDays(8),
                'meta_title'  => 'VentureMatch Launches Investor Verification Program',
                'meta_description' => 'New three-step investor verification for better trust and matching on VentureMatch.',
            ],
            [
                'type'        => 'news',
                'title'       => '5 FinTech Startups to Watch in Bangladesh This Year',
                'category'    => 'Startup Spotlight',
                'summary'     => 'From embedded finance to SME credit scoring, these five VentureMatch-listed FinTech startups are redefining financial access in Bangladesh.',
                'body'        => '<p>Bangladesh\'s FinTech sector is producing some of the most innovative startups in South Asia. Here are five companies currently listed on VentureMatch that are worth watching closely in 2026.</p><h3>1. PayEase BD</h3><p>A B2B payment infrastructure company enabling SMEs to accept digital payments with zero setup cost. Currently processing $2M/month in transactions.</p><h3>2. CreditBridge</h3><p>Uses alternative data (mobile usage, utility payments) to provide credit scores for the 60% of Bangladeshis without formal banking history.</p><h3>3. AgriLend</h3><p>Micro-lending platform specifically for farmers, with repayment tied to harvest cycles rather than fixed monthly installments.</p><h3>4. InsureNow</h3><p>Micro-insurance products distributed via mobile operators, targeting the informal sector with premiums as low as $0.50/month.</p><h3>5. RemitFast</h3><p>Blockchain-based remittance platform reducing transfer fees for the 10M+ Bangladeshi diaspora from 5% to under 1%.</p>',
                'author'      => 'Nadia Islam, Contributing Editor',
                'tags'        => ['FinTech', 'Startup Spotlight', 'Bangladesh', 'Investment'],
                'is_featured' => false,
                'status'      => 'published',
                'published_at'=> now()->subDays(12),
                'meta_title'  => '5 FinTech Startups to Watch in Bangladesh 2026',
                'meta_description' => 'Top FinTech startups listed on VentureMatch redefining financial access in Bangladesh.',
            ],
            [
                'type'        => 'press_release',
                'title'       => 'VentureMatch Crosses 500 Registered Investors Milestone',
                'category'    => 'Press Release',
                'summary'     => 'VentureMatch today announced it has surpassed 500 registered investors on its platform, representing over $200M in combined investable capital.',
                'body'        => '<p><strong>Dhaka, Bangladesh — April 9, 2026</strong> — VentureMatch, the leading investment ecosystem platform in Bangladesh, today announced that it has surpassed 500 registered investors on its platform, a milestone that represents a significant step in the company\'s mission to democratize access to startup capital.</p><p>The 500 investors collectively represent over $200 million in investable capital, spanning angel investors, family offices, venture capital firms, and corporate investors from Bangladesh and the diaspora.</p><p>"Reaching 500 investors is a testament to the trust the investment community has placed in VentureMatch," said the company\'s founder. "More importantly, it means our startup founders now have access to a deeper, more diverse pool of capital than ever before."</p><p>The platform has facilitated connections leading to over $15M in disclosed investments since its launch, with an average of 3.2 investor expressions of interest per listed opportunity.</p>',
                'author'      => 'VentureMatch Communications',
                'tags'        => ['Milestone', 'Press Release', 'Growth', 'Platform'],
                'is_featured' => false,
                'status'      => 'published',
                'published_at'=> now()->subDays(18),
                'meta_title'  => 'VentureMatch Crosses 500 Investors Milestone',
                'meta_description' => 'VentureMatch surpasses 500 registered investors representing $200M+ in capital.',
            ],
            [
                'type'        => 'news',
                'title'       => 'How to Write an Investor-Ready Executive Summary',
                'category'    => 'Founder Resources',
                'summary'     => 'Your executive summary is the first thing investors read. Here\'s a proven framework used by VentureMatch\'s top-funded startups to craft a compelling one-pager.',
                'body'        => '<p>The executive summary is often the make-or-break document in early investor conversations. Get it right, and you earn a meeting. Get it wrong, and your pitch deck never gets opened.</p><h3>The 7 Elements of a Strong Executive Summary</h3><ol><li><strong>The Hook (1 sentence):</strong> What do you do, for whom, and why now?</li><li><strong>The Problem:</strong> Quantify the pain. Use data.</li><li><strong>Your Solution:</strong> How you solve it differently from everyone else.</li><li><strong>Traction:</strong> Revenue, users, growth rate — whatever proves people want this.</li><li><strong>Market Size:</strong> TAM, SAM, SOM — keep it credible.</li><li><strong>The Ask:</strong> How much, for what milestones, at what valuation?</li><li><strong>The Team:</strong> Why are you the right people to build this?</li></ol><p>Keep it to one page. Use plain language. Avoid jargon. And always lead with your strongest proof point.</p>',
                'author'      => 'Mehedi Hassan, Venture Partner',
                'tags'        => ['Founder Resources', 'Fundraising', 'Tips', 'Pitch'],
                'is_featured' => false,
                'status'      => 'published',
                'published_at'=> now()->subDays(22),
                'meta_title'  => 'How to Write an Investor-Ready Executive Summary',
                'meta_description' => 'A proven framework for writing executive summaries that get investor meetings.',
            ],
            [
                'type'        => 'news',
                'title'       => 'VentureMatch Summit 2025: Key Takeaways and Highlights',
                'category'    => 'Event Recap',
                'summary'     => 'Over 280 attendees, 14 startup pitches, and 3 deals announced on stage — here\'s everything that happened at the VentureMatch Investor Summit 2025.',
                'body'        => '<p>The VentureMatch Investor Summit 2025 was our biggest event yet — and by every measure, it delivered. Here are the key highlights from a packed day of panels, pitches, and networking.</p><h3>By the Numbers</h3><ul><li>283 total attendees (investors, founders, ecosystem partners)</li><li>14 startup pitches across 4 sectors</li><li>3 deals announced on stage totaling $1.8M</li><li>47 one-on-one investor-founder meetings facilitated</li><li>22 countries represented</li></ul><h3>Top Moments</h3><p>The keynote by Arif Rahman of Frontier Ventures set the tone with a bold prediction: "Bangladesh will produce its first unicorn by 2028." The audience responded with a standing ovation.</p><p>The HealthTech pitch session was the most competitive, with MediConnect winning the audience vote and walking away with a $500K commitment from two investors in the room.</p>',
                'author'      => 'VentureMatch Editorial',
                'tags'        => ['Event Recap', 'Summit', '2025', 'Highlights'],
                'is_featured' => false,
                'status'      => 'published',
                'published_at'=> now()->subDays(30),
                'meta_title'  => 'VentureMatch Summit 2025 Highlights & Recap',
                'meta_description' => 'Key takeaways from the VentureMatch Investor Summit 2025 — deals, pitches, and insights.',
            ],
            [
                'type'        => 'notice',
                'title'       => 'Platform Maintenance: April 20, 2026 (2:00 AM – 4:00 AM BDT)',
                'category'    => 'System Notice',
                'summary'     => 'VentureMatch will undergo scheduled maintenance on April 20, 2026 between 2:00 AM and 4:00 AM Bangladesh time. The platform will be temporarily unavailable during this window.',
                'body'        => '<p>Dear VentureMatch Members,</p><p>We will be performing scheduled system maintenance on <strong>April 20, 2026 from 2:00 AM to 4:00 AM BDT</strong>. During this time, the platform will be temporarily unavailable.</p><p>This maintenance includes database optimizations, security patches, and infrastructure upgrades that will improve platform performance and reliability.</p><p>We apologize for any inconvenience and appreciate your patience. If you have any urgent matters, please contact us at support@venturematch.com before the maintenance window.</p>',
                'author'      => 'VentureMatch Technical Team',
                'tags'        => ['Maintenance', 'System', 'Notice'],
                'importance_level' => 'medium',
                'is_featured' => false,
                'status'      => 'published',
                'published_at'=> now()->subDays(1),
                'meta_title'  => 'Scheduled Maintenance Notice — VentureMatch',
                'meta_description' => 'VentureMatch scheduled maintenance on April 20, 2026.',
            ],
        ];

        foreach ($articles as $data) {
            News::firstOrCreate(
                ['title' => $data['title']],
                $data
            );
        }
    }
}
