<?php
namespace App\Http\Controllers\Api;

use App\Models\Page;


use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;



class CsvController extends Controller
{


	public function store (Request $request)
	{
		
	   $file = $request->file('clinic_logo');
      // File Details 
      $filename = $file->getClientOriginalName();
      $extension = $file->getClientOriginalExtension();
      $tempPath = $file->getRealPath();
      $fileSize = $file->getSize();
      $mimeType = $file->getMimeType();
      // Valid File Extensions
      $valid_extension = array("csv");

      // 2MB in Bytes
      $maxFileSize = 2097152; 

      if(in_array(strtolower($extension),$valid_extension))
      {
      	if($fileSize <= $maxFileSize)
      	{
      		$file    = fopen($_FILES['clinic_logo']['tmp_name'], "r");
      		$importData_arr = array();
          	$i = 0;
            $records    = 0;
            $insert     = 0;
          	while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) 
          	{
          		$num = count($filedata );

          		for ($c=0; $c < $num; $c++) 
             {
                $importData_arr[$i][] = $filedata [$c];
             }
             $i++;
             $records++;
          	}
          	fclose($file);

            foreach($importData_arr as $importData)
            {
             if(empty($importData[7]))
             {
              $response = array
            (
            'status'  => 'error',
            'msg'     => 'Assigned To column can not be empty or less than 0 or equal to 0',
            
            );

        return \Response::json($response);

              }
            }
          	foreach($importData_arr as $importData)
            {
              //$id['id'] = $importData[0];
              $id['asset_tag'] = $importData[1];
              $idchei = Page::checkData($id);
              if(empty($idchei))
              {
                $insertData = array(

               "name"           =>  $importData[0],
               "asset_tag"      =>  $importData[1],
               "model_id"       =>  $importData[2],
               "serial"         =>  $importData[3],
               "purchase_date"  =>  $importData[4],
               "purchase_cost"  =>  $importData[5],
               "order_number"   =>  $importData[6],
               "assigned_to"    =>  $importData[7],
               "user_id"        =>  $importData[8],
               "status_id"      =>  $importData[9],
               "location_id"    =>  $importData[10],
               "configuration"  =>  $importData[11],
               "monthlyrent"    =>  $importData[12],
               "company_id"     =>  $importData[13],
               "assigned_type"  =>  $importData[14],
               "last_checkout"  =>  date('Y-m-d H:i:s'),
               "created_at"     =>  date('Y-m-d H:i:s')
             );

                Page::insertData($insertData);
              }
            }
            $response = array
            (
            'status'  => 'success',
            'msg'     => 'csv uploaded successfully',
            'Total'   => 'Total Records:'.''.$records,
            );

        return \Response::json($response);
       }
      else
        {
          $response = array
            (
            'status'  => 'success',
            'msg'     => 'File too large. File must be less than 2MB.',
            );

        return \Response::json($response);
        
        }
      }
      else{
        $response = array
            (
            'status'  => 'success',
            'msg'     => 'Invalid File Extension.',
            );

        return \Response::json($response);
         
      }
	
	}

  public function users_store(Request $request)
  {
    $file = $request->file('clinic_logo');
      // File Details 
      $filename = $file->getClientOriginalName();
      $extension = $file->getClientOriginalExtension();
      $tempPath = $file->getRealPath();
      $fileSize = $file->getSize();
      $mimeType = $file->getMimeType();
      // Valid File Extensions
      $valid_extension = array("csv");

      // 2MB in Bytes
      $maxFileSize = 2097152;
      if(in_array(strtolower($extension),$valid_extension))
      {
        if($fileSize <= $maxFileSize)
        {
          $file    = fopen($_FILES['clinic_logo']['tmp_name'], "r");
          $importData_arr = array();
            $i = 0;

            $records    = 0;
            while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) 
            {
              $num = count($filedata );

              for ($c=0; $c < $num; $c++) 
             {
                $importData_arr[$i][] = $filedata [$c];
             }
             $i++;
             $records++;
            }
            fclose($file);
            foreach($importData_arr as $importData)
            {
              
              $insertData = array(
               "first_name"           =>  $importData[0],
               "last_name"            =>  $importData[1],
               "username"            =>   $importData[2],
               "email"                =>  $importData[3],
               "company_id"           =>  $importData[4],
               "locale"               =>  $importData[5],               
               "employee_num"         =>  $importData[6],
               "jobtitle"             =>  $importData[7],
               "manager_id"           =>  $importData[8],
               "department_id"        =>  $importData[9],
               "location_id"          =>  $importData[10],
               "phone"                =>  $importData[11],
               "website"              =>  $importData[12],
               "address"              =>  $importData[13],
               "city"                 =>  $importData[14],
               "state"                =>  $importData[15],
               "country"              =>  $importData[16],
               "zip"                  =>  $importData[17],
               "activated"            =>  $importData[18],
               "notes"                =>  $importData[19],
               
               "created_at"           =>  date('Y-m-d H:i:s')

             );

                Page::insertusersData($insertData);
              
            }

            $response = array
            (
            'status'  => 'success',
            'msg'     => 'csv uploaded successfully',
            'Total'   =>  'Total Records:'.''.$records,
            );

        return \Response::json($response);
          
        }
        else
        {
          $response = array
            (
            'status'  => 'large',
            'msg'     => 'File too large. File must be less than 2MB.',
            );

        return \Response::json($response);
        }
      }
      else
      {
        $response = array
            (
            'status'  => 'Invalid',
            'msg'     => 'Invalid File Extension.',
            );

        return \Response::json($response);
      }
    
  }

}

//return redirect('login')->withErrors($validator->errors())->withInput()
//return redirect()->back()->withErrors(["message" => $ex->getMessage()]);
//return redirect('/user_selection_cart');

