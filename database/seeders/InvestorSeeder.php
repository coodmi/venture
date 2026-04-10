<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\InvestorProfile;
use Illuminate\Support\Facades\Hash;

class InvestorSeeder extends Seeder
{
    public function run(): void
    {
        $investors = [
            // ── Angel Investors (3) ───────────────────────────────────────
            ['name'=>'Arif Rahman','email'=>'arif.rahman@inv.com','org'=>'Independent','designation'=>'Angel Investor & Advisor','type'=>'angel','stage'=>'pre_seed','min'=>'500000','max'=>'2000000','sectors'=>['FinTech','AgriTech'],'risk'=>'aggressive','bio'=>'Serial entrepreneur turned angel investor with 3 successful exits. Invested in 18 startups across Bangladesh and Southeast Asia. Focus on early-stage FinTech and AgriTech.','linkedin'=>'https://linkedin.com/in/arifrahman'],
            ['name'=>'Nadia Islam','email'=>'nadia.islam@inv.com','org'=>'TechBridge BD','designation'=>'Founder & Angel Investor','type'=>'angel','stage'=>'seed','min'=>'1000000','max'=>'5000000','sectors'=>['EdTech','HealthTech'],'risk'=>'moderate','bio'=>'Former McKinsey consultant and founder of TechBridge BD. Passionate about education and healthcare innovation. Has backed 12 startups with a focus on social impact.','linkedin'=>'https://linkedin.com/in/nadiaislam'],
            ['name'=>'Karim Hossain','email'=>'karim.hossain@inv.com','org'=>'KH Ventures','designation'=>'Managing Partner','type'=>'angel','stage'=>'pre_seed','min'=>'300000','max'=>'1500000','sectors'=>['CleanTech','AgriTech'],'risk'=>'moderate','bio'=>'20 years in sustainable development. Now deploying capital into climate-focused startups in Bangladesh. Advisor to the Bangladesh Investment Authority.','linkedin'=>'https://linkedin.com/in/karimhossain'],

            // ── Venture Capital (3) ───────────────────────────────────────
            ['name'=>'Samira Chowdhury','email'=>'samira@frontiervc.com','org'=>'Frontier Ventures','designation'=>'Partner','type'=>'vc','stage'=>'series_a','min'=>'10000000','max'=>'50000000','sectors'=>['FinTech','HealthTech','EdTech'],'risk'=>'moderate','bio'=>'Partner at Frontier Ventures, one of Bangladesh\'s leading early-stage VC firms. Portfolio includes 25 companies with 3 exits. Previously at Sequoia Capital India.','linkedin'=>'https://linkedin.com/in/samirachowdhury'],
            ['name'=>'Reza Ahmed','email'=>'reza@growthcapital.com','org'=>'Growth Capital Partners','designation'=>'Managing Director','type'=>'vc','stage'=>'series_b','min'=>'25000000','max'=>'100000000','sectors'=>['FinTech','CleanTech'],'risk'=>'conservative','bio'=>'MD at Growth Capital Partners with $50M AUM. Focus on Series B and growth-stage companies with proven unit economics. 15 years in private equity across South Asia.','linkedin'=>'https://linkedin.com/in/rezaahmed'],
            ['name'=>'Fatema Begum','email'=>'fatema@greenvc.com','org'=>'Green Capital Fund','designation'=>'General Partner','type'=>'vc','stage'=>'seed','min'=>'5000000','max'=>'20000000','sectors'=>['CleanTech','AgriTech'],'risk'=>'moderate','bio'=>'GP at Green Capital Fund, a $30M impact-focused VC. Specializes in climate tech and sustainable agriculture. Former World Bank climate finance specialist.','linkedin'=>'https://linkedin.com/in/fatemabegum'],

            // ── Corporate Investors (3) ───────────────────────────────────
            ['name'=>'Shafiq Ullah','email'=>'shafiq@grameentech.com','org'=>'Grameen Tech Ventures','designation'=>'Head of Corporate Ventures','type'=>'corporate','stage'=>'seed','min'=>'5000000','max'=>'30000000','sectors'=>['FinTech','AgriTech','HealthTech'],'risk'=>'conservative','bio'=>'Leading corporate venture arm of Grameen Group. Focuses on startups that can scale through Grameen\'s distribution network of 9 million microfinance clients.','linkedin'=>'https://linkedin.com/in/shafiqullah'],
            ['name'=>'Tanvir Hasan','email'=>'tanvir@brac-ventures.com','org'=>'BRAC Ventures','designation'=>'Investment Director','type'=>'corporate','stage'=>'series_a','min'=>'15000000','max'=>'75000000','sectors'=>['HealthTech','EdTech','AgriTech'],'risk'=>'moderate','bio'=>'Investment Director at BRAC Ventures. Leverages BRAC\'s global network to scale portfolio companies. Focus on startups solving problems for underserved communities.','linkedin'=>'https://linkedin.com/in/tanvirhasan'],
            ['name'=>'Priya Sharma','email'=>'priya@robi-ventures.com','org'=>'Robi Axiata Ventures','designation'=>'VP Corporate Development','type'=>'corporate','stage'=>'seed','min'=>'3000000','max'=>'15000000','sectors'=>['FinTech','EdTech'],'risk'=>'aggressive','bio'=>'VP at Robi Axiata Ventures. Focuses on digital and mobile-first startups that can leverage Robi\'s 50 million subscriber base for distribution and growth.','linkedin'=>'https://linkedin.com/in/priyasharma'],

            // ── Family Office (3) ─────────────────────────────────────────
            ['name'=>'Mehedi Hassan','email'=>'mehedi@rahimgroup.com','org'=>'Rahim Group Family Office','designation'=>'Investment Manager','type'=>'family_office','stage'=>'growth','min'=>'20000000','max'=>'150000000','sectors'=>['FinTech','CleanTech','AgriTech'],'risk'=>'conservative','bio'=>'Managing the investment portfolio of the Rahim Group family office. Focuses on growth-stage companies with strong fundamentals and clear path to profitability.','linkedin'=>'https://linkedin.com/in/mehehassan'],
            ['name'=>'Zara Khan','email'=>'zara@khanfamily.com','org'=>'Khan Family Investments','designation'=>'Principal','type'=>'family_office','stage'=>'series_a','min'=>'10000000','max'=>'50000000','sectors'=>['HealthTech','EdTech'],'risk'=>'moderate','bio'=>'Principal at Khan Family Investments, a $200M family office. Second-generation investor with focus on healthcare and education. Board member of 4 portfolio companies.','linkedin'=>'https://linkedin.com/in/zarakhan'],
            ['name'=>'Omar Faruk','email'=>'omar@islamigroup.com','org'=>'Islami Group Holdings','designation'=>'Director of Investments','type'=>'family_office','stage'=>'seed','min'=>'5000000','max'=>'25000000','sectors'=>['AgriTech','CleanTech'],'risk'=>'moderate','bio'=>'Director of Investments at Islami Group Holdings. Focuses on halal-compliant investment structures. Particular interest in food security and renewable energy.','linkedin'=>'https://linkedin.com/in/omarfaruk'],

            // ── Impact Investors (3) ──────────────────────────────────────
            ['name'=>'Dilruba Akter','email'=>'dilruba@impactbd.com','org'=>'Impact Bangladesh Fund','designation'=>'Fund Manager','type'=>'impact','stage'=>'seed','min'=>'2000000','max'=>'10000000','sectors'=>['HealthTech','AgriTech','CleanTech'],'risk'=>'moderate','bio'=>'Fund Manager at Impact Bangladesh, a $15M impact fund backed by international DFIs. Focuses on startups with measurable social and environmental outcomes alongside financial returns.','linkedin'=>'https://linkedin.com/in/dilrubaakter'],
            ['name'=>'Sabbir Chowdhury','email'=>'sabbir@socialventures.com','org'=>'Social Ventures Bangladesh','designation'=>'CEO & Lead Investor','type'=>'impact','stage'=>'pre_seed','min'=>'500000','max'=>'3000000','sectors'=>['EdTech','HealthTech'],'risk'=>'aggressive','bio'=>'CEO of Social Ventures Bangladesh. Invests in early-stage social enterprises. Has supported 30+ ventures improving lives of low-income communities across Bangladesh.','linkedin'=>'https://linkedin.com/in/sabbirchowdhury'],
            ['name'=>'Nasrin Sultana','email'=>'nasrin@womenimpact.com','org'=>'Women Impact Fund','designation'=>'Managing Partner','type'=>'impact','stage'=>'seed','min'=>'1000000','max'=>'8000000','sectors'=>['FinTech','EdTech','HealthTech'],'risk'=>'moderate','bio'=>'Managing Partner of Women Impact Fund, focused on female-led startups and ventures improving women\'s economic empowerment. Portfolio of 20 companies across South Asia.','linkedin'=>'https://linkedin.com/in/nasrinsultana'],
        ];

        foreach ($investors as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name'              => $data['name'],
                    'password'          => Hash::make('password'),
                    'status'            => 'active',
                    'email_verified_at' => now(),
                ]
            );

            if (!$user->hasRole('investor')) {
                $user->assignRole('investor');
            }

            InvestorProfile::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'investor_type'       => $data['type'],
                    'organization'        => $data['org'],
                    'designation'         => $data['designation'],
                    'sector_preferences'  => $data['sectors'],
                    'ticket_size_min'     => $data['min'],
                    'ticket_size_max'     => $data['max'],
                    'investment_stage'    => $data['stage'],
                    'risk_profile'        => $data['risk'],
                    'bio'                 => $data['bio'],
                    'linkedin_url'        => $data['linkedin'],
                    'verification_status' => 'verified',
                    'profile_completion'  => 90,
                    'is_visible'          => true,
                ]
            );
        }
    }
}
