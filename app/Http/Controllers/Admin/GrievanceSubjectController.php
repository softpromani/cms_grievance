<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GrievanceSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;

class GrievanceSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = GrievanceSubject::paginate(10);
        
        return view('admin.grievance_subject',compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name'=>'required',
            'icon_image'=>'nullable'
        ]);
        $pic_name = '';
        // if ($request->hasFile('icon_image')) {
        //     $sub_img = 'subject-' . time() . '-' . rand(0, 99) . '.' . $request->icon_image->extension();
        //     $request->icon_image->move(public_path('app-assets/images/subject/'), $sub_img);
        //     $pic_name = 'app-assets/images/subject/'.$sub_img;
        // }

        $subject = GrievanceSubject::create([
            'name'=>$request->name,
            'is_visible'=>'1',
            'icon_image'=>$pic_name,
        ]);
        if($request->icon_image){
            $path='grievance';
            $file = $request->icon_image;
            $media=uploadFile($subject,$path,$file);
          }
        if ($subject) 
            {
                return back()->with('success', 'Subject Add successfully');
            }
            else {
                return back()->with('error', 'Oh! Subject did not saved successfully');
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subjects = GrievanceSubject::paginate(10);
        $edit = GrievanceSubject::find(Crypt::decrypt($id));
        return view('admin.grievance_subject',compact('edit','subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'name'=>'required',
        ]);
       
        $data = GrievanceSubject::find($id);
        $exists_image = $data->icon_image;
        $pic_name = '';
        
        // if ($request->hasFile('icon_image')) {
        //     $sub_img = 'subject-'.time().'-'.rand(0, 99).'.'.$request->icon_image->extension();
        //     $request->icon_image->move(public_path('app-assets/images/subject/'),$sub_img);
        //     $pic_name = 'app-assets/images/subject/'.$sub_img;
        //     if ($exists_image) {
        //         File::delete(public_path($exists_image));
        //     }
        // }
        $subject = $data->update([
            'name'=>$request->name,
            'icon_image'=>$pic_name
        ]);

        if($request->icon_image){
            $path='grievance';
            $file = $request->icon_image;
            $media=uploadFile($data,$path,$file);
          }

        if ($subject) 
            {
                return redirect()->route('admin.subject.index')->with('success', 'Subject Update successfully');
            }
            else {
                return back()->with('error', 'Oh! Subject did not Update successfully');
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = GrievanceSubject::find($id)->delete();
        if($delete){
            return back()->with('success', 'Subject Deleted successfully');
        }
        else {
            return back()->with('error', 'Oh! Subject did not Delete');
        }
    }
    public function is_activeSubject(Request $request, $id)
    {
        // $id = Crypt::decrypt($id);
        $data = GrievanceSubject::find($id)->is_visible;
        if ($data == 1) {
            $update = GrievanceSubject::find($id)->update([
                'is_visible' => 0
            ]);
        } else {
            $update = GrievanceSubject::find($id)->update([
                'is_visible' => 1
            ]);
        }
        return redirect()->back()->with('success', 'Status Updated Successfully');



    }
}
