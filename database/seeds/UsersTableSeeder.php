<?php
use Illuminate\Database\Seeder;
use App\Role;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //bcrypt
        $admin = Role::where('slug','admin')->first();
        $user = Role::where('slug','user')->first();
        $guard = Role::where('slug','guard')->first();
        factory(App\User::class, 1)->create([
       		'name' => '万文峰',
       		'email' => 'whevether@qq.com',
       		'password' => bcrypt('E1w>l}g4=6r%'),
            'iphone'    => '13265616949',
            'address' => '江西省宜春市靖安县',
            'sex'   => '先生',
       	])->each(function ($u) use ($admin){
            $u->attachRole($admin);
        });
        factory(App\User::class, 1)->create([
            'name' => '万运彩',
       		'email' => 'user@qq.com',
            'iphone'    => '13755869377',
            'address' => '江西省宜春市靖安县',
            'sex'   => '先生',
            'password' => bcrypt('123456')
        ])->each(function ($u) use ($user){
            $u->attachRole($user);
        });
        factory(App\User::class, 1)->create([
            'name' => '游客',
       		'email' => 'test@qq.com',
            'iphone'    => '13823188750',
            'address' => '江西省九江市修水县',
            'sex'   => '女士',
            'password' => bcrypt('123456')
        ])->each(function ($u) use ($guard){
            $u->attachRole($guard);
        });
    }
}
