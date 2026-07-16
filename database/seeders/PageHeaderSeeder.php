<?php

namespace Database\Seeders;

use App\Models\PageHeader;
use Illuminate\Database\Seeder;

class PageHeaderSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'page_key' => 'about',
                'label' => 'Who We Are (About Us)',
                'title' => 'Rooted in faith. Built for dignity.',
                'subtitle' => 'A youth-focused Christian mission transforming lives through mentorship, skills, and community empowerment in Rwanda.',
            ],
            [
                'page_key' => 'programs',
                'label' => 'Our Programs',
                'title' => 'Where hope becomes a pathway',
                'subtitle' => 'School outreaches, young mothers empowerment, and leadership development that restore purpose.',
            ],
            [
                'page_key' => 'testimonials',
                'label' => 'Testimonials',
                'title' => 'Voices of restored hope',
                'subtitle' => 'Real stories from mothers, students, and communities walking with us.',
            ],
            [
                'page_key' => 'events',
                'label' => 'Upcoming Events',
                'title' => 'Gather. Grow. Go together.',
                'subtitle' => 'Outreaches, trainings, and gatherings where faith meets action.',
            ],
            [
                'page_key' => 'updates',
                'label' => 'Recent Updates',
                'title' => 'Moments from the mission field',
                'subtitle' => 'News, highlights, and progress from Impact Life Mission.',
            ],
            [
                'page_key' => 'team',
                'label' => 'Our Team',
                'title' => 'People behind the promise',
                'subtitle' => 'Leaders, mentors, and advisors committed to seeing young lives thrive.',
            ],
            [
                'page_key' => 'gallery',
                'label' => 'Image Gallery',
                'title' => 'Life in every frame',
                'subtitle' => 'Training rooms, school visits, packages delivered, and joy restored.',
            ],
            [
                'page_key' => 'videos',
                'label' => 'Video Gallery',
                'title' => 'Stories in motion',
                'subtitle' => 'Watch young mothers, youth, and communities walk toward dignity and hope.',
            ],
            [
                'page_key' => 'contact',
                'label' => 'Contact',
                'title' => 'Let’s build hope together',
                'subtitle' => 'Partner, volunteer, pray, or ask how you can walk with young mothers and youth.',
            ],
            [
                'page_key' => 'get_involved',
                'label' => 'Get Involved',
                'title' => 'Your next step matters',
                'subtitle' => 'Give, serve, partner, or pray—help young mothers rebuild with dignity.',
            ],
            [
                'page_key' => 'program_detail',
                'label' => 'Program Detail (default)',
                'title' => 'A closer look at our work',
                'subtitle' => 'Practical skills, mentorship, and faith that unlock lasting change.',
            ],
            [
                'page_key' => 'mothers',
                'label' => 'Mothers Program',
                'title' => 'Empowered Mothers, Transformed Communities',
                'subtitle' => 'Meet the inspiring mothers and discover how you can support their journey.',
            ],
        ];

        foreach ($pages as $page) {
            PageHeader::updateOrCreate(
                ['page_key' => $page['page_key']],
                $page
            );
        }
    }
}
