<?php

namespace App\Http\Controllers\Admin;
use DB;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Yktrend;
use App\Yknumber;
use App\Yktype;
use App\Yksource;
use App\Server;
class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /***********************************近七日游客走势图******************************************/
    public function index()
    {
        //$yktrends = Yktrend::Orderby('ydate','desc')->paginate(5);
        $servers= Server::Orderby('id','desc')->paginate(5);
        //echo count($servers);
        //echo $servers[0]->overlays[0]->name;
        return view('admin/index',['servers'=>$servers]);
    }
    public function addYktrend(Request $request)
    {
        $info['status']=1;
        $this->validate($request, [
            'ydate' => 'required',
            'number' => 'required',
        ]);

        $yktrend = new Yktrend;
        $yktrend->ydate = $request->get('ydate');
        $yktrend->number = $request->get('number');

        if ($yktrend->save()) {
            return json_encode($info);
        } else {
            return Redirect::back()->withInput()->withErrors('保存失败！!!');
        }
    }

    public function yktrendEdit($id)
    {
        //Yktrend::findOrFail($id)->delete();
        //return  redirect('admin');
        $yktrend = Yktrend::find($id);

        return view('admin/yktrendEdit',['yktrend'=>$yktrend]);
    }

    public function yktrendEditOk(Request $request)
    {
        //Yktrend::findOrFail($id)->delete();
        //return  redirect('admin');
        //$yktrend = Yktrend::where('id',$id)->get();
        $this->validate($request, [
            'ydate' => 'required',
            'number' => 'required',
        ]);
        $info['status']=1;
        $yktrend = Yktrend::find($request->get('id'));
        $yktrend->ydate = $request->get('ydate');
        $yktrend->number = $request->get('number');

        if ($yktrend->save()) {
            return  json_encode($info);
        } else {
            return Redirect::back()->withInput()->withErrors('修改失败!!!');
        }
        
    }

    /***********************************游客数量走势图******************************************/
    public function ykNumber()
    {
        $yknumbers = Yknumber::Orderby('month','desc')->paginate(6);

        return view('admin/ykNumberTrend',['yknumbers'=>$yknumbers]);
    }
    public function ykNumberAdd(Request $request)
    {
        $info['status']=1;
        $this->validate($request, [
            'month' => 'required',
            'team' => 'required',
            'individual' => 'required'
        ]);

        $yknumber = new Yknumber;
        $yknumber->month = $request->get('month');
        $yknumber->team = $request->get('team');
        $yknumber->individual = $request->get('individual');

        if ($yknumber->save()) {
            return json_encode($info);
        } else {
            return Redirect::back()->withInput()->withErrors('保存失败！!!');
        }       
    }
    public function ykNumberEdit($id)
    {
        $yknumber = Yknumber::find($id);

        return view('admin/ykNumberTrendEdit',['yknumber'=>$yknumber]);
    }
    public function ykNumberEditOk(Request $request)
    {
        //Yktrend::findOrFail($id)->delete();
        //return  redirect('admin');
        //$yktrend = Yktrend::where('id',$id)->get();
        $this->validate($request, [
            'team' => 'required',
            'individual' => 'required'
        ]);
        $info['status']=1;
        $yknumber = Yknumber::find($request->get('id'));
        $yknumber->team = $request->get('team');
        $yknumber->individual = $request->get('individual');

        if ($yknumber->save()) {
            return  json_encode($info);
        } else {
            return Redirect::back()->withInput()->withErrors('修改失败!!!');
        }
        
    }
