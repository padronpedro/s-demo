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

            Patrick has previously provided communication advice for, among others, TDC, the Road Directorate, the Capital Region of Denmark, Google, the City of Copenhagen, the Prison and Probation Service and the Pharmaceutical Industry Association. Due to Patrick\'s role as a partner in Signifly, he has decision-making skills at all levels of the company, including contracts, customer relationships and resource allocation.', 'phone' => '+45 4031 2498', 'picture'=>'plr.jpg'],
            ['name' => 'MADS KJÆRGAARD', 'email' => 'mk@signifly.com', 'position' =>'Consultant', 'description' => 'Mads joined Signifly in early 2016. Bringing strong business understanding and strategic thinking to the table, his strengths lie in helping clients improve their business with digital technology.

            Mads holds a PBA in International Sales and Marketing Management

            Mads was recently responsible for the launch of the new e-commerce platform for Mads Nørgaard, and his most prominent projects at Signifly include work for Novo Nordisk, Leo Pharma and Innovation Center Denmark.

            When not at his desk, Mads is probably cross-fit training at the gym', 'phone' => '+45 2785 1529', 'picture'=>'mk.jpg'],
            ['name' => 'NICKLAS RØNNING', 'email' => 'nr@signifly.com', 'position' => 'Managing Director, Canada', 'description'=> 'Nicklas is responsible for our continuous expansion to new markets, currently working to develop the North American market, by building a capable digital innovation team in Montreal. Nicklas has been pivotal in the opening of our office in Montreal, where he\'s also Managing Director. Besides running our office Canada office, Nicklas assists our clients and partners in Digital Transformation, Marketing and Sales strategies. Both areas of expertise he honed from his previous position as Sales Manager at IT Minds.

            Nicklas holds a Master\'s degree in Management of Innovation and Business Development from Copenhagen Business School.', 'phone' => '+1 (438) 866-1336', 'picture'=>'nr.jpg'],
            ['name' => 'SARA FRIIS BACHE', 'email' => 'sb@signifly.com', 'position' => 'Innovation Lead', 'description'=> 'Sara started her Signifly journey at the beginning of 2019 and made an immediate impact with her vast and extensive experience within IT project management and management consulting. She is a true planning worrier, scheduling the project processes in close collaboration with our clients and is known for her ability to enforce the internal timelines with a firm hand and a big smile.', 'phone' => '+45 4093 8119', 'picture'=>'sb.jpg'],
            ['name' => 'SIGNE HARRING HANSEN', 'email' => 'shh@signifly.com', 'position' => 'Innovation Lead', 'description'=> 'Signe joined Signifly at the brink of 2019. Signe is great at execution and loves paying attention to even the smallest details, to ensure the highest quality of her projects. Working as an Innovation Lead she thrives working with tasks related to complex digital solutions and webshops with multiple layers and integrations. Her greatest passion is to ensure, that the clients wishes are translated into functionality online.', 'phone' => '+45 3121 0821', 'picture'=>'shh.jpg'],
            ['name' => 'ALEXANDER SPLIID', 'email' => 'as@signifly.com', 'position' => 'Partner & Head of Design', 'description'=> 'Alexander is partner at Signifly and visual cornerstone in our trio of founders. Being the Head of design, Alexander is a versatile as they come. Having the ability to always think the big picture in terms of design, brand and business. This enables him to constantly push the limits of how visual communication can influence behaviour and build strong and honest brands.', 'phone' => '+45 2276 5174', 'picture'=>'as.jpg'],
            ['name' => 'TORE HEIMANN', 'email' => 'th@signifly.com', 'position' => 'Technical Team Lead', 'description'=> 'He does all this while assisting our clients and advising them on technology and its possibilities. Being a former developer himself makes him the ideal link between tech and people, and has a way of communicating the complex world of tech in a language everybody understands.', 'phone' => '+45 2620 9049', 'picture'=>'th.jpg'],
            ['name' => 'NANA SKAK', 'email' => 'ns@signifly.com', 'position' => 'Film Team Lead & Producer', 'description'=> 'Nana joined Signifly in the summer of 2016 and is the project manager on our films. She\'s a driving force in pushing projects forward and making great things happen. Her responsibilities often include planning, project economy, pre-production and client relations.', 'phone' => '+45 2887 1881', 'picture'=>'ns.jpg'],
        ]);
    }
}

