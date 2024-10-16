<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\Contact;
use App\Exports\ContactExport;

class ContactController extends Controller
{
	public function index(Request $request)
	{
		if (!$request->get('keyword')) {
			
			if ( !$request->filled('data_inicial') && !$request->filled('data_final') ) { 
				$contacts = Contact::orderBy('created_at', 'desc')->paginate(10)->withQueryString();
			} 
			else if(!$request->filled('data_inicial') || !$request->filled('data_final')) {
				
				if (!$request->filled('data_inicial') && $request->filled('data_final')) { 
					$contacts = Contact::where('created_at', '<=', $request->get('data_final').' 23:59:59')
					->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
				}
				else { 
					$contacts = Contact::where('created_at', '>=', $request->get('data_inicial').' 00:00:00')
					->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
				}
				
			}
			else{ 
				$contacts = Contact::whereBetween('created_at', [$request->get('data_inicial').' 00:00:00', $request->get('data_final').' 23:59:59'])
				->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
			}

		} 
		else {
			$contacts = Contact::where('name', 'LIKE', '%'.$request->get('keyword').'%')->orderBy('created_at', 'desc')->get();
		}

		return view('admin.contact.index', ['title' => __('models.contact'), 'contacts' => $contacts]);
	}

	public function show($slug)
	{
		return view('admin.contact.show', ['contact' => Contact::where('slug', $slug)->first()]);
	}

	public function csv()
	{	
		return Excel::download(new ContactExport(), __('models.contact') . '.csv', \Maatwebsite\Excel\Excel::CSV, [
			'Content-Type' => 'text/csv',
		]);
	}
}
