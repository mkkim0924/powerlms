<?php

namespace Database\Seeders;

use App\Models\ChatMessage;
use App\Models\ChatParticipant;
use App\Models\ChatThread;
use App\Models\CourseUser;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('chat_messages')->truncate();
        DB::table('chat_participants')->truncate();
        DB::table('chat_threads')->truncate();

        // $faker = Factory::create();

        $course_user_ids = range(1, 10);
        foreach ($course_user_ids as $course_user_id) {
            $currentThread = null;
            $courseUser = CourseUser::findOrFail($course_user_id);
            $currentThread = ChatThread::where('course_user_id', $course_user_id)->first();
            if (is_null($currentThread)) {
                $currentThread = ChatThread::create([
                    'user_id' => $courseUser->user_id,
                    'course_id' => $courseUser->course_id,
                    'course_user_id' => $course_user_id,
                ]);
                ChatParticipant::create([
                    'user_id' => $courseUser->user_id,
                    'thread_id' => $currentThread->id,
                ]);
                ChatParticipant::create([
                    'user_id' => $courseUser->courseDetails->instructor_id,
                    'thread_id' => $currentThread->id,
                ]);
            }

            for ($a = 0; $a < 3; $a++) {
                ChatMessage::create([
                    'thread_id' => $currentThread->id,
                    'user_id' => $courseUser->user_id,
                    'body' => Factory::create()->text(60),
                ]);
                ChatMessage::create([
                    'thread_id' => $currentThread->id,
                    'user_id' => $courseUser->courseDetails->instructor_id,
                    'body' => Factory::create()->text(80),
                ]);
                ChatThread::where('id', $currentThread->id)->update(['updated_at' => Carbon::now()]);
            };
        };
    }
}
