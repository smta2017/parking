<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class SubscripeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subs =  [
            [
                'amount' => 500,
                'phone' => '01006634686',
                'name' => 'عصام عبد الحميد بكرى',
                'plate' => '614طفط'
            ],
            [
                'amount' => 500,
                'phone' => '01006634686',
                'name' => 'هناء عصام عبد الحميد',
                'plate' => '461سسج'
            ],
            [
                'amount' => 400,
                'phone' => '01280133340',
                'name' => 'إبراهيم بطرس ميخائيل',
                'plate' => '354ىجن'
            ],
            [
                'amount' => 400,
                'phone' => '01222163439',
                'name' => 'عمرو محمد سعد',
                'plate' => '3472أطن'
            ],
            [
                'amount' => 400,
                'phone' => '01114535880',
                'name' => 'طه الجوهرى',
                'plate' => '123قنب'
            ],
            [
                'amount' => 400,
                'phone' => '01114535880',
                'name' => 'طه الجوهرى',
                'plate' => '835رلق'
            ],
            [
                'amount' => 500,
                'phone' => '01063649444',
                'name' => 'أحمد محمد عبد اللطيف',
                'plate' => '687صصل'
            ],
            [
                'amount' => 500,
                'phone' => '0115543663',
                'name' => 'مينا مدحت كمال',
                'plate' => '943مدع'
            ],
            [
                'amount' => 500,
                'phone' => '01117888636',
                'name' => 'إسلام مدحت',
                'plate' => '5742أصل'
            ],
            [
                'amount' => 500,
                'phone' => '01220416133',
                'name' => 'خالد محمد حمد',
                'plate' => 'بدون'
            ],
            [
                'amount' => 500,
                'phone' => '01224574004',
                'name' => 'رضا إسماعيل محمد',
                'plate' => '826نجن'
            ],
            [
                'amount' => 300,
                'phone' => '01001377769',
                'name' => 'أمجد سامى خطاب',
                'plate' => '715وطأ'
            ],
            [
                'amount' => 300,
                'phone' => '01001377769',
                'name' => 'أمجد سامى خطاب',
                'plate' => '736مهع'
            ],
            [
                'amount' => 400,
                'phone' => '01017602486',
                'name' => 'أحمد خالد',
                'plate' => '548ألل'
            ],
            [
                'amount' => 400,
                'phone' => '01002559819',
                'name' => 'نورا جمال إبراهيم',
                'plate' => '587ىجو'
            ],
            [
                'amount' => 400,
                'phone' => '01002559819',
                'name' => 'أحمد جمال إبراهيم',
                'plate' => '758بمع'
            ],
            [
                'amount' => 400,
                'phone' => '01002559819',
                'name' => 'جمال إبراهيم',
                'plate' => '791وطى'
            ],
            [
                'amount' => 400,
                'phone' => '01121593101',
                'name' => 'عمر محمد محجوب',
                'plate' => '1879أعى'
            ],
            [
                'amount' => 400,
                'phone' => '01228235267',
                'name' => 'محمد صلاح حسن',
                'plate' => '6462سجم'
            ],
            [
                'amount' => 350,
                'phone' => '01222910443',
                'name' => 'أحمد محمد سعيد',
                'plate' => '398ىمه'
            ],
            [
                'amount' => 400,
                'phone' => '01095999890',
                'name' => 'م ح م د م ر ت ىض',
                'plate' => '1857أقه'
            ],
            [
                'amount' => 400,
                'phone' => '01023827277',
                'name' => 'محمد نجاح الدمرا ىن',
                'plate' => '362دعن'
            ],
            [
                'amount' => 400,
                'phone' => '01005436662',
                'name' => 'محمد السيد',
                'plate' => '1693ألف'
            ],
            [
                'amount' => 200,
                'phone' => '01551363436',
                'name' => 'أمينة عبد المجيد',
                'plate' => 'no'
            ],
            [
                'amount' => 400,
                'phone' => '01099292141',
                'name' => 'أحمد محمد إمام',
                'plate' => '584عبه'
            ],
            [
                'amount' => 300,
                'phone' => '0127355760',
                'name' => 'سامح شعبان',
                'plate' => '358حسص'
            ],
            [
                'amount' => 500,
                'phone' => '01225585644',
                'name' => 'شيماء عبد العزيز',
                'plate' => '739ىعج'
            ],
            [
                'amount' => 450,
                'phone' => '01112575975',
                'name' => 'محمد ال رشبي ىن',
                'plate' => '9714أعه'
            ],
            [
                'amount' => 500,
                'phone' => '01222202305',
                'name' => 'ها ىن الدسو رق',
                'plate' => '314ىعع'
            ],
            [
                'amount' => 500,
                'phone' => '01223412080',
                'name' => 'محمد ها ىن الدسو رق',
                'plate' => '967هبك'
            ],
            [
                'amount' => 500,
                'phone' => '01222202305',
                'name' => 'ها ىن الدسو رق',
                'plate' => '285ىقأ'
            ],
            [
                'amount' => 500,
                'phone' => '0106568856',
                'name' => 'رشيفعلىحس ىي',
                'plate' => '469بقع'
            ],
            [
                'amount' => 400,
                'phone' => '01022802370',
                'name' => 'إيهاب ممدوح',
                'plate' => '815هىس'
            ],
            [
                'amount' => 500,
                'phone' => '01226267231',
                'name' => 'رضوى على عبد الحليم',
                'plate' => '9278أعه'
            ],
            [
                'amount' => 450,
                'phone' => '01126390896',
                'name' => 'منتطارقمنت',
                'plate' => '1246أعف'
            ],
            [
                'amount' => 500,
                'phone' => '01005009313',
                'name' => 'علاء الزنا رن',
                'plate' => '9125مصق'
            ],
            [
                'amount' => 500,
                'phone' => '01005009313',
                'name' => 'علاء الزنا رن',
                'plate' => '126مفن'
            ],
            [
                'amount' => 500,
                'phone' => '01223407675',
                'name' => 'تيست عبد العال',
                'plate' => '162طسه'
            ],
            [
                'amount' => 500,
                'phone' => '01223407675',
                'name' => 'تيست عبد العال',
                'plate' => '712بقن'
            ],
            [
                'amount' => 500,
                'phone' => '01223407675',
                'name' => 'تيست عبد العال',
                'plate' => '617سىأ'
            ],
            [
                'amount' => 500,
                'phone' => '01222293959',
                'name' => 'ناىجنبيلابانوب',
                'plate' => '6344وم'
            ],
            [
                'amount' => 500,
                'phone' => '01158729085',
                'name' => 'جمال محمد جميل',
                'plate' => '627نأع'
            ],
            [
                'amount' => 300,
                'phone' => '1222696240',
                'name' => 'باهر عجمى محمود',
                'plate' => '492طدط'
            ],
            [
                'amount' => 300,
                'phone' => '1222696240',
                'name' => 'باهر عجمى محمود',
                'plate' => '216أطع'
            ],
            [
                'amount' => 300,
                'phone' => '01222696240',
                'name' => 'باهر عجمى محمود',
                'plate' => '978مرع'
            ],
            [
                'amount' => 300,
                'phone' => '01222696240',
                'name' => 'باهر عجمى محمود',
                'plate' => '398دلق'
            ],
            [
                'amount' => 300,
                'phone' => '01222696240',
                'name' => 'باهر عجمى محمود',
                'plate' => '1258ققأ'
            ],
            [
                'amount' => 380,
                'phone' => '01222174430',
                'name' => 'نبيل عدلى',
                'plate' => '9758أرم'
            ],
            [
                'amount' => 500,
                'phone' => '01003092608',
                'name' => 'إسلام محمد',
                'plate' => '652ولن'
            ],
            [
                'amount' => 500,
                'phone' => '0127655396',
                'name' => 'رضوى سعيد عبد الرحمن',
                'plate' => '3759أعى'
            ],
            [
                'amount' => 500,
                'phone' => '01222317492',
                'name' => 'متفت سوريان',
                'plate' => '984قوو'
            ],
            [
                'amount' => 400,
                'phone' => '01203777820',
                'name' => 'وائل فيصل عبد الله',
                'plate' => '4679أقج'
            ],
            [
                'amount' => 400,
                'phone' => '01098978602',
                'name' => 'مصطىفعباس',
                'plate' => '823هجو'
            ],
            [
                'amount' => 400,
                'phone' => '01287441444',
                'name' => 'جمال كامل',
                'plate' => '895ملأ'
            ],
            [
                'amount' => 400,
                'phone' => '01001935888',
                'name' => 'أحمد جمال',
                'plate' => '247مرل'
            ],
            [
                'amount' => 400,
                'phone' => '01093534042',
                'name' => 'بشوى',
                'plate' => '2354طصف'
            ],
            [
                'amount' => 500,
                'phone' => '0122613366',
                'name' => 'على',
                'plate' => '8145رلف'
            ],
            [
                'amount' => 500,
                'phone' => '01223165365',
                'name' => 'يشى كامل',
                'plate' => '926نأط'
            ],
            [
                'amount' => 400,
                'phone' => '01223127038',
                'name' => 'مجدى طلعت',
                'plate' => '251لمأ'
            ],
            [
                'amount' => 400,
                'phone' => '01223127038',
                'name' => 'مجدى طلعت',
                'plate' => '8546أصم'
            ],
            [
                'amount' => 500,
                'phone' => '01002818201',
                'name' => 'محمدعلىحس ىي',
                'plate' => '521قعط'
            ],
            [
                'amount' => 400,
                'phone' => '01001616364',
                'name' => 'ها ىن محمد على',
                'plate' => '8351أصم'
            ],
            [
                'amount' => 400,
                'phone' => '0100246004',
                'name' => 'دعاء محمد',
                'plate' => '8274رفق'
            ],
            [
                'amount' => 500,
                'phone' => '01551691004',
                'name' => 'رى معت',
                'plate' => '9378أسو'
            ],
            [
                'amount' => 500,
                'phone' => '01551691004',
                'name' => 'رى معت',
                'plate' => '815دنق'
            ],
            [
                'amount' => 400,
                'phone' => '0100433550',
                'name' => 'أحمد قدرى حسن',
                'plate' => '546مقب'
            ],
            [
                'amount' => 400,
                'phone' => '01223434350',
                'name' => 'إيمان احمد قدرى',
                'plate' => '169بله'
            ],
            [
                'amount' => 400,
                'phone' => '01210591647',
                'name' => 'مينا سليمان عوض',
                'plate' => '679نلى'
            ],

            [
                'amount' => 400,
                'phone' => '01222168280',
                'name' => 'أحمد عز الدين',
                'plate' => '4375أقج'
            ],
            [
                'amount' => 400,
                'phone' => '01225001797',
                'name' => 'حس ىيسيدمحمد',
                'plate' => '951ططأ'
            ],
            [
                'amount' => 500,
                'phone' => '01060277081',
                'name' => 'هوايدا إبراهيم دسو رق',
                'plate' => '653835'
            ],
            [
                'amount' => 500,
                'phone' => '01100959911',
                'name' => 'رشيف ذكريا سعد',
                'plate' => '2198أقس'
            ],
            [
                'amount' => 500,
                'phone' => '01227691771',
                'name' => 'طارق رشيفذكريا',
                'plate' => '327__'
            ],
            [
                'amount' => 500,
                'phone' => '01114860044',
                'name' => 'مهافوزىجىت',
                'plate' => '7194أرم'
            ],
            [
                'amount' => 500,
                'phone' => '01277634190',
                'name' => 'نجيب محمد نجيب',
                'plate' => '865بمس'
            ],
            [
                'amount' => 500,
                'phone' => '01001111404',
                'name' => 'محمد اسامة الخولى',
                'plate' => '235طهه'
            ],
            [
                'amount' => 500,
                'phone' => '01029696211',
                'name' => 'محمد عبدالبصت حسان',
                'plate' => '479ىمه'
            ],
            [
                'amount' => 400,
                'phone' => '01273766008',
                'name' => 'شمس الدين محمد أ رشف',
                'plate' => '862دوو'
            ],
            [
                'amount' => 400,
                'phone' => '01010970973',
                'name' => 'محمد فهمى على',
                'plate' => '6743ألن'
            ],
            [
                'amount' => 400,
                'phone' => '01069743144',
                'name' => 'رشيف',
                'plate' => '7346سىج'
            ],
        ];

        foreach ($subs as $sub) {
            $plan = app('rinvex.subscriptions.plan')->find(1);

            $customer =  User::create(['name' => $sub['name'], 'password' => '0', 'phone' => $sub['phone'], 'is_customer' => 1]);

            $new_subscription = $customer->newSubscription($customer['name'] . '-' . $plan['name'], $plan);

            // return $this->sendResponse($new_subscription, 'Subscription created as successfully');
        }
    }
}