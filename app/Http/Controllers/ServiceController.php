<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\services;
use Carbon\Carbon;

class ServiceController extends Controller
{
    public function services()
    {
        $services = services::latest()->get();

        return view('Services.index',compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createservice()
    {
        return view('Services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeservice(Request $request)
    {
        $services = new services;
        // Check if a file has been uploaded
        if ($request->hasFile('service_image')) {
            // Get the uploaded file
            $image = $request->file('service_image');
            
            // Generate a unique filename for the image
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();

            // Store the image in the public directory
            $image->storeAs('service_images', $filename);

            // Save the image path to the database
            $services->service_image = $filename;
        }

        $services->service_name = $request->input('service_name');
        $services->service_price = $request->input('service_price');
        $services->service_desc = $request->input('service_desc');
        $services->service_hours = $request->input('service_hours');
        $services->created_by = auth()->user()->id;
        $services->updated_by = auth()->user()->id;
        $services->created_at = Carbon::now();
        $services->updated_at = Carbon::now();
        $services->save();

        return redirect('services')->with('success', 'Service has been created!');

    }

    /**
     * Display the specified resource.
     */
    public function deleteservice(string $id)
    {
        services::findOrFail($id)->delete();

        return redirect('services')->with('success', 'Service has been deleted!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editservice(string $id)
    {
        $service = services::findOrFail($id);

        return view('Services.edit',compact('service'));
    }

    public function viewservice(string $id)
    {
        $service = services::findOrFail($id);

        return view('Services.view',compact('service'));
    }

    

    /**
     * Update the specified resource in storage.
     */
    public function updateservice(Request $request, string $id)
    {
        $services = services::findOrFail($id);

                // Check if a file has been uploaded
                if ($request->hasFile('service_image')) {
                    // Get the uploaded file
                    $image = $request->file('service_image');
                    
                    // Generate a unique filename for the image
                    $filename = uniqid() . '.' . $image->getClientOriginalExtension();
        
                    // Store the image in the public directory
                    $image->storeAs('service_images', $filename);
        
                    // Save the image path to the database
                    $services->service_image = $filename;
                }
        
                $services->service_name = $request->input('service_name');
                $services->service_price = $request->input('service_price');
                $services->service_desc = $request->input('service_desc');
                $services->service_hours = $request->input('service_hours');
                $services->updated_by = auth()->user()->id;
                $services->updated_at = Carbon::now();
                $services->save();
        
                return redirect('services')->with('success', 'Service has been updated!');
    }
}
