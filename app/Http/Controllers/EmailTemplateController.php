<?php

namespace App\Http\Controllers;

use App\DataTables\EmailTemplateDataTable;
use App\Http\Requests\EmailTemplateRequest;
use App\Models\EmailTemplates;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdateEmailTemplateRequest;

class EmailTemplateController extends Controller
{
    public function index(EmailTemplateDataTable $dataTable)
    {
        return $dataTable->render('pages.apps.email-templates.list');
    }

    public function create()
    {
        return view('pages.apps.email-templates.create_email_template');
    }

    public function store(EmailTemplateRequest $request)
    {
        DB::beginTransaction();
        try{
        $validatedData = $request->validated();
          // Insert into the database using Eloquent
         EmailTemplates::create($validatedData);
         Db::commit();
         return redirect()->route('email.templates')->with('success','create successfully');
        //  $validatedData->dispatch('success', __('New Product Created'));
        }
        catch(\Exception $e){
            DB::rollBack();
            dd($e);
            return redirect()->route('email.templates')->with('success','create successfully');
        } 
    }

    public function show($id)
    {
        $emailTemplates = EmailTemplates::find($id);

        // Check if the template with the given ID exists
        if (!$emailTemplates) {
            abort(404); // Or handle the not found case in another way
        }
        $statuses=['active','inactive'];
    
        return view('pages.apps.email-templates.show', compact('emailTemplates','statuses'));
    }

    public function delete($id)
    {
    // Logic to delete the record
    $emailTemplate = EmailTemplates::findOrFail($id);
    $emailTemplate->delete();

    
    // You can return a response if needed
    return response()->json(['message' => 'Record deleted successfully']);
    }

    public function edit($id)
    {
        $emailTemplates = EmailTemplates::find($id);

        // Check if the template with the given ID exists
        if (!$emailTemplates) {
            abort(404); // Or handle the not found case in another way
        }
        $statuses=['active','inactive'];
    
        return view('pages.apps.email-templates.edit', compact('emailTemplates','statuses')); 
    }

    public function update(UpdateEmailTemplateRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            // Validate the request data
            $validatedData = $request->validated();
    
            // Update the EmailTemplates based on a condition (e.g., where ID is $id)
            EmailTemplates::where('id', $id)->update($validatedData);
    
            // Commit the transaction
            DB::commit();
    
            return redirect()->route('email.templates')->with('success', 'Update successfully');
        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollBack();
    
            // Handle the exception (you might want to log it or display a specific error message)
            return redirect()->route('email.templates')->with('error', 'Failed to update');
        }
    }
}

