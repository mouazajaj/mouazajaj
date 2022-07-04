<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Information;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
class InformationController extends Controller
{
    public function index()
    {
        $data=Information::where('Card_id',Auth::user()->Card_id)->get(['Name','Card_id','Picture','Age','Family_history','Immunizations','Allergies','Surgeries','Drugs_prescribed','Blood_type','Disease']);
        return response($data[0]);}
        public function create(Request $request)
        {
            $attr = $request->validate([
                
                'Name' => 'required|string|max:255',
                'Card_id' => 'required|string|max:20',
                'Picture' => 'string',
                'Date_of_birth' => 'required',
                'Gender' => 'required|string|max:6',
                'Address' => 'required|string|max:30',
                'Relationship_statues' => 'required|string|max:10',
                'Family_history' => 'string',
                'Immunizations' =>'string',
                'Allergies' => 'string',
                'Surgeries' => 'string',
                'Drugs_prescribed' =>'string',
                'Blood_type' =>'string',
                'Doctor_visits' => 'string',
                'Disease' => 'string',
            
            ]);
    
            $information = Information::create([
            
                'Name' => $attr['Name'],
                'Card_id' => $attr['Card_id'],
                'Picture' => $attr['Picture'],
                'Date_of_birth' => $attr['Date_of_birth'],
                'Gender' => $attr['Gender'],
                'Address' => $attr['Address'],
                'Relationship_statues' => $attr['Relationship_statues'],
                'Family_history' => $attr['Family_history'],
                'Immunizations' => $attr['Immunizations'],
                'Allergies' => $attr['Allergies'],
                'Surgeries' => $attr['Surgeries'],
                'Drugs_prescribed' => $attr['Drugs_prescribed'],
                'Blood_type' => $attr['Blood_type'],
                'Doctor_visits' => $attr['Doctor_visits'],
                'Disease' => $attr['Disease'],
               
            ]);
          return response()->json($information);
        }
    
 
        public function show($Card_id)
        {
            $information=Information::where('Card_id',$Card_id)->first();  
            return $information;  
        }
        public function update(Request $request, $Card_id)
        {
            $input = $request->all();  
            Information::where('Card_id',$Card_id)->update($input);
        }
        public function destroy($Card_id)
        {
            $information =Information::where('Card_id',$Card_id);
     
            $information->delete();
        }
}
