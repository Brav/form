<?php

namespace App\Http\Controllers;

use App\Models\ComplaintForm;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     *
     * @param int $id
     * @return never
     */
   public function delete(int $id)
   {
       $form = ComplaintForm::with(['clinic'])->findOrFail($id);

       Storage::delete('documents/complaint_form_' . $form->id . '/' . request()->file);

       return response()->json([
            'success' => 'Success',
       ], 200);

   }
}
