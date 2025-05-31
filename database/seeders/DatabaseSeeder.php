<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\CareLevel;
use App\Models\Employee;
use App\Models\Client;
use App\Models\Person;
use App\Models\Group;
use App\Models\SessionHistories;
use App\Models\ClientSession;
use App\Models\SessionStaff;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create default user
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
            ]
        );

        // 2. Seed care levels
        CareLevel::insert([
            ['level' => 'RTC', 'required_hours' => 100],
            ['level' => 'PHP', 'required_hours' => 60],
            ['level' => 'IOP', 'required_hours' => 30],
        ]);

        // 3. Create 20 people
        $people = collect();
        for ($i = 1; $i <= 20; $i++) {
            $people->push(Person::create([
                'first_name' => "Person{$i}",
                'last_name' => 'Example',
                'gender' => 'Other',
                'active' => true,
                'phone' => '555-000' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'email' => "person{$i}@example.com",
            ]));
        }

       // 4. Assign first 3 people as employees
        $employees = collect();
        $employeePeople = $people->take(3)->values(); // ensure proper numeric indexing
        foreach ($employeePeople as $i => $person) {
            $employees->push(Employee::create([
                'person_id' => $person->id,
                'position' => 'Therapist',
                'username' => "therapist{$i}",
                'password' => bcrypt('secret'),
            ]));
}


        // 5. Assign next 10 people as clients
        $clients = collect();
        foreach ($people->slice(3, 10) as $person) {
            $clients->push(Client::create([
                'person_id' => $person->id,
                'case_manager_id' => $employees[0]->id,
                'care_level_id' => 'RTC',
                'completed_hours' => rand(10, 90),
            ]));
        }

        // 6. Create 3 groups
        $groups = collect();
        for ($i = 1; $i <= 3; $i++) {
            $groups->push(Group::create([
                'group_name' => "Group {$i}",
                'start_time' => '08:00',
                'end_time' => '09:00',
                'active' => true,
                'week_day' => 'Monday',
                'day_time' => 'Morning',
            ]));
        }

        // 7. Create 5 sessions led by employee[1]
        $sessions = collect();
        for ($i = 1; $i <= 5; $i++) {
            $sessions->push(SessionHistories::create([
                'leader_id' => $employees[1]->id,
                'group_id' => $groups->random()->id,
                'start_time' => '08:00',
                'end_time' => '09:00',
                'shift_note_complete' => true,
                'date' => now()->subDays($i)->format('Y-m-d'),
            ]));
        }

        // 8. Assign employee[2] to all sessions as supporting staff
        foreach ($sessions as $session) {
            SessionStaff::create([
                'session_id' => $session->id,
                'staff_id' => $employees[2]->id,
            ]);
        }

        // 9. Assign first 3 clients to each session
        foreach ($sessions as $session) {
            foreach ($clients->take(3) as $client) {
                ClientSession::create([
                    'session_id' => $session->id,
                    'client_id' => $client->id,
                    'staff_id' => $employees[0]->id,
                    'client_note' => 'Attended successfully.',
                    'in_alleva' => true,
                    'note_assigned_to_id' => $employees[1]->id,
                    'care_level_id' => 'RTC',
                ]);
            }
        }
    }
}
