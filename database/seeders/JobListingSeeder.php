<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobListing;
use App\Models\User;

class JobListingSeeder extends Seeder
{
    public function run()
    {
        // Get the admin user
        $admin = User::where('email', 'superadmin@hauzhayag.com')->first();

        $jobs = [
            [
                'title' => 'Senior Software Developer',
                'company_name' => 'Tech Solutions Inc.',
                'description' => 'We are looking for an experienced software developer to join our team. The ideal candidate should have strong problem-solving skills and experience with modern web technologies.',
                'role' => 'Software Developer',
                'qualifications' => "• Bachelor's degree in Computer Science or related field\n• 5+ years of experience in software development\n• Strong knowledge of PHP, JavaScript, and MySQL\n• Experience with Laravel framework\n• Excellent communication skills",
                'employment_type' => 'Full-time',
                'location' => 'New York, NY',
                'salary_min' => 90000,
                'salary_max' => 120000,
                'contact_person' => 'John Smith',
                'contact_email' => 'jobs@techsolutions.com',
                'contact_phone' => '555-0123',
                'status' => 'approved',
                'is_admin_posted' => true,
                'posted_by' => $admin->id,
                'expires_at' => now()->addMonths(2),
            ],
            [
                'title' => 'Marketing Manager',
                'company_name' => 'Global Marketing Group',
                'description' => 'Join our dynamic marketing team as a Marketing Manager. You will be responsible for developing and implementing marketing strategies to promote our products and services.',
                'role' => 'Marketing Manager',
                'qualifications' => "• Bachelor's degree in Marketing or related field\n• 3+ years of marketing experience\n• Strong project management skills\n• Experience with digital marketing tools\n• Creative thinking and problem-solving abilities",
                'employment_type' => 'Full-time',
                'location' => 'Remote',
                'salary_min' => 75000,
                'salary_max' => 95000,
                'contact_person' => 'Sarah Johnson',
                'contact_email' => 'careers@globalmarketing.com',
                'contact_phone' => '555-0124',
                'status' => 'approved',
                'is_admin_posted' => true,
                'posted_by' => $admin->id,
                'expires_at' => now()->addMonths(1),
            ],
            [
                'title' => 'Data Analyst Intern',
                'company_name' => 'Data Insights Co.',
                'description' => 'We are offering an exciting internship opportunity for aspiring data analysts. This position will provide hands-on experience with real-world data analysis projects.',
                'role' => 'Data Analyst',
                'qualifications' => "• Currently pursuing a degree in Statistics, Mathematics, or related field\n• Basic knowledge of SQL and Python\n• Strong analytical skills\n• Attention to detail\n• Good communication skills",
                'employment_type' => 'Internship',
                'location' => 'Boston, MA',
                'salary_min' => 20,
                'salary_max' => 25,
                'contact_person' => 'Michael Brown',
                'contact_email' => 'internships@datainsights.com',
                'contact_phone' => '555-0125',
                'status' => 'approved',
                'is_admin_posted' => true,
                'posted_by' => $admin->id,
                'expires_at' => now()->addMonths(3),
            ],
        ];

        foreach ($jobs as $job) {
            JobListing::create($job);
        }
    }
} 