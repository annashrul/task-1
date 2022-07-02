<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule; 
class ProvinceController extends Controller
{
    public function index(Request $request)
    {
        $page       = $request->get("page")==null?1:(int)$request->get("page");
        $perpage    = $request->get("perpage")==null?2:(int)$request->get("perpage");
        $where    = $request->get("name")==null?"":$request->get("name");
        $data       = DB::table("province")->where('name', 'like', '%' . $where . '%')->orderBy('id', 'DESC')->paginate($perpage);
        $total       = DB::table("province")->where('name', 'like', '%' . $where . '%')->orderBy('id', 'DESC')->get();
        $datas      = [];
        $response=[];
        if($data!=null){
            return response()->json($data,Response::HTTP_OK);
        }
        else{
            return response()->json(["status"=>false,"data"=>[],"pagination"=>[]],Response::HTTP_OK);
        }
        
    }


    public function store(Request $request){
        DB::beginTransaction();
        try{
            $data = $this->coreField($request,null);
            if(gettype($data)=="object"){
                DB::rollback();
                return $data;
            }
            DB::table("province")->insert($data);
            DB::commit();
            return response()->json(["message" => $data], 200);
        }catch (QueryException $e) {
            DB::rollback();
            return response()->json($e);
        }
    }
   

    public function update(Request $request, $id){
        DB::beginTransaction();
        try{
            $data = $this->coreField($request,$id);
            if(gettype($data)=="object"){
                DB::rollback();
                return $data;
            }
            DB::table("province")->where("id",$id)->update($data);
            DB::commit();
            return response()->json(["message" => $data], 200);
        }catch (QueryException $e) {
            DB::rollback();
            return response()->json($e);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        $resDb=DB::table("province")->where("id",$id)->first();
        try{
            $message = "";
            if(Storage::disk('public')->exists($resDb->file)){
                $message = "hapus gambar di folder";
                Storage::disk('public')->delete($resDb->file);
            }
            DB::table('province')->where("id",$id)->delete();
            DB::commit();
            return response()->json(["message"=>$message],200);
        }catch (QueryException $e){
            DB::rollback();
            return response()->json(["message"=>false],400);
        }
    }


    public function coreField(Request $request,$id){
        $isValidate=[
            "code"      => "required",
            "name"      => "required",
        ];
        $data=[
            "code"=>$request->post("code"),
            "name"=>$request->post("name"),
        ];
        if($id!=null){
            $resDb=DB::table("province")->where("id",$id)->first();
            $isValidate["code"] = 'unique:province,code,' . $id;
        }
        else{
            $data["file"]="";
            $isValidate["code"] = "required|unique:province";
        }

        $validator = Validator::make($request->all(),$isValidate);
        if($validator->fails()){
            return response()->json($validator->errors(),200);
        }

        $image_64 = $request->post("file");
        
        
        if($image_64!=""||$image_64!=null){
            $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1]; 
            $replace = substr($image_64, 0, strpos($image_64, ',')+1); 
            $image = str_replace($replace, '', $image_64); 
            $image = str_replace(' ', '+', $image); 
            $imageName = Str::random(10).'.'.$extension;
            if(Storage::disk('public')->exists($id!=null?$resDb->file:$imageName)){
                Storage::disk('public')->delete($id!=null?$resDb->file:$imageName);
            }
            $file=Storage::disk('public')->put($imageName, base64_decode($image));
            $data["file"]=$imageName;
        }
        return $data;
    }

}