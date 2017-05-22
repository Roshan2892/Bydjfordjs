@extends('user.layouts.app')

@section('content')
    
    <!-- start container -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <h1>My Story</h1>
            </div>
        </div>
        <!-- start row -->
        <div class="row">
            
            <!-- start col-lg-12 -->
            <div class="col-lg-7 col-md-7 col-sm-7">
                <h2><span>Tom Brandon</span></h2>
                <div class="about_container">
                    <span>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                        scrambled it to make a type specimen book. <br>
                        It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                        It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                        and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. <br><br>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                        when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                        It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                        It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                        and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                    </span>
                </div>
            </div>
            <!-- end col-lg-8 -->

            <!-- start col-lg-4 -->
            <div class="col-lg-5 col-md-5 col-sm-5" >
                <div class="about_img_container">
                    <img src="{{ URL::to('image/assets/brandon.jpg') }}" alt="DJ Brandon">
                </div>
            </div>
            <!-- end col-lg-4 -->
        </div>
        <!-- end row -->

    </div>
    <!-- end container -->
@endsection