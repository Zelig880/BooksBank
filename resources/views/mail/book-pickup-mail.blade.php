@php
$APP_URL = env('APP_URL', 'http://localhost:8000')
@endphp
@extends('layouts.email')
@section('body')
  <tr>
    <td valign="top" style="padding-bottom:5px;padding-left:40px;padding-right:30px;" class="mainTitle">
      <!-- Main Title Text // -->
      <h2 class="text" style="color:#000000; font-family:'Open Sans', Helvetica, Arial, sans-serif; font-size:28px; font-weight:500; font-style:normal; font-stretch: expanded; letter-spacing:normal; line-height:36px; text-transform:none; padding:0; margin:0;">
        Hey {{ $ledge->lender->name }}!
      </h2>
    </td>
  </tr>

  <tr>
    <td valign="top" style="padding-bottom:30px;padding-left:40px;padding-right:40px;" class="subTitle">
      <!-- Sub Title Text // -->

      <h4 class="text" style="color:#333333; font-family:'Open Sans', Helvetica, Arial, sans-serif; font-size:14px; font-weight:300; font-style:normal; letter-spacing:normal; line-height:25px; text-transform:none; padding:0; margin:0; text-align: left;">
        <p>
          Book name: {{ $ledge->book->title }}
        </p>
      </h4>
      <p>
        Has the above book being picked up from {{ $ledge->borrower->name }}?
      </p>
    </td>
  </tr>

  <tr>
    <td  valign="top" style="padding-top:5px;padding-bottom:20px;padding-left: 40px;">

      <!-- Button Table // -->
      <table border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td class="ctaButton" style="background-color:#003CE5;padding-top:12px;padding-bottom:12px;padding-left:35px;padding-right:35px;border-radius:50px">
            <!-- Button Link // -->
            <a class="text" href="{{ $APP_URL }}/bookshelf/info/incoming" target="_blank" style="color:#FFFFFF; font-family:'Poppins', Helvetica, Arial, sans-serif; font-size:13px; font-weight:600; font-style:normal;letter-spacing:1px; line-height:20px; text-transform:uppercase; text-decoration:none; display:block">
              Respond
            </a>
          </td>
        </tr>
      </table>

    </td>
  </tr>

@endsection()