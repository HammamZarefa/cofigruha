@extends('layouts.front')

@section('content')


            <!-- ======= contact  Section ======= -->
            <section id="contact" class="contact">
            <div class="container">
            <h2 class="title">{{__('message.Contact Us')}}</h2>
                  <div class="contain">

                  <div class="info">
                   <div class="info-icon">
                   <i class="icofont-phone"></i>
                   </div>
                   <div class="info-text">
                         <h3>{{__('message.Numbers')}}</h3>
                         <p>Tel: {{$general->phone}} </p>
                         <p>FAX: {{$general->twitter}} </p>
                   </div>
                  </div>
                  <div class="info">
                   <div class="info-icon">
                   <i class="icofont-email"></i>
                   </div>
                   <div class="info-text">
                         <h3>{{__('message.Mail')}}</h3>
                         <a>{{$general->email}}</a>
                   </div>
                  </div>
                  <div class="info">
                   <div class="info-icon">
                   <i class="icofont-google-map"></i>
                   </div>
                   <div class="info-text">
                         <h3>{{__('message.Address')}}</h3>
                         <p>{{$general->address1}} </p>
                         <p>{{$general->address2}} </p>
                   </div>
                  </div>
                  <div class="info-input">
                   <div class="info-text">
                         <h3>{{__('message.Send Us a Message')}}</h3>
                         <div class="webflow-style-input">
                        <textarea class="" type="email" placeholder="{{__('message.What\'s your Message?')}}"></textarea>
                        <button type="submit"><i class="icofont-arrow-right"></i></button>
                        </div>
                   </div>
                  </div>

              </div>
            </div>
      </section>
      <!-- End contact Section -->

@endsection
