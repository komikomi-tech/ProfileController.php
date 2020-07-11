<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Profiles;

use App\ProfileHistory;

use Carbon\Carbon;

class ProfileController extends Controller
{
    //
    public function add(){
        return view('admin.profile.create');
        
    }
    
    public function create(Request $request)
    {
         $this->validate($request, Profiles::$rules);
      $profile = new Profiles;
      $form = $request->all();
      // フォームから画像が送信されてきたら、保存して、$news->image_path に画像のパスを保存する
      if (isset($form['image'])) {
        $path = $request->file('image')->store('public/image');
        $profile->image_path = basename($path);
      } else {
          $profile->image_path = null;
      }
      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);
      // フォームから送信されてきたimageを削除する
      unset($form['image']);
      // データベースに保存する
      $profile->fill($form);
      $profile->save();
        return redirect('admin/profile/create');
    }
    
   public function index(Request $request)
{
    $cond_title = $request->cond_title;
    if ($cond_title != '') {
        $posts = Profiles::where('title', $cond_title)->get();
    } else {
        $posts = Profiles::all();
    }
    return view('admin.profile.index', ['posts' => $posts, 'cond_title' => $cond_title]);
}

public function edit(Request $request)
{
    $profile = Profiles::find($request->id);
    if (empty($profile)) {
        abort(404);
    }
    return views('admin.profile.edit', ['news_form' => $profile]);
}

public function update(Request $request)
{
    $this->validate($request, Profiles::$rules);
    $profile = Profiles::find($request->id);
    $profile_form = $request->all();
    if (isset($profile_form['image'])) {
        $path = $request->file('image')->store('public/image');
        $profile->image_path = basename($path);
        unset($profile_form['image']);
      } elseif (isset($request->remove)) {
        $profile->image_path = null;
        unset($profile_form['remove']);
      }
    unset($profile_form['_token']);
    $profile->fill($profile_form)->save();
    
    $history = new ProfileHistory;
    $history->profile_id = $profile->id;
    $history->edited_at = Carbon::now();
    $history->save();
    
    return redirect('admin/profile');
}

public function delete(Request $request)
{
    $profile = Profiles::find($request->id);
    $profile->delete();
    return redirect('admin/profile/');
}

}
