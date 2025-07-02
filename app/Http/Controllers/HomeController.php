<?php

namespace App\Http\Controllers;

use App\Models\Module;


class HomeController extends Controller
{
    public function index()
    {
        return view("pages.home");
    }

    public function about()
    {
        $team = [
            [
                'nama' => 'Agisni Maulani Hafitri',
                'nim' => '2206149',
                'img' => 'img/people/1.png',
            ],
            [
                'nama' => 'Muhamad Chikal Ubaidillah Nurhasan',
                'nim' => '2306158',
                'img' => 'img/people/2.jpg',
            ],
            [
                'nama' => 'Muhammad Saiful Rizal',
                'nim' => '2206164',
                'img' => 'img/people/3.jpeg',
            ],
            [
                'nama' => 'Asep Abdul Rohman',
                'nim' => '2206161',
                'img' => 'img/people/4.jpeg',
            ],
            [
                'nama' => 'Vito Gunawan',
                'nim' => '2306149',
                'img' => 'img/people/5.jpeg',
            ],
            [
                'nama' => 'Bubu Bukhori Muslim',
                'nim' => '2306156',
                'img' => 'img/people/6.jpeg',
            ],
        ];
        return view("pages.about", compact('team'));
    }

    public function modules()
    {
        $modules = Module::with(['user', 'materis'])
            ->orderBy('order')
            ->orderBy('created_at', 'desc')
            ->get();
        return view("pages.module", compact('modules'));
    }

    public function chapter()
    {
        return view("pages.chapter.index");
    }
}
