<?php

use \Illuminate\Support\Facades\DB;

class SubjectsAndTopicsSeeder extends \Illuminate\Database\Seeder
{

    public function run()
    {
        $subjects = [
            'English Language' => [
                'Noun',
                'Pronoun',
                'Adjective',
                'Figures of Speech',
            ],
            'Mathematics' => [
                'Addition',
                'Subtraction',
                'Algebraic Expression',
                'Permutation and Computation'
            ],
            'Primary Science' => [
                'Productive Organs',
                'Process of Production'
            ],
            'Geography' => [
                'what is geography',
                'Earth Geology'
            ]
        ];

        foreach($subjects as $subject => $topics) {
            $subject_id = DB::table('subjects')
                ->insertGetId(['name' => $subject]);

            if (is_array($topics) && !empty($topics))
                foreach ($topics as $topic) {
                    DB::table('subject_topics')
                        ->insert([
                            'subject_id' => $subject_id,
                            'topic' => $topic
                        ]);
                }
        }
    }

}
