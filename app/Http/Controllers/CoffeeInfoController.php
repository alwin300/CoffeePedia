<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Coffeeinfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class CoffeeInfoController extends Controller{
    public function showCoffeeInfo(Request $request)
	{
		if($request->has('search'))
		{
			$varcoffee=coffeeinfo::where('judul','LIKE', '%'.$request->search.'%')->paginate(10); 
		}
		else{
		$varcoffee= coffeeinfo::paginate(10);
		}
		return view("coffeeInfo.coffeeinfo",['datacoffeeinfo' => $varcoffee]);
	}
	
	public function addCoffeeInfo()
	{
		return view("coffeeInfo.formtambahcoffeeinfo");
	}
	
	public function insertCoffeeInfo(Request $request)
    {
    $rules = 
        [
        'judul' => 'required|string',
        'image' => 'required|image|file',
        'deskripsi' => 'required|text',
        ];

        if ($request->file('image')) {
				$validatedData['image'] = $request ->file('image')->store('coffeeInfo');
		}

	{
		//codinginsert
		DB::table('coffeeinfos') -> insert ([
			'user_id' =>Auth::user()->id, 
			'judul' => $request->judul,
			'image' => $validatedData['image'],
			'deskripsi' => $request->deskripsi
		]);
	}
	return redirect('/coffeeinfo')->with ('success','Data baru telah tersimpan!');
}
public function editCoffeeInfo($idedit)
	{
		$varcoffee = DB::table('coffeeinfos')->where('id',$idedit)->get();
		return view("coffeeInfo.formeditcoffeeinfo",['datacoffeeinfo' => $varcoffee]);
	}
	
	public function updateCoffeeInfo(Request $request, $id)
    {
		$rules = $request->validate
		([
		'judul' => 'required|string',
		'deskripsi' => 'required|string',
		'image' => 'image|file',
		]);

		if ($request->file('image')) {
			if ($request->oldImage) {
				Storage::delete($request->oldImage);
			}
		}
		
			if ($request-> file('image')) {
				$rules ['image'] = $request->file('image')->store('coffeeInfo');
			}
        $coffeeinfo = coffeeinfo::where('id', $id)
        ->update ($rules);

        return redirect('/coffeeinfo')->with ('success','Data berhasil di edit!');
	}
	public function deleteCoffeeInfo($idhapus)
	{
		$coffeeinfo = coffeeinfo::where('id', $idhapus)->first();
			if ($coffeeinfo->image) {
				unlink(public_path('storage').'/'.$coffeeinfo->image);
}
$coffeeinfo = coffeeinfo::where('id', $idhapus)->delete();
		// redirect ke tampil data
		return redirect('/coffeeinfo')->with ('success','Data telah dihapus!');
	}
		public function viewCoffeeinfo ($idcoffeeinfo)
	{
		
		$varcoffeeinfo = DB::table('coffeeinfos')->where('id',$idcoffeeinfo)->get();
		return view("coffeeInfo.viewcoffeeinfo",['datacoffeeinfo' => $varcoffeeinfo]);
	}
}


