<?php

namespace App\Http\Middleware;

use Closure;

use App\Language as lang;

class Language
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
    $model = lang::where("language_prefix", $request->segment(1))->first();

    if ($model) {
      \App::setLocale($model->language_prefix);
      return $next($request);
    } else {
      if (
        $request->segment(1) == "locale"
        || $request->segment(1) == "admin"
        || $request->segment(1) == "laravel-filemanager"
        || $request->segment(1) == "login"
        || $request->segment(1) == "contact_post"
        || $request->segment(1) == "send_post"
        || $request->segment(1) == "check"
        || $request->segment(1) == "cv_form_post"
        || $request->segment(1) == "obuna"
        || $request->segment(1) == "vote"
        || $request->segment(1) == "storage"
        || $request->segment(1) == "mail"
        || $request->segment(1) == "uploadsdialog"
        || $request->segment(1) == "forums"
        || $request->segment(1) == "register"
        || $request->segment(1) == "home"
        || $request->segment(1) == "logout"
        || $request->segment(1) == "artisan"
      ) {
        return $next($request);
      } else {
        return redirect("/en");
      }
    }
  }
}
