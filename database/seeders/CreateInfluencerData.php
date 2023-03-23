<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Account;
use App\Models\SocialInfo;
use App\Models\AudienceData;
use App\Models\Services;
use App\Models\Credential;

class CreateInfluencerData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $influencer = [
            'account' => [
                'role_id' => Account::ROLE_INFLUENCER,
                'username' => 'ajinomotor',
                'password' => '@bc12354',
                'verified' => true,
            ],
            'credentials' => [
                'gender' => 'female',
                'phone_number' => '0909101222',
                'address_line1' => '18/3B Nui Thanh',
                'address_line2' => '001',
                'address_line3' => '001',
                'address_line4' => '001',
                'ward_code' => '00006',
                'nickname' => 'ajinomotor',
                'industry' => 'Sample',
                'content_topic' => 'Sample',
                'job' => 'Tiktoker',
                'booking_price' => '2500000',
                'experiences' => 'Live stream',
                'website' => 'Sample.com',
                'title_for_job' => 'Sample',
                'description' => 'Sample',
                'brand_name' => 'Sample',
            ],
            'socials' => [
                'name' => 'Sample',
                'username' => 'Sample',
                'fullname' => 'Sample',
                'avg_interactions' => 100,
                'link' => 'sample.tiktok.com',
                'subcribers' => 1000
            ],
            'audiences' => [
                'female' => 50,
                'male' => 25,
                'others' => 15,
                'city1' => 15,
                'city2' => 50,
                'city3' => 10,
                'city4' => 15,
                'age1' => 50,
                'age2' => 10,
                'age3' => 50,
                'age4' => 15
            ],
            'services' => [
                'name' => 'SOS',
                'description' => 'S o S'
            ]
        ];

        $count = 1;
        do {
            dump("Start");
            $influencer['account']['email'] = 'hoai.ngo23+' . $count . '@student.passerellesnumeriques.org';
            $account = Account::create($influencer['account']);

            $influencer['credentials']['account_id'] = $account->id;
            Credential::create($influencer['account']);

            $influencer['socials']['account_id'] = $account->id;
            SocialInfo::create($influencer['socials']);

            $influencer['audiences']['account_id'] = $account->id;
            AudienceData::create($influencer['audiences']);

            $influencer['services']['account_id'] = $account->id;
            Services::create($influencer['services']);

            $count += 1;
            dump("Already created a record: " . $count);
        } while ($count < 50);
    }
}
