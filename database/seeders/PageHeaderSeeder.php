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
                'title' => 'About Us',
                'subtitle' => 'Transforming lives through faith, mentorship, and holistic empowerment.',
            ],
            [
                'page_key' => 'programs',
                'label' => 'Our Programs',
                'title' => 'Our Programs',
                'subtitle' => 'School outreaches, empowerment, and capacity building for lasting impact.',
            ],
            [
                'page_key' => 'testimonials',
                'label' => 'Testimonials',
                'title' => 'Our Testimonials',
                'subtitle' => 'Stories of transformation from the communities we serve.',
            ],
            [
                'page_key' => 'events',
                'label' => 'Upcoming Events',
                'title' => 'Upcoming Events',
                'subtitle' => 'Join us at our next outreach, conference, or community gathering.',
            ],
            [
                'page_key' => 'updates',
                'label' => 'Recent Updates',
                'title' => 'Recent Updates',
                'subtitle' => 'News and stories from Impact Life Mission.',
            ],
            [
                'page_key' => 'team',
                'label' => 'Our Team',
                'title' => 'Our Team',
                'subtitle' => 'Meet the people behind Impact Life Mission.',
            ],
            [
                'page_key' => 'gallery',
                'label' => 'Gallery',
                'title' => 'Gallery',
                'subtitle' => 'Moments from our outreaches, programs, and community impact.',
            ],
            [
                'page_key' => 'contact',
                'label' => 'Contact',
                'title' => 'Contact Us',
                'subtitle' => 'We would love to hear from you — partner, volunteer, or pray with us.',
            ],
            [
                'page_key' => 'program_detail',
                'label' => 'Program Detail (default)',
                'title' => 'Our Programs',
                'subtitle' => 'Learn more about this Impact Life Mission program.',
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
