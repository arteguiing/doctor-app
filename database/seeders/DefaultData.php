<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Seeder;

class DefaultData extends Seeder
{
    private $user;

    public function run()
    {
        $this->user = User::create([
            'name' => 'AR Tegui-ing',
            'email' => 'ar@gmail.com',
            'password' => 'password',
            'email_verified_at' => now(),
            'role' => 'doctor',
        ]);

        $this->createLocations();
        $this->createPatients();
        $this->createReceptionists();

        // Patient::factory(50)->create();
    }

    private function createLocations()
    {
        Location::create([
            'name' => 'DEMO',
            'short_address' => 'Makati',
            'type' => 'HOSPITAL',
        ]);

        Location::create([
            'name' => 'DEMO@',
            'short_address' => 'Taguig',
            'type' => 'HOSPITAL',
        ]);

        Location::create([
            'name' => 'DEMO CLINIC',
            'short_address' => 'Isabela',
            'type' => 'HOSPITAL',
        ]);
    }

    public function createPatients()
    {
        Patient::create([
            'patient_id' => '20211001',
            'name' => 'Patient1',
            'phone_number' => '639567118873',
            'location' => 'Makati',
            'year_of_birth' => 1985,
            'weight' => 85,
            'visit_count' => 5,
        ])->appointments()->create([
            'date' => now()->format('Y-m-d'),
            'type' => 'Visit',
            'location_id' => 1,
        ]);

        Patient::create([
            'patient_id' => '20211002',
            'name' => 'Patient2',
            'phone_number' => '639567118873',
            'location' => 'Makati',
            'year_of_birth' => 1975,
            'weight' => 70,
            'visit_count' => 2,
        ])->appointments()->create([
            'date' => now()->format('Y-m-d'),
            'type' => 'Visit',
            'location_id' => 1,
        ]);

        Patient::create([
            'patient_id' => '20211003',
            'name' => 'Patient3',
            'phone_number' => '639567118873',
            'location' => 'Taguig',
            'year_of_birth' => 1995,
            'weight' => 55,
            'visit_count' => 1,
        ])->appointments()->create([
            'date' => now()->format('Y-m-d'),
            'type' => 'Visit',
            'location_id' => 1,
        ]);

        $nikhil = Patient::create([
            'patient_id' => '20211004',
            'name' => 'Patient4',
            'phone_number' => '639567118873',
            'location' => 'Q.C',
            'year_of_birth' => 1999,
            'weight' => 55,
            'visit_count' => 3,
        ]);
        $nikhil->appointments()->create([
            'date' => now()->subDays(7)->format('Y-m-d'),
            'type' => 'Visit',
            'location_id' => 1,
        ])->visit()->create([
            'patient_id' => $nikhil->id,
            'problems' => 'Fever, cough and cold',
            'prescription' => 'Some medicine',
            'is_complete' => 1,
        ]);
        $nikhil->appointments()->create([
            'date' => now()->subDays(5)->format('Y-m-d'),
            'type' => 'Follow up',
            'location_id' => 1,
        ])->visit()->create([
            'patient_id' => $nikhil->id,
            'problems' => 'Fever, cough and cold',
            'prescription' => 'Some medicine',
            'is_complete' => 1,
        ]);
        $nikhil->appointments()->create([
            'date' => now()->format('Y-m-d'),
            'type' => 'Follow up',
            'location_id' => 1,
        ])->visit()->create([
            'patient_id' => $nikhil->id,
            'problems' => 'Fever, cough and cold',
            'prescription' => 'Some medicine',
            'is_complete' => 1,
        ]);
    }

    private function createReceptionists()
    {
        $loc1 = Location::find(1);
        $loc2 = Location::find(2);
        User::create([
            'name' => 'Jhon Doe',
            'email' => 'jhondoe@gmail.com',
            'password' => 'password',
            'email_verified_at' => now(),
        ])->location()->attach($loc1);

        User::create([
            'name' => 'Jane Doe',
            'email' => 'jane@gmail.com',
            'password' => 'password',
            'email_verified_at' => now(),
        ])->location()->attach($loc2);
    }
}
