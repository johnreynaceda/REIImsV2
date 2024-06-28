<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\ActiveSemester;
use App\Models\GradeLevel;
use App\Models\GradeLevelFee;
use App\Models\Role;
use App\Models\SchoolFee;
use App\Models\Strand;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $role = Role::create([
            'name' => 'Administrator',
        ]);
        User::create([
            'name' => 'REII Administrator',
            'email' => 'admin-reii@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => $role->id,
        ]);

        $role = Role::create([
            'name' => 'Business Office',
        ]);
        User::create([
            'name' => 'Business Office',
            'email' => 'businessoffice@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => $role->id,
        ]);

        $role = Role::create([
            'name' => 'Teacher',
        ]);
        User::create([
            'name' => 'Teacher',
            'email' => 'teacher@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => $role->id,
        ]);

        GradeLevel::create([
            'name' => 'Nursery',
            'department' => 'K-10'
        ]);

        GradeLevel::create([
            'name' => 'Preparatory',
            'department' => 'K-10'
        ]);

        GradeLevel::create([
            'name' => 'Kinder',
            'department' => 'K-10'
        ]);

        GradeLevel::create([
            'name' => 'Grade 1',
            'department' => 'K-10'
        ]);

        GradeLevel::create([
            'name' => 'Grade 2',
            'department' => 'K-10'
        ]);

        GradeLevel::create([
            'name' => 'Grade 3',
            'department' => 'K-10'
        ]);

        GradeLevel::create([
            'name' => 'Grade 4',
            'department' => 'K-10'
        ]);

        GradeLevel::create([
            'name' => 'Grade 5',
            'department' => 'K-10'
        ]);

        GradeLevel::create([
            'name' => 'Grade 6',
            'department' => 'K-10'
        ]);

        GradeLevel::create([
            'name' => 'Grade 7',
            'department' => 'K-10'
        ]);

        GradeLevel::create([
            'name' => 'Grade 8',
            'department' => 'K-10'
        ]);

        GradeLevel::create([
            'name' => 'Grade 9',
            'department' => 'K-10'
        ]);

        GradeLevel::create([
            'name' => 'Grade 10',
            'department' => 'K-10'
        ]);

        GradeLevel::create([
            'name' => 'Grade 11',
            'department' => 'SHS'
        ]);

        GradeLevel::create([
            'name' => 'Grade 12',
            'department' => 'SHS'
        ]);

        Strand::create([
            'name' => 'ABM',
        ]);

        Strand::create([
            'name' => 'HUMSS',
        ]);

        Strand::create([
            'name' => 'STEM',
        ]);

        $fee = SchoolFee::create([
            'name' => 'Tuition',
            'amount' => 18000,
            'description' => 'Tuition for all Students',
        ]);
        foreach (GradeLevel::all() as $key => $value) {
            GradeLevelFee::create([
               'school_fee_id' => $fee->id,
                'grade_level_id' => $value->id
            ]);
        }

        foreach (GradeLevel::all() as $key => $value) {
            if (in_array($value->id, [1, 2, 3])) {
                $fee = SchoolFee::create([
                    'name' => 'Miscellaneous',
                    'amount' => 13000,
                    'description' => 'For all '.$value->name,
                ]);
            } elseif (in_array($value->id, [4, 5, 6])) {
                $fee = SchoolFee::create([
                    'name' => 'Miscellaneous',
                    'amount' => 11500,
                    'description' => 'For all '.$value->name,
                ]);
            } elseif (in_array($value->id, [7, 8, 9])) {
                $fee = SchoolFee::create([
                    'name' => 'Miscellaneous',
                    'amount' => 14500,
                    'description' => 'For all '.$value->name,
                ]);
            } elseif (in_array($value->id, [10, 11, 12, 13])) {
                $fee = SchoolFee::create([
                    'name' => 'Miscellaneous',
                    'amount' => 15500,
                    'description' => 'For all '.$value->name,
                ]);
            } else {
                $fee = SchoolFee::create([
                    'name' => 'Miscellaneous',
                    'amount' => 0,
                    'description' => 'For all '.$value->name,
                ]);
            }

            GradeLevelFee::create([
                'school_fee_id' => $fee->id,
                'grade_level_id' => $value->id,
            ]);
        }




        $fee = SchoolFee::create([
            'name' => 'Developmental Fee',
            'amount' => 1000,
            'description' => 'For all Students',
        ]);

        foreach (GradeLevel::all() as $key => $value) {
            GradeLevelFee::create([
               'school_fee_id' => $fee->id,
                'grade_level_id' => $value->id
            ]);
        }
        $fee = SchoolFee::create([
            'name' => 'Enrolmental Fee',
            'amount' => 500,
            'description' => 'For all Students',
        ]);

        foreach (GradeLevel::all() as $key => $value) {
            GradeLevelFee::create([
               'school_fee_id' => $fee->id,
                'grade_level_id' => $value->id
            ]);
        }
        $fee = SchoolFee::create([
            'name' => 'Medical/Dental',
            'amount' => 300,
            'description' => 'For all Students',
        ]);

        foreach (GradeLevel::all() as $key => $value) {
            GradeLevelFee::create([
               'school_fee_id' => $fee->id,
                'grade_level_id' => $value->id
            ]);
        }
        $fee = SchoolFee::create([
            'name' => 'School ID',
            'amount' => 200,
            'description' => 'For all Students',
        ]);

        foreach (GradeLevel::all() as $key => $value) {
            GradeLevelFee::create([
               'school_fee_id' => $fee->id,
                'grade_level_id' => $value->id
            ]);
        }






        if (!DB::table('philippine_provinces')->count()) {
            DB::unprepared(file_get_contents(__DIR__ . '/sql/refProvince.sql'));
            }

            if (!DB::table('philippine_cities')->count()) {
                DB::unprepared(file_get_contents(__DIR__ . '/sql/refCitymun.sql'));
                }

                // if (!DB::table('grade_level_fees')->count()) {
                //     DB::unprepared(file_get_contents(__DIR__ . '/sql/grade_level_fees.sql'));
                //     }

                //     if (!DB::table('school_fees')->count()) {
                //         DB::unprepared(file_get_contents(__DIR__ . '/sql/school_fees.sql'));
                //         }

                        if (!DB::table('sale_categories')->count()) {
                            DB::unprepared(file_get_contents(__DIR__ . '/sql/sale_categories.sql'));
                            }

                            foreach (GradeLevel::get() as $gradeKey => $gradeValue) {
                                if ($gradeValue->department == 'SHS') {
                                    foreach (Strand::get() as $strandKey => $strandValue) {
                                        $fee = SchoolFee::create([
                                            'name' => 'Books',
                                            'amount' => 0,
                                            'description' => 'For all ' . $gradeValue->name . ' ' . $strandValue->name,
                                        ]);

                                        GradeLevelFee::create([
                                            'school_fee_id' => $fee->id,
                                            'grade_level_id' => $gradeValue->id,
                                            'strand_id' => $strandValue->id,
                                        ]);
                                    }
                                } else {
                                    $fee = SchoolFee::create([
                                        'name' => 'Books',
                                        'amount' => 0,
                                        'description' => 'For all ' . $gradeValue->name,
                                    ]);

                                    GradeLevelFee::create([
                                        'school_fee_id' => $fee->id,
                                        'grade_level_id' => $gradeValue->id,
                                    ]);
                                }
                            }

        ActiveSemester::create([
            'active' => '1st Semester'
        ]);

        foreach (GradeLevel::get() as $key => $value) {
            $fee = SchoolFee::create([
                'name' => 'P.E Uniform',
                'amount' => 0,
                'description' => 'For all '.$value->name,
            ]);
            GradeLevelFee::create([
                'school_fee_id' => $fee->id,
                'grade_level_id' => $value->id,
            ]);
        }
        foreach (GradeLevel::get() as $key => $value) {
            $fee = SchoolFee::create([
                'name' => 'Handbook',
                'amount' => 0,
                'description' => 'For all '.$value->name,
            ]);
            GradeLevelFee::create([
                'school_fee_id' => $fee->id,
                'grade_level_id' => $value->id,
            ]);
        }

    }
}
