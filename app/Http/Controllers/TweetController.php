<?php

namespace App\Http\Controllers;

class TweetController extends Controller
{
  public function index()
  {
    $tweet = "\"Tweeeeeetしてみました！\"";
    return view('tweet', ['tweet' => $tweet]);
  }
}
