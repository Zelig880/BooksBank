@php
  $APP_URL = config('app.url')
@endphp

@extends('layouts.email')
@section('body')
  <tr>
    <td valign="top" style="padding-bottom:5px;padding-left:40px;padding-right:30px;" class="mainTitle">
      <!-- Main Title Text // -->
      <h2 class="text" style="color:#000000; font-family:'Open Sans', Helvetica, Arial, sans-serif; font-size:28px; font-weight:500; font-style:normal; font-stretch: expanded; letter-spacing:normal; line-height:36px; text-transform:none; padding:0; margin:0;">
        Hey {{ $ledge->borrower->name }}!
      </h2>
    </td>
  </tr>

  <tr>
    <td valign="top" style="padding-bottom:30px;padding-left:40px;padding-right:40px;" class="subTitle">
      <!-- Sub Title Text // -->

      <h4 class="text" style="color:#333333; font-family:'Open Sans', Helvetica, Arial, sans-serif; font-size:14px; font-weight:300; font-style:normal; letter-spacing:normal; line-height:25px; text-transform:none; padding:0; margin:0; text-align: left;">
        <p>
          Thank you for returning {{ ucwords($ledge->book->title) }}!
        </p>
      </h4>
    </td>
  </tr>

@endsection()
