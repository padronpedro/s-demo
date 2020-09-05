<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('member_project')->truncate();
        DB::table('members')->truncate();
        DB::table('members')->insert([
            ['name' => 'PATRICK RØNNING', 'email' => 'plr@signifly.com', 'position' =>'Partner & Brand Strategist', 'description' => 'As a founding partner of Signifly, Patrick has many years of experience in strategic communication, personnel management and the creation of a large network and collaboration with a wide range of partners and customers, public as well as private. During his time at Signifly, Patrick has run projects of all sizes from the idea phase to a successful execution and implementation.

            Patrick holds a bachelor degree in Business Administration & Organisational Communication and a master degree in Business Administration & Organisational Communication from Copenhagen Business School.

            Patrick has previously provided communication advice for, among others, TDC, the Road Directorate, the Capital Region of Denmark, Google, the City of Copenhagen, the Prison and Probation Service and the Pharmaceutical Industry Association. Due to Patrick\'s role as a partner in Signifly, he has decision-making skills at all levels of the company, including contracts, customer relationships and resource allocation.', 'phone' => '+45 4031 2498', 'picture'=>''],
            ['name' => 'MADS KJÆRGAARD', 'email' => 'mk@signifly.com', 'position' =>'Consultant', 'description' => 'Mads joined Signifly in early 2016. Bringing strong business understanding and strategic thinking to the table, his strengths lie in helping clients improve their business with digital technology.

            Mads holds a PBA in International Sales and Marketing Management

            Mads was recently responsible for the launch of the new e-commerce platform for Mads Nørgaard, and his most prominent projects at Signifly include work for Novo Nordisk, Leo Pharma and Innovation Center Denmark.

            When not at his desk, Mads is probably cross-fit training at the gym', 'phone' => '+45 2785 1529', 'picture'=>''],
            ['name' => 'NICKLAS RØNNING', 'email' => 'nr@signifly.com', 'position' => 'Managing Director, Canada', 'description'=> 'Nicklas is responsible for our continuous expansion to new markets, currently working to develop the North American market, by building a capable digital innovation team in Montreal. Nicklas has been pivotal in the opening of our office in Montreal, where he\'s also Managing Director. Besides running our office Canada office, Nicklas assists our clients and partners in Digital Transformation, Marketing and Sales strategies. Both areas of expertise he honed from his previous position as Sales Manager at IT Minds.

            Nicklas holds a Master\'s degree in Management of Innovation and Business Development from Copenhagen Business School.', 'phone' => '+1 (438) 866-1336', 'picture'=>''],
        ]);
    }
}