/***********************************游客类型分析******************************************/
    public function ykType()
    {
        $yktypes = Yktype::paginate(6);
        return view('admin/ykType',['yktypes'=>$yktypes]);
    }

    // public function yktypeAdd(Request $request)
    // {
    //     $info['status']=1;
    //     // $yktype = new Yktype;
    //     // $yktype->year=$request->get('year');
    //     // $yktype->childfree=$request->get('childfree');
    //     // $yktype->child=$request->get('child');
    //     // $yktype->adult=$request->get('adult');
    //     // $yktype->older=$request->get('older');
    //     // $yktype->solider=$request->get('solider');
    //     $year=$request->get('year');
    //     $childfree=$request->get('childfree');
    //     $child=$request->get('child');
    //     $adult=$request->get('adult');
    //     $older=$request->get('older');
    //     $solider=$request->get('solider');

    //     mysql_query("INSERT INTO 
    //         yktypes(year,childfree,child,adult,older,solider)
    //         values('$year','$childfree','$child','$adult','$older','$solider',)");
    //     if(ROW_COUNT()>0){
    //         return json_encode($info);
    //     }else{
    //         return Redirect::back()->withInput()->withErrors("添加失败!");
    //     }
    // }




    public function ykTypeAdd(Request $request)
    {
        $info['status']=1;
        $this->validate($request, [
            'year' => 'required',
            'childfree' => 'required',
            'child' => 'required',
            'adult' => 'required',
            'older' => 'required',
            'solider' => 'required'
        ]);
        $yktype = new Yktype;
        $yktype->year=$request->get('year');
        $yktype->childfree=$request->get('childfree');
        $yktype->child=$request->get('child');
        $yktype->adult=$request->get('adult');
        $yktype->older=$request->get('older');
        $yktype->solider=$request->get('solider');
        if ($yktype->save()) {
            return json_encode($info);
        } else {
            return Redirect::back()->withInput()->withErrors("添加失败!");
        }  
    }
    public function ykTypeEdit($id)
    {
        $yktype = Yktype::find($id);

        return view('admin/ykTypeEdit',['yktype'=>$yktype]);
    }
    public function ykTypeEditOk(Request $request)
    {
        $this->validate($request, [
            'year' => 'required',
            'childfree' => 'required',
            'child' => 'required',
            'adult' => 'required',
            'older' => 'required',
            'solider' => 'required'
        ]);
        $info['status']=1;
        $yktype = Yktype::find($request->get('id'));
        $yktype->year = $request->get('year');
        $yktype->childfree = $request->get('childfree');
        $yktype->child = $request->get('child');
        $yktype->adult = $request->get('adult');
        $yktype->older = $request->get('older');
        $yktype->solider = $request->get('solider');

        if ($yktype->save()) {
            return  json_encode($info);
        } else {
            return Redirect::back()->withInput()->withErrors('修改失败!!!');
        }
        
    }
/***********************************游客客源地分析******************************************/
    public function ykSource()
    {
        $yksources = Yksource::orderBy('year', 'desc')->paginate(10);
        return view('admin/ykSource',['yksources'=>$yksources]);
    }

    public function ykSourceAdd(Request $request)
    {
        $info['status']=1;
        $this->validate($request, [
            'year' => 'required',
            'province' => 'required',
            'number' => 'required'
        ]);

        $yksource = new Yksource;
        $yksource->year = $request->get('year');
        $yksource->province = $request->get('province');
        $yksource->number = $request->get('number');

        if ($yksource->save()) {
            return json_encode($info);
        } else {
            return Redirect::back()->withInput()->withErrors('保存失败！!!');
        }    
    }
    public function ykSourceEdit($id)
    {
        $yksource = Yksource::find($id);

        return view('admin/ykSourceEdit',['yksource'=>$yksource]);
    }
    public function ykSourceEditOk(Request $request)
    {
        $this->validate($request, [
            'province' => 'required',
            'number' => 'required',
            'year' => 'required',
        ]);
        $info['status']=1;
        $yksource = Yksource::find($request->get('id'));
        $yksource->year = $request->get('year');
        $yksource->province = $request->get('province');
        $yksource->number = $request->get('number');
        if ($yksource->save()) {
            return  json_encode($info);
        } else {
            return Redirect::back()->withInput()->withErrors('修改失败!!!');
        }
        
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}