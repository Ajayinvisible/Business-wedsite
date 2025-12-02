 @extends('home.home_master')
 @section('home')
     {{-- breadcrumb --}}
     <div class="breadcrumb-wrapper light-bg">
         <div class="container">

             <div class="breadcrumb-content">
                 <h1 class="breadcrumb-title pb-0">{{ $category->category_name }}</h1>
                 <div class="breadcrumb-menu-wrapper">
                     <div class="breadcrumb-menu-wrap">
                         <div class="breadcrumb-menu">
                             <ul>
                                 <li><a href="index.html">Home</a></li>
                                 <li><img src="{{ asset('frontend/assets/images/blog/right-arrow.svg') }}" alt="right-arrow">
                                 </li>
                                 <li aria-current="page">Blog</li>
                             </ul>
                         </div>
                     </div>
                 </div>
             </div>

         </div>
     </div>

     {{-- blog --}}
     <div class="lonyo-section-padding9 overflow-hidden">
         <div class="container">
             <div class="row">
                 <div class="col-lg-8">
                     @foreach ($posts as $post)
                         <div class="lonyo-blog-wrap" data-aos="fade-up" data-aos-duration="500">
                             <div class="lonyo-blog-thumb">
                                 <img src="{{ asset($post->image) }}" alt="{{ $post->post_title }}">
                             </div>
                             <div class="lonyo-blog-meta">
                                 <ul>
                                     <li>
                                         <a href="{{ url('blog/details/' . $post->post_slug) }}"><img
                                                 src="{{ asset('frontend/assets/images/blog/date.svg') }}"
                                                 alt="">{{ $post->created_at->format('M d Y') }}</a>
                                     </li>
                                 </ul>
                             </div>
                             <div class="lonyo-blog-content">
                                 <h2><a href="{{ url('blog/details/' . $post->post_slug) }}">{{ $post->post_title }}</a></h2>
                                 <p>{!! Str::limit($post->post_description, 150, '...') !!}</p>
                             </div>
                             <div class="lonyo-blog-btn">
                                 <a href="single-blog.html" class="lonyo-default-btn blog-btn">continue reading</a>
                             </div>
                         </div>
                     @endforeach

                     <div class="lonyo-pagination center">
                         <a class="pagi-btn btn2" href="single-blog.html">
                             <svg width="7" height="12" viewBox="0 0 7 12" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                 <path d="M0.75 0.75L6 6L0.75 11.25" stroke="#001A3D" stroke-width="1.5"
                                     stroke-linecap="round" stroke-linejoin="round" />
                             </svg>
                         </a>
                         <ul>
                             <li><a class="current" href="#">1</a></li>
                             <li><a href="single-blog.html">2</a></li>
                             <li><a href="single-blog.html">3</a></li>
                         </ul>
                         <a class="pagi-btn" href="single-blog.html">
                             <svg width="7" height="12" viewBox="0 0 7 12" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                 <path d="M0.75 0.75L6 6L0.75 11.25" stroke="#001A3D" stroke-width="1.5"
                                     stroke-linecap="round" stroke-linejoin="round" />
                             </svg>
                         </a>
                     </div>
                 </div>
                 <div class="col-lg-4">
                     <div class="lonyo-blog-sidebar" data-aos="fade-left" data-aos-duration="700">
                         <div class="lonyo-blog-widgets">
                             <form action="#">
                                 <div class="lonyo-search-box">
                                     <input type="search" placeholder="Type keyword here">
                                     <button id="lonyo-search-btn" type="button"><i class="ri-search-line"></i></button>
                                 </div>
                             </form>
                         </div>
                         <div class="lonyo-blog-widgets">
                             <h4>Categories:</h4>
                             <div class="lonyo-blog-categorie">
                                 <ul>
                                     @foreach ($blogCategories as $bCategory)
                                         <li><a href="{{ url('blog/category/' . $bCategory->category_slug) }}">{{ $bCategory->category_name }}
                                                 <span>({{ $bCategory->posts_count }})</span></a></li>
                                     @endforeach
                                 </ul>
                             </div>
                         </div>
                         <div class="lonyo-blog-widgets">
                             <h4>Recent Posts</h4>
                             @foreach ($recentPost as $rPost)
                                 <a class="lonyo-blog-recent-post-item" href="{{ url('blog/details/' . $rPost->post_slug) }}">
                                     <div class="lonyo-blog-recent-post-thumb">
                                         <img src="{{ asset($rPost->image) }}" alt="{{ $rPost->post_title }}" style="width: 80px; height: 80px;">
                                     </div>
                                     <div class="lonyo-blog-recent-post-data">
                                         <ul>
                                             <li><img src="{{ asset('frontend/assets/images/blog/date.svg') }}"
                                                     alt="">{{ $rPost->created_at->format('M d Y') }}</li>
                                         </ul>
                                         <div>
                                             <h4>{{ $rPost->post_title }}</h4>
                                         </div>
                                     </div>
                                 </a>
                             @endforeach
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>

     @include('home.homelayout.apps')
 @endsection
