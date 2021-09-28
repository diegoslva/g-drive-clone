<?php

namespace App\Http\Controllers\Admin;

use App\Models\Folder;
use App\Http\Controllers\Controller;
use App\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreFolderRequest;
use App\Http\Requests\UpdateFolderRequest;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class FoldersController extends Controller
{
  use MediaUploadingTrait, ApiResponser;

  public function index()
  {
    abort_if(Gate::denies('folder_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    return $this->success(Folder::with(['parent'])->get());
  }

  public function store(StoreFolderRequest $request)
  {   
    $folder = Folder::create($request->all());
    if ($request->hasFile('files')) {
      $folder
          ->addMedia($request->file('files') )
          ->toMediaCollection('files');
    }

    return $this->success($folder, 'Criado com sucesso!', 201);
  }

    public function show(int $id)
    {   
        abort_if(Gate::denies('folder_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $collection = Folder::query()->findOrFail($id);
        $collection->children;
        
        return response()->json($collection, 200);
    }

    public function update(UpdateFolderRequest $request, Folder $folder)
    {
        $folder->update($request->all());

        if (count($folder->files) > 0) {
            foreach ($folder->files as $media) {
                if (!in_array($media->file_name, $request->input('files', []))) {
                    $media->delete();
                }
            }
        }

        $media = $folder->files->pluck('file_name')->toArray();

        foreach ($request->input('files', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $folder->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('files');
            }
        }

        return $this->success($folder, 'Atualizado com sucesso!!' ,Response::HTTP_ACCEPTED);
    }

    public function destroy(Folder $folder)
    {
        abort_if(Gate::denies('folder_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $folder->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeMedia(Request $request)
    {  
        // var_dump($request->files);die();
        if (request()->has('size')) {
            $this->validate(request(), [
                'file' => 'max:' . request()->input('size') * 1024,
            ]);
        }

        if (request()->has('width') || request()->has('height')) {
            $this->validate(request(), [
                'file' => sprintf(
                    'image|dimensions:max_width=%s,max_height=%s',
                    request()->input('width', 100000),
                    request()->input('height', 100000)
                ),
            ]);
        }

        $folder = Folder::findOrFail($request->folder_id);

        foreach ($request->file('files') as $file) {
            $folder
                ->addMedia($file)
                ->toMediaCollection('files');
        }
        
        return response()->json($folder);
    
    }

    public function postUpload(Request $request)
    {
        $folder = Folder::with('project')
            ->whereHas('project.users', function($query) {
                $query->where('id', auth()->id());
            })->findOrFail($request->folder_id);

        foreach ($request->input('files', []) as $file) {
            $folder->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('files');
        }

        return redirect()->route('folders.show', $folder)->withStatus('Files has been uploaded');
    }

    public function foldersDirectory(int $id)
    {

      abort_if(Gate::denies('folder_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
      
      $collection = Folder::where('user_id', $id)->first();
      
      $collection->children;

      return response()->json($collection);
    }

}
