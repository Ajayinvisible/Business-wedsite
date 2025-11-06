<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{

    public function AllFaqs()
    {
        // Logic to retrieve all features
        $faqs = Faq::latest()->get();
        // Return the view with the features data
        return view('admin.backend.faqs.all_faqs', [
            'faqs' => $faqs
        ]);
    }

    public function AddFaqs()
    {
        // Logic to show the form for adding a new feature
        return view('admin.backend.faqs.add_faqs');
    }

    public function StoreFaqs(Request $request)
    {
        Faq::create([
            'question' => $request->question,
            'answer' => $request->answer,
        ]);

        // Redirect to the all reviews page with a success message
        $notification = array(
            'message' => 'Faq\'s Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.faqs')->with($notification);
    }

    public function EditFaqs($id)
    {
        // Logic to show the form for editing a review
        $Faq = Faq::findOrFail($id);
        return view('admin.backend.faqs.edit_faqs', compact('Faqs'));
    }

    public function UpdateFaqs(Request $request, $id)
    {
        // Logic to update a review
        $faq_id = $request->id;

        Faq::find($faq_id)->update([
            'question' => $request->question,
            'answer' => $request->answer,
        ]);
        // Redirect to the all reviews page with a success message
        $notification = array(
            'message' => 'Faq\'s Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.faqs')->with($notification);
    }

    public function DeleteFaqs($id)
    {
        Faq::findOrFail($id)->delete();
        // Redirect to the all reviews page with a success message
        $notification = array(
            'message' => 'Faq\'s Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.faqs')->with($notification);
    }
}
