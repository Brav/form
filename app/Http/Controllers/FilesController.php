<?php

namespace App\Http\Controllers;

use App\Models\ClinicManagers;
use App\Models\ComplaintForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    /**
     *
     * @param int $id
     * @return never
     */
   public function delete(int $id)
   {
       $form = ComplaintForm::with(['clinic'])->findOrFail($id);

       $canDelete = true;

       if(!auth()->user()->admin)
       {
           $manager = ClinicManagers::where('clinic_id', '=', $form->clinic_id)
            ->where('user_id', '=', auth()->id())
            ->first();

            if(!$manager || !$manager->role->hasPermission('d'))
            {
                $canDelete = false;
            }
       }

       if(!$canDelete)
       {
            return response()->json([
                'error' => 'Error',
            ], 500);
       }

    //    Storage::delete('documents/complaint_form_' . $form->id . '/' . request()->file);

       return response()->json([
            'success' => 'Success',
       ], 200);

   }
}
