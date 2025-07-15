<?php
namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

trait ToggleStatusTrait
{
    public function toggleStatusGeneric(Request $request, $id, $modelClass, $permission, $notFoundMessage)
    {
        if (! Gate::allows($permission)) {
            return response()->json(['success' => false, 'message' => 'غير مسموح'], 403);
        }

        try {
            $model = $modelClass::find($id);

            if (! $model) {
                return response()->json([
                    'success' => false,
                    'message' => $notFoundMessage,
                ], 404);
            }

            $model->update([
                'is_active' => $request->is_active,
            ]);

            return response()->json([
                'success'   => true,
                'message'   => 'تم تغيير الحالة بنجاح',
                'is_active' => $model->is_active,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء تغيير الحالة: ' . $e->getMessage(),
            ], 500);
        }
    }
}
