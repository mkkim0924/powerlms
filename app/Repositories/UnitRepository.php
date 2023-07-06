<?php

namespace App\Repositories;

use App\Interfaces\UnitRepositoryInterface;
use App\Models\UnitAttachment;
use App\Models\UnitFaq;
use App\Models\Units;
use Illuminate\Support\Facades\DB;

class UnitRepository implements UnitRepositoryInterface
{
    public function getUnitDetail($id)
    {
        return Units::whereHas('courseDetail', function ($q) {
            $q->byUserType();
        })->where('id', $id)->first();
    }

    public function storeUnitData($request): array
    {
        try {
            $requestData = $request->all();
            $slugExist = checkSlugExist($requestData['course_id'], $requestData['slug']);
            if ($slugExist) {
                return ['status' => false, 'message' => __('backend.lessons.flash_message.slug_already_exist')];
            }
            DB::beginTransaction();
            if ($request->hasFile('lesson_media_url')) {
                $requestData['lesson_media_url'] = uploadFile($requestData['lesson_media_url'], 'unit/media');
            }
            if (isset($requestData['lesson_thumbnail_image'])) {
                $requestData['lesson_thumbnail_image'] = uploadFile($requestData['lesson_thumbnail_image'], 'unit/thumbnail_images', null, Units::THUMBNAIL_IMAGE_DIMENSION);
            }
            if ($requestData['lesson_type'] == 'document') {
                $requestData['time'] = null;
            }
            $requestData['free_lesson'] = isset($requestData['free_lesson']) ? 1 : 0;
            $requestData['is_active'] = 1;
            $unit = Units::create($requestData);
            self::storeUnitFaqs($unit->id, $requestData);
            self::storeNewUnitAttachments($unit->id, $requestData);
            DB::commit();
            return ['status' => true];
        } catch (\Exception$e) {
            DB::rollBack();
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    public function getUnits($request)
    {
        $unit = Units::whereHas('courseDetail', function ($q) {
            $q->byUserType();
        });
        $course_id = $request->course_id;
        $section_id = $request->section_id;
        if ($course_id) {
            $unit = $unit->where('course_id', $course_id);
        }
        if ($section_id) {
            $unit = $unit->where('section_id', $section_id);
        }
        return $unit->orderBy('id', 'DESC')->get();
    }

    public function updateUnit($request, $id): array
    {
        try {
            $unit = self::getUnitDetail($id);
            $requestData = $request->all();

            DB::beginTransaction();
            if ($request->hasFile('lesson_media_url')) {
                $requestData['lesson_media_url'] = uploadFile($requestData['lesson_media_url'], 'unit/media', $unit->lesson_media_url);
            }
            if (isset($requestData['lesson_thumbnail_image'])) {
                $requestData['lesson_thumbnail_image'] = uploadFile($requestData['lesson_thumbnail_image'], 'unit/thumbnail_images', $unit->lesson_thumbnail_image, Units::THUMBNAIL_IMAGE_DIMENSION);
            }
            if ($requestData['lesson_type'] == 'document') {
                $requestData['time'] = null;
            }
            $requestData['free_lesson'] = isset($requestData['free_lesson']) ? 1 : 0;
            $unit->update($requestData);
            self::storeUnitFaqs($id, $requestData);

            if (isset($requestData['exist_attachment_details'])) {
                foreach ($requestData['exist_attachment_details'] as $exist_attachment_details){
                    $existAttachment = UnitAttachment::find($exist_attachment_details['id']);
                    $attachment = isset($exist_attachment_details['attachment']) ? uploadFile($exist_attachment_details['attachment'], 'unit/attachments', $existAttachment->attachment) : $existAttachment->attachment;
                    $existAttachment->update([
                        'title' =>  $exist_attachment_details['title'],
                        'attachment' =>  $attachment
                    ]);
                }
            }

            self::storeNewUnitAttachments($id, $requestData);

            DB::commit();
            return ['status' => true];
        } catch (\Exception$e) {
            DB::rollBack();
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    public function updateActiveStatus($request): bool
    {
        $cat = Units::findOrFail($request->id);
        $cat->is_active = $request->is_active;
        $cat->save();
        return true;
    }

    public function removeAttachment($request): bool
    {
        $data = UnitAttachment::findOrFail($request->id);
        unlinkFile($data->attachment, 'unit/attachments');
        $data->delete();
        return true;
    }

    public function storeUnitFaqs($unit_id, $requestData): bool
    {
        UnitFaq::where('unit_id', $unit_id)->delete();
        if (isset($requestData['question'])) {
            foreach ($requestData['question'] as $key => $question) {
                if (!empty($question)) {
                    UnitFaq::create([
                        'unit_id' => $unit_id,
                        'question' => $question,
                        'answer' => $requestData['answer'][$key] ?? null,
                    ]);
                }
            }
        }
        return true;
    }
    public function storeNewUnitAttachments($unit_id, $requestData): bool
    {
        if (isset($requestData['title_attachment'])) {
            foreach ($requestData['title_attachment'] as $attachmentKey => $value) {
                if (isset($requestData['attachment']) && isset($requestData['attachment'][$attachmentKey])){
                    $file = $requestData['attachment'][$attachmentKey];
                    $attachment = uploadFile($file, 'unit/attachments');
                    UnitAttachment::create([
                        'unit_id' => $unit_id,
                        'title' => $value,
                        'attachment' => $attachment,
                    ]);
                }
            }
        }
        return true;
    }
}
